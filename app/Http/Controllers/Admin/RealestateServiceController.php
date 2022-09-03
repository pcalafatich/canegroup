<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RealestateService;
use App\RealestateSection;
use App\ManageText;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use App\NotificationText;
use App\ValidationText;

class RealestateServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $realestateservice=RealestateService::all();
        $realestatesection=RealestateSection::all();
        $websiteLang=ManageText::all();
        return view('admin.realestateservice.index',compact('realestateservice','websiteLang'));
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
            'image'=>'required',
            'name'=>'required',
            'description'=>'required|max:100'

        ];
        $customMessages = [
            'image.required' => $valid_lang->where('lang_key','img')->first()->custom_text,
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','description')->first()->custom_text,
            'description.max'=> $valid_lang->where('lang_key','description.max')->first()->custom_text
        ];
        $this->validate($request, $rules, $customMessages);

         // GUARDAR IMAGEN
         $image=$request->image;
         $extention=$image->getClientOriginalExtension();
         $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
         $image_path='uploads/custom-images/'.$name;

         Image::make($image)
         ->save(public_path().'/'.$image_path);


        $realestateservice=new RealestateService();
        $realestateservice->image=$image_path;
        $realestateservice->name=$request->name;

        $realestateservice->status=$request->status;
        $realestateservice->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.realestateservice.index')->with($notification);
    }

    public function update(Request $request, RealestateService $realestateservice)
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
            'name'=>'required',
            'description'=>'required|max:100'
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','name')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','description')->first()->custom_text,
            'description.max'=> $valid_lang->where('lang_key','description.max')->first()->custom_text

        ];
        $this->validate($request, $rules, $customMessages);


        if($request->image){
            $old_image=$realestateservice->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->save(public_path().'/'.$image_path);

            $realestateservice->image=$image_path;
            $realestateservice->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $realestateservice->name=$request->name;
        $realestateservice->description=$request->description;
        $realestateservice->status=$request->status;
        $realestateservice->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.realestateservice.index')->with($notification);
    }

    public function destroy(RealestateService $realestateservice)
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


        $old_image=$realestateservice->image;
        $realestateservice->delete();

        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.realestateservice.index')->with($notification);
    }

    public function changeStatus($id){
        $realestateservice=RealestateService::find($id);
        if($realestateservice->status==1){
            $realestateservice->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $realestateservice->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $realestateservice->save();
        return response()->json($message);
    }
}