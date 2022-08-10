<?php

namespace App\Http\Controllers\Backend;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Models\ChurchDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $limit;
    /*For limit of pagination in the users module */
    public function __construct()
    {
        $this->limit = 10;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Users List";
        $query = User::with('users_details','country')
                ->select('*')
                ->whereIn('role_id',[2,3])
                ->where('is_delete',0);
         /*Search Filter */
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('first_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('last_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('mobile_number', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        /* From & To Date filter */
        if ($request->get('fromdate')) {
            $from_date=Carbon::createFromFormat('m-d-Y',$request->get('fromdate'))->format('Y-m-d');
            $to_date=Carbon::createFromFormat('m-d-Y',$request->get('todate'))->format('Y-m-d');
            if ($request->get('fromdate') != 0) {
                $query->whereBetween('created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
            }
        }
        /* Status filter */
        if (!is_null($request->status)) {
            $query->where('status', $request->status);
        }
        /* User type filter */
        if ($request->get('user_type')) {
            if (!empty($request->user_type)) {
                $query->where('role_id', '=', $request->get('user_type'));
            }
        }
        $users = $query->paginate($this->limit)->appends($request->all());
        /* Ajax search*/
        if($request->ajax()){
            $view = view('components.users_table',compact('users'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('backend.users.index',compact('users'))->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = "Edit User";
        $users = User::select('*')
        ->where('is_delete',0)->find(getDecrypted($id));
        /*get all country listing */
        $country =  Country::where(function($q){
            $q->where('phone','!=','+1');
            $q->orWhere('code','US');
        })->get();
        return view('backend.users.edit',compact('users','country'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*For update users details */
    public function update(Request $request, $id)
    {
        /*Check validations */
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|min:10|unique:users,mobile_number,'.getDecrypted($id).',id',
            'email' => 'email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/|unique:users,email,'.getDecrypted($id).',id',
            'country_code'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
            $mobile_number=preg_replace('/[^0-9]/', '', $request->mobile_number);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name=$request->username;
            $user->email = $request->email;
            $user->country_code = $request->country_code;
            $user->mobile_number = $mobile_number;
            $user->save();

        return redirect()->route('users.index')->with('toast-success','Users updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*delete user from users table */
    public function destroy($id,Request $request)
    {
        $user = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
        if($user){
            $user->is_delete = 1;
            $user->save();
            \Session::flash('toast-success', 'User deleted successfully');
            return response()->json(['status'=>"success",'message'=>"User deleted successfully."]);
        }
        return response()->json(['status'=>"fail",'message'=>"Something went wrong."]);
    }
    /*update user table */
    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = User::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success','Users status updated successfully','Success');
        return response()->json(['status'=>"success",'message'=>'User status updated  successfully.']);
    }
    /*bulk update user status */
    public function bulk_updates(Request $request)
    {
        $status = $request->input('status');
        $user_ids = $request->input('user_ids');
        if($status!='')
        {
            $all_users = User::whereIn('id',$user_ids)->select('id','status')->get();

            foreach ($all_users as $key => $users) {
                $users->status=$request->input('status');
                $users->save();
            }
            \Session::flash('toast-success','status updated successfully','Success');
            return Response()->json(['success'=>true,'message'=>'status updated successfully']);
        }
        else
        {   
            /* Error responce*/
            return Response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }

    public function isEmailExists(Request $request){
        $isValid = true;
        $message = '';
        $email = $request->email;
        if($request->has('email_of_leader')){
            $email =$request->email_of_leader;
        }
        if(!empty($request->id))
        {
            $isExist = User::select('id')->where('id','!=',$request->id)->where('email',$email)->first();
        }
        else{
            $isExist = User::select('id')->where('email',$email)->first();
        }
        if($isExist){
                $isValid = false;
                $message = 'Email is already exists';
            }
        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }

    public function isUsernameExists(Request $request){
        $isValid = true;
        $message = '';
        $isExist = User::select('id')->where('id','!=',$request->id)->where('user_name','=',$request->username)->count();
        if($isExist>0){
            $isValid = false;
            $message = 'Username is already exists';
        }

        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }
    public function isChurchEmailExists(Request $request){
        $isValid = true;
        $message = '';
        $email = $request->email;
        if($request->has('church_email')){
            $email =$request->church_email;
        }
        if(!empty($request->id))
        {
            $isExist = ChurchDetail::select('id')->whereNotIn('user_id',[$request->id])->where('church_email',$email)->first();
        }
        else{
            $isExist = ChurchDetail::select('id')->where('church_email',$email)->first();
        }
        if($isExist){
            $isValid = false;
            $message = 'Email is already exists';
        }
        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);

    }

}
