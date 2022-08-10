<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\CmsModule;

class CmsController extends Controller
{
    /**
     * About Us.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $page_title = "CMS module";
        $cms_modules = CmsModule::paginate(10)->appends($request->all());
        return view('backend.cms_module.index',compact('cms_modules','page_title'));
    }

    /**
     * Terms & Condition.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug){
        $page_title = "Edit Cms Content";
        $cms_module = CmsModule::where('slug',$slug)->first();
        if(!$cms_module){
            Session::flash('toast-error','Something went wrong.');
            return redirect()->back();
        }
        if($request->method() == 'POST'){
            /* Check validation */ 
            $validator = Validator::make($request->all(), [
                'content' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->back()->with('toast-error',$validator->errors()->first());
            }
            $cms_module->content = $request->content;
            $cms_module->status = 1;
            $cms_module->updated_by = Session::get('user_id'); /* Login admin user id */
            $cms_module->save();
            Session::flash('toast-success','Cms content updated successfully.');
            return redirect()->route('cms.module');
        }
        return view('backend.cms_module.edit',compact('cms_module','page_title','slug'));
    }

    /**
     * Terms & Condition.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy(Request $request){
        $page_title = "Privacy Policy";
        $cms_module = CmsModule::where('key','privacy_policy')->first();
        if($request->method() == 'POST'){
            /* Check validation */ 
            $validator = Validator::make($request->all(), [
                'content' => 'required'
            ]);
            if($validator->fails()){
                return redirect()->back()->with('toast-error',$validator->errors()->first());
            }

            if(!$cms_module){
                $cms_module = new CmsModule();
                $cms_module->key = "privacy_policy";
            }
            $cms_module->content = $request->content;
            $cms_module->status = 1;
            $cms_module->updated_by = Session::get('user_id'); /* Login admin user id */
            $cms_module->save();
            Session::flash('toast-success','Privacy policy updated successfully.');
            return redirect()->back();
        }
        return view('backend.cms_module.privacy_policy',compact('cms_module','page_title'));
    }
}
