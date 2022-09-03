<?php

namespace App\Http\Controllers\Admin;

use App\DesokupaSection;
use App\ManageText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\NotificationText;
use App\ValidationText;

class DesokupaSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sections=DesokupaSection::all();
        $websiteLang=ManageText::all();
        return view('admin.desokupa-section.index',compact('sections','websiteLang'));
    }



    public function updateFeatureSection(Request $request,$id){
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'header'=>'required',
            'description'=>'required',
            'show_homepage'=>'required',
            'content_quantity'=>'required',
        ];
        $customMessages = [
            'header.required' => $valid_lang->where('lang_key','header')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
            'show_homepage.required' => $valid_lang->where('lang_key','show_homepage')->first()->custom_text,
            'content_quantity.required' => $valid_lang->where('lang_key','content_qty')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $desokupaSection=DesokupaSection::find($id);
        $desokupaSection->header=$request->header;
        $desokupaSection->description=$request->description;
        $desokupaSection->show_homepage=$request->show_homepage;
        $desokupaSection->content_quantity=$request->content_quantity;
        $desokupaSection->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.home-section.index')->with($notification);
    }



    public function updateBannerCategorySection(Request $request,$id){

        // VERIFICAR MODO DEMO
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // FIN


        $valid_lang=ValidationText::all();
        $rules = [
            'content_quantity'=>'required',
        ];
        $customMessages = [
            'content_quantity.required' => $valid_lang->where('lang_key','content_qty')->first()->custom_text,
        ];
        $this->validate($request, $rules, $customMessages);


        $desokupaSection=DesokupaSection::find($id);
        $desokupaSection->content_quantity=$request->content_quantity;
        $desokupaSection->show_homepage=$request->show_homepage;
        $desokupaSection->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.desokupa-section.index')->with($notification);
    }

}