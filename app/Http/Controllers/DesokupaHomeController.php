<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\HomeSection;
use App\Blog;
use App\Testimonial;
use App\About;
use App\AboutSection;
use App\Partner;
use App\BlogCategory;
use App\ContactUs;
use App\Setting;
use App\BlogComment;
use App\Rules\Captcha;
use App\ContactInformation;
use App\Subscribe;
use App\ConditionPrivacy;
use App\EmailTemplate;
use App\SeoText;
use App\BannerImage;
use App\NotificationText;
use App\ValidationText;
use App\ManageText;
use App\Navigation;
use App\CustomPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscribeUsNotification;
use App\Order;
use App\CustomPaginator;
use App\Admin;
use App\User;
use App\Helpers\MailHelper;
use App\Overview;
use App\DesokupaSection;
use App\DesokupaService;
use App\Service;
use App\Faq;
use App\Package;
use App\City;
use App\PrivacyPolicy;

use Illuminate\Pagination\Paginator;


class DesokupaHomeController extends Controller
{

    public function index(){
        $sliders =Slider::orderBy('id','asc')->where([['modelo','desokupa'],['status',1]])->get();
        $aboutUs = About::where('modelo','desokupa')->first();
        $overviews=Overview::where('status',1)->get();
        $sections=HomeSection::all();
        $services=Service::where('status',1)->get();
        $currency=Setting::first();
        $seo_text=SeoText::find(1);
        $service_bg=BannerImage::find(23);
        $agents=User::where('status',1)->orderBy('id','desc')->get();
        $orders=Order::where(['status'=>1])->get();
        $blogs=Blog::where(['modelo'=>'desokupa','status'=>1,'show_homepage'=>1])->get();
        $default_profile_image=BannerImage::find(15);
        $testimonials=Testimonial::where('status',1)->get();
        $cities=City::where('status',1)->orderBy('name','asc')->get();
        $feature_image=BannerImage::find(23);
        $testimonial_bg=BannerImage::find(25);
        $contact=ContactInformation::first();
        $contactSetting=Setting::first();        
        $agent_bg=BannerImage::find(26);
        $websiteLang=ManageText::all();

        return view('desokupa.index',compact('sliders','aboutUs', 'overviews','sections','services','currency','seo_text','service_bg','agents','orders','blogs','default_profile_image','testimonials','cities','feature_image','testimonial_bg','contact','contactSetting','agent_bg','websiteLang'));
    }



    public function aboutUs(){
        $about=About::first();
        $banner_image=BannerImage::find(2);
        $overviews=Overview::where('status',1)->get();
        $partners=Partner::where('status',1)->get();
        $sections=AboutSection::all();
        $seo_text=SeoText::find(3);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.about-us',compact('about','banner_image','overviews','partners','sections','seo_text','menus','websiteLang'));
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
        $faqs=Faq::where([['modelo','realestate'],['status',1]])->get();
        $banner_image=BannerImage::find(19);
        $faq_image=BannerImage::find(20);

        $seo_text=SeoText::find(8);
        $menus=Navigation::all();

        return view('user.faq',compact('banner_image','faqs','faq_image','seo_text','menus'));

    }


    public function contactUs(){
        $contact=ContactInformation::first();
        $contactSetting=Setting::first();
        $seo_text=SeoText::find(7);
        $banner_image=BannerImage::find(6);
        $menus=Navigation::all();
        $websiteLang=ManageText::all();
        return view('user.contact-us',compact('contact','contactSetting','seo_text','banner_image','menus','websiteLang'));
    }


    public function termsCondition(){
        $termsCondtion=ConditionPrivacy::first();
        $banner_image=BannerImage::find(9);
        $menus=Navigation::all();

        return view('user.terms-condition',compact('termsCondtion','banner_image','menus'));
    }



    public function privacyPolicy(){
        $privacy = PrivacyPolicy::first();
        $banner_image=BannerImage::find(10);
        $menus=Navigation::all();
        return view('user.privacy-policy',compact('privacy','banner_image','menus'));
    }



    // manage subscriber
    public function subscribeUs(Request $request){
        $valid_lang=ValidationText::all();
        $rules = [
            'email'=>'required|email',
        ];
        $customMessages = [
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text
        ];
        $this->validate($request, $rules, $customMessages);


        $isSubsriber=Subscribe::where('email',$request->email)->count();
        if($isSubsriber ==0){
            $subscribe=Subscribe::create([
                'email'=>$request->email,
                'verify_token'=> Str::random(25)
            ]);

            MailHelper::setMailConfig();

            $template=EmailTemplate::where('id',4)->first();
            $message=$template->description;
            $subject=$template->subject;
            Mail::to($subscribe->email)->send(new SubscribeUsNotification($subscribe,$message,$subject));

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','subscribe')->first()->custom_text;
            return response()->json(['success'=>$notification]);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','already_subscribe')->first()->custom_text;
            return response()->json(['error'=>$notification]);
        }

    }

    public function subscriptionVerify($token){
        $subscribe=Subscribe::where('verify_token',$token)->first();
        if($subscribe){
            $subscribe->status=1;
            $subscribe->verify_token=null;
            $subscribe->save();

            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','verified')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'success');

            return redirect()->to('/')->with($notification);
        }else{
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','invalid_token')->first()->custom_text;
            $notification=array('messege'=>$notification,'alert-type'=>'error');

            return redirect()->to('/')->with($notification);
        }
    }


    public function customPage($slug){
        $page=CustomPage::where('slug',$slug)->first();
        if(!$page){
            return back();
        }
        $banner_image=BannerImage::find(17);
        $menus=Navigation::all();
        return view('user.custom-page',compact('page','banner_image','menus'));
    }

    public function pricingPlan(){
        $packages=Package::where('status',1)->orderBy('package_order','asc')->get();
        $seo_text=SeoText::find(4);
        $banner_image=BannerImage::find(3);
        $menus=Navigation::all();
        $currency=Setting::first();
        $websiteLang=ManageText::all();
        return view('user.price-plan',compact('packages','seo_text','banner_image','menus','currency','websiteLang'));
    }


  
      public function downloadListingFile($file){
        $filepath= public_path() . "/uploads/custom-images/".$file;
        return response()->download($filepath);
    }
 


}
