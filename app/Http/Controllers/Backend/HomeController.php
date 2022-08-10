<?php

namespace App\Http\Controllers\Backend;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BusinessDetail;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('backend')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*Dashboard card counts */
        $data['page_title'] = "Dashboard";
        $total_users = User::whereIn('role_id',[2,3])->where('is_delete',0)->count();
        $all_business =BusinessDetail::select('business_details.*')->where('is_delete',0)->leftJoin('business_revisions','business_revisions.business_id','business_details.id')->count();
        $total_church = User::select('id')->where('role_id',4)->where('is_delete',0)->count();

        $approved_business = BusinessDetail::select('business_details.id')->where('is_delete',0)->leftJoin('business_revisions','business_revisions.business_id','business_details.id')->where('business_details.is_approved',1)->whereNull('business_revisions.is_approved')->count();

        $pending_business = BusinessDetail::select('business_details.id')->where('is_delete',0)
        ->leftJoin('business_revisions','business_revisions.business_id','business_details.id')
        ->where('business_details.is_approved',0)
        ->orWhere('business_details.is_business_revision',1)
        ->count();

        return view('backend.dashboard',compact('total_users','all_business','pending_business','approved_business','total_church'))->with($data);

    }

    /* Admin Account setting function*/
    function account_setting(Request $request,$id){
        $data['page_title'] = "Account Settings";
        $admin = User::find(getDecrypted($id));
        if(!$admin){
            return redirect()->back()->with('alert-error','Something went wrong.');
        }
        if($request->method() == 'POST'){
            if($request->has('action') && $request->action == 'change_email'){
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'name' => 'required|max:100',
                ]);
            }elseif($request->has('profile')){
                $validator = Validator::make($request->all(), [
                    'profile' => 'mimes:jpeg,jpg,png|required'
                ]);
            }elseif(!$request->has('remove_profile')){
                $validator = Validator::make($request->all(), [
                    'currentpassword' => 'required',
                    'password' => 'required|confirmed',
                ]);
            }
            //Send failed response if request is not valid
            if ($validator->fails()) {
                if($request->ajax()){
                    return response()->json(['status'=>"fail",'message'=>$validator->messages()->first()]);
                }
            }
            $message = 'Profile updated successfully.';
            $status = 'success';
            if($request->has('action') && $request->action == 'change_email'){
                $admin->name = $request->name;
                $admin->email = $request->email;
            }elseif($request->has('profile')){
                /*Remove old Profile*/
                if($admin->profile_img != ""){
                    try {
                        unlink(public_path('/uploads/profile_images/'.$admin->profile_image));
                    } catch (\Throwable $th) {
                    }
                }
                $profile = $request->profile;
                $profile_name = md5(time().rand()).'.'.$profile->getClientOriginalExtension();
                $profile->move(public_path().'/uploads/profile_images',$profile_name);
                $admin->profile_image = $profile_name;
            }else{
                if(\Hash::check($request->currentpassword, $admin->password)){
                    $admin->password = \Hash::make($request->password);
                }else{
                    $message = "Current password is incorrect.";
                    $status = "fail";
                }
            }
            if($status == "success"){
                $admin->save();
            }
            return response()->json(['status'=>$status,'message'=>$message]);
        }else{
            return view('backend.account_setting',compact('admin'))->with($data);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function logout(Request $request){
        $request->session()->flush('user_id');
        $request->session()->flush('user_email');
        $request->session()->flush('user_name');
        return redirect()->route('backend.login')->with('alert-success','Logout Successfully');
    }

}
