<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ConsultingService;
use App\ConsultingSection;
use App\ManageText;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use App\NotificationText;
use App\ValidationText;

class ConsultingServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $consultingservice=ConsultingService::all();
        $consultingsection=ConsultingSection::all();
        $websiteLang=ManageText::all();
        return view('admin.consultingservice.index',compact('consultingservice','websiteLang'));
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


        $consultingservice=new ConsultingService();
        $consultingservice->image=$image_path;
        $consultingservice->name=$request->name;

        $consultingservice->status=$request->status;
        $consultingservice->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.consultingservice.index')->with($notification);
    }

    public function update(Request $request, ConsultingService $consultingservice)
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
            $old_image=$consultingservice->image;
            $image=$request->image;
            $extention=$image->getClientOriginalExtension();
            $name= 'partner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $image_path='uploads/custom-images/'.$name;

            Image::make($image)
                ->save(public_path().'/'.$image_path);

            $consultingservice->image=$image_path;
            $consultingservice->save();
            if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);
        }

        $consultingservice->name=$request->name;
        $consultingservice->description=$request->description;
        $consultingservice->status=$request->status;
        $consultingservice->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.consultingservice.index')->with($notification);
    }

    public function destroy(ConsultingService $consultingservice)
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


        $old_image=$consultingservice->image;
        $consultingservice->delete();

        if(File::exists(public_path().'/'.$old_image))unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.consultingservice.index')->with($notification);
    }

    public function changeStatus($id){
        $consultingservice=ConsultingService::find($id);
        if($consultingservice->status==1){
            $consultingservice->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $consultingservice->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $consultingservice->save();
        return response()->json($message);

    }
}