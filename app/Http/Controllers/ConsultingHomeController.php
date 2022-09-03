<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Captcha;
use App\Slider;
use App\ManageText;
use App\ConsultingSection;
use App\ConsultingService;
use App\BannerImage;
use App\Testimonial;
use App\CustomPage;
use App\CustomPaginator;
use App\NotificationText;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Navigation;
use App\Setting;
use App\ContactInformation;
use App\Faq;
use App\SeoText;
use App\ValidationText;
use Illuminate\Pagination\Paginator;


class ConsultingHomeController extends Controller
{
    
    public function index(){
        $sliders=Slider::orderBy('id','asc')->where(['modelo'=>'consulting','status'=>1])->get();
        // $aboutUs = About::first();
        // $overviews=Overview::where('status',1)->get();
        $sections=ConsultingSection::all();
        // $services=Service::where('status',1)->get();
        // $currency=Setting::first();
        $seo_text=SeoText::find(1);
        // $service_bg=BannerImage::find(23);
        // $agents=User::where('status',1)->orderBy('id','desc')->get();
        // $orders=Order::where(['status'=>1])->get();
        $blogs=Blog::where(['modelo'=>'consulting','status'=>1,'show_homepage'=>1])->get();
        // $default_profile_image=BannerImage::find(15);
        // $testimonials=Testimonial::where('status',1)->get();
        $feature_image=BannerImage::find(23);
        $testimonial_bg=BannerImage::find(25);
        // $agent_bg=BannerImage::find(26);
        $consultingservices=ConsultingService::where('status',1)->get();
        $contact=ContactInformation::first();
        $contactSetting=Setting::first();
        $websiteLang=ManageText::all();

        return view('consulting.index',compact('sliders','sections','seo_text','blogs','feature_image','testimonial_bg','consultingservices','contact','contactSetting','websiteLang'));
    }
    
    public function customPage($slug){
        $page=CustomPage::where([['modelo','consulting'],['slug',$slug]])->first();
        $websiteLang=ManageText::all();
        if(!$page){
            return back();
        }
        $banner_image=BannerImage::find(17);
        $menus=Navigation::all();
        $setting=Setting::all();
        $websiteLang=ManageText::all();
        return view('user.custom-page',compact('page','banner_image','menus','setting', 'websiteLang'));
    }
    
    public function blog(){
        Paginator::useBootstrap();
        $banner_image=BannerImage::find(5);
        $paginator=CustomPaginator::where('id',1)->first()->qty;
        $blogs=Blog::where('status',1)->orderBy('id','desc')->paginate($paginator);
        $seo_text=SeoText::find(6);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.blog.index',compact('banner_image','blogs','seo_text','menus','websiteLang'));
    }

    public function blogDetails($slug){

        $blog=Blog::where(['slug'=>$slug,'status'=>1])->first();
        if($blog){
            $blog->view +=1;
            $blog->save();

            $blogCategories=BlogCategory::where('status',1)->get();
            $popularBlogs=Blog::where('id','!=',$blog->id)->orderBy('view','desc')->get()->take(4);
            $commentSetting=Setting::first();
            $banner_image=BannerImage::find(5);
            $menus=Navigation::all();
            $default_profile_image=BannerImage::find(15);
            $websiteLang=ManageText::all();
            $blogComments = BlogComment::where(['blog_id' => $blog->id, 'status' => 1])->paginate(10);
            return view('user.blog.show',compact('blog','blogCategories','popularBlogs','commentSetting','banner_image','menus','default_profile_image','websiteLang','blogComments'));
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','something')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return back()->with($notification);
        }

    }


        public function blogCategory($slug,Request $request){
            Paginator::useBootstrap();
            $category=BlogCategory::where(['slug'=>$slug,'status'=>1])->first();
            if(!$category){
                return back();
            }

            $paginator=CustomPaginator::where('id',1)->first()->qty;
            $blogs=Blog::where(['blog_category_id'=>$category->id,'status'=>1])->paginate($paginator);
            $blogs=$blogs->appends($request->all());
            $banner_image=BannerImage::find(5);
            $seo_text=SeoText::find(6);
            $menus=Navigation::all();
            $websiteLang=ManageText::all();
            return view('user.blog.index',compact('blogs','banner_image','menus','seo_text','websiteLang'));
        }

        public function blogSearch(Request $request){
            Paginator::useBootstrap();
            $rules = [
                'search'=>'required',
            ];


            $this->validate($request, $rules);
            $paginator=CustomPaginator::where('id',1)->first()->qty;
            $blogs=Blog::where('title','LIKE','%'.$request->search.'%')->paginate($paginator);
            $blogs=$blogs->appends($request->all());
            $seo_text=SeoText::find(6);
            $banner_image=BannerImage::find(5);
            $menus=Navigation::all();
            $websiteLang=ManageText::all();
            return view('user.blog.index',compact('blogs','seo_text','banner_image','menus','websiteLang'));
        }

        public function blogComment(Request $request,$blogId){

            // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end
            $valid_lang=ValidationText::all();
            $rules = [
                'name'=>'required',
                'email'=>'required|email',
                'comment'=>'required',
                'g-recaptcha-response'=>new Captcha()
            ];
            $customMessages = [
                'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
                'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
                'comment.required' => $valid_lang->where('lang_key','comment')->first()->custom_text,
            ];
            $this->validate($request, $rules, $customMessages);

            $comment=new BlogComment();
            $comment->blog_id=$blogId;
            $comment->name=$request->name;
            $comment->email=$request->email;
            $comment->comment=$request->comment;
            $comment->save();


            $notification=array(
                'messege'=>'Commented Successufully',
                'alert-type'=>'success'
            );

        return back()->with($notification);
    }

    public function faq(){
        $faqs=Faq::where([['modelo','consulting'],['status',1]])->get();
        $banner_image=BannerImage::find(19);
        $faq_image=BannerImage::find(20);

        $seo_text=SeoText::find(8);
        $menus=Navigation::all();

        return view('user.faq',compact('banner_image','faqs','faq_image','seo_text','menus'));

    }
}
