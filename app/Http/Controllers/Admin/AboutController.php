<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ManageText;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File;
use App\ValidationText;
use App\NotificationText;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $about=About::first();
        $websiteLang=ManageText::all();
        return view('admin.about.edit',compact('about','websiteLang'));

    }


    public function update(Request $request, About $about)
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
            'about'=>'required',
            'service'=>'required',
            'history'=>'required',

        ];
        $customMessages = [
            'modelo.required' => $valid_lang->where('lang_key','modelo')->first()->custom_text,
            'about.unique' => $valid_lang->where('lang_key','about')->first()->custom_text,
            'service.unique' => $valid_lang->where('lang_key','service')->first()->custom_text,
            'history.unique' => $valid_lang->where('lang_key','history')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        // IMAGEN   
        if($request->file('image')){
            $old_about_img=$about->image;

            $about_imge=$request->image;
            $extention=$about_imge->getClientOriginalExtension();
            $about_imge= 'about-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$extention;
            $about_imge='uploads/website-images/about/'.$about_imge;

            Image::make($request->image)
                ->save(public_path().'/'.$about_imge);

                $about->image=$about_imge;
                    $about->save();

                if(File::exists(public_path().'/'.$old_about_img))unlink(public_path().'/'.$old_about_img);
        }
        $about->about=$request->about;
        $about->service=$request->service;
        $about->history=$request->history;
        $about->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.about.index')->with($notification);

    }

}
