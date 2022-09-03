<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\ManageText;
use App\NotificationText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $blogs=Blog::with('category')->get();
        $websiteLang=ManageText::all();
        return view('admin.blog.index',compact('blogs','websiteLang'));
    }


    public function create()
    {
        $categories=BlogCategory::all();
        $websiteLang=ManageText::all();
        return view('admin.blog.create',compact('categories','websiteLang'));
    }


    public function store(Request $request)
    {

         // VERIFICAR MODO DEMO
         if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // FIN

        $valid_lang=ValidationText::all();
        $rules = [
            'modelo'=>'required',
            'title'=>'required|unique:blogs',
            'slug'=>'required|unique:blogs',
            'category'=>'required',
            'image'=>'required',
            'short_description'=>'required',
            'description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ];
        $customMessages = [
            'modelo.required' => $valid_lang->where('lang_key','modelo')->first()->custom_text,
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
            'category.required' => $valid_lang->where('lang_key','cat')->first()->custom_text,
            'image.required' => $valid_lang->where('lang_key','img')->first()->custom_text,
            'short_description.required' => $valid_lang->where('lang_key','short_des')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $image=$request->image;
        $extention=$image->getClientOriginalExtension();
        $name= 'blog-img-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
        $image_path='uploads/custom-images/'.$name;
        Image::make($image)
        ->save(public_path().'/'.$image_path);

        $admin=Auth::guard('admin')->user();
        $blog=new Blog();
        $blog->admin_id=$admin->id;
        $blog->modelo=$request->modelo;
        $blog->title=$request->title;
        $blog->slug=$request->slug;
        $blog->blog_category_id=$request->category;
        $blog->description=$request->description;
        $blog->short_description=$request->short_description;
        $blog->image=$image_path;
        $blog->status=$request->status;
        $blog->show_homepage=$request->show_homepage;
        $blog->seo_title=$request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description=$request->seo_description ? $request->seo_description : $request->title;
        $blog->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->back()->with($notification);
    }


    public function edit(Blog $blog)
    {
        $categories=BlogCategory::all();
        $websiteLang=ManageText::all();
        return view('admin.blog.edit',compact('categories','blog','websiteLang'));
    }


    public function update(Request $request, Blog $blog)
    {
         // VERIFICAR MODO DEMO
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
            'modelo'=>'required',
            'title'=>'required|unique:blogs,title,'.$blog->id,
            'slug'=>'required|unique:blogs,slug,'.$blog->id,
            'category'=>'required',
            'description'=>'required',
            'short_description'=>'required',
            'status'=>'required',
            'show_homepage'=>'required',
        ];
        $customMessages = [
            'modelo.required' => $valid_lang->where('lang_key','modelo')->first()->custom_text,
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
            'category.required' => $valid_lang->where('lang_key','cat')->first()->custom_text,
            'short_description.required' => $valid_lang->where('lang_key','short_des')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);



        $admin=Auth::guard('admin')->user();
        if($request->file('image')){
            $old_image=$blog->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'blog-img-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->save(public_path().'/'.$image_path);
            $blog->image=$image_path;
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);



        }
        $blog->modelo=$request->modelo;
        $blog->title=$request->title;
        $blog->slug=$request->slug;
        $blog->description=$request->description;
        $blog->short_description=$request->short_description;
        $blog->blog_category_id=$request->category;
        $blog->status=$request->status;
        $blog->seo_title=$request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description=$request->seo_description ? $request->seo_description: $request->title;
        $blog->show_homepage=$request->show_homepage;
        $blog->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog.index')->with($notification);

    }


    public function destroy(Blog $blog)
    {
        // VERIFICAR MODO DEMO
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // FIN

        $old_image=$blog->image;
        BlogComment::where('blog_id',$blog->id)->delete();
        $blog->delete();
        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog.index')->with($notification);
    }

    // CAMBIO ESTADO
    public function changeStatus($id){
        $blog=Blog::find($id);
        if($blog->status==1){
            $blog->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $blog->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $blog->save();
        return response()->json($message);

    }
}