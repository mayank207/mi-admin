<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Jobs\QueueEmails;
use App\Models\ChurchType;
use App\Models\ChurchDetail;
use Illuminate\Http\Request;
use App\Mail\SendEmailInQueue;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit;
    /* For limit of pagination in church module */
    public function __construct()
    {
        $this->limit = 10;
    }
    /* For listing of churches */
    public function index(Request $request)
    {
        $data['page_title'] = "Church List";
        $query = User::select('users.*')
            ->where('users.role_id',4)
            ->where('users.is_delete',0)
            ->join('church_details', 'church_details.user_id', '=', 'users.id')
            ->orderBy('users.id','desc');

        /*Search filter on the church module */
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('church_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('church_email', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        /* Denomination filter */
        if($request->has('denomination') && $request->denomination != ""){
            $query = $query->whereHas('church_details',function($q) use($request){
                $q->where('denomination_id', $request->denomination)->select('id');
            });
        }
        $denomination = ChurchType::orderBy('display_order','asc')->where('status',1)->where('is_delete',0)->get();
        $church=$query->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('components.church_table',compact('church','denomination'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.church.index',compact('church','denomination'))->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Add Church";
        /*Get all country */
        $getAllContrycode = Country::where(function($q){
            $q->where('phone','!=','+1');
            $q->orWhere('code','US');
        })->get();
        $denomination = ChurchType::orderBy('display_order','asc')->where('status',1)->get();
        return view('backend.church.add',compact('getAllContrycode','denomination'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Check validation */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/|unique:users,email',
            'denomination' => 'required',
            'address'=> 'required',
            'zip_code' => 'required',
            'state'=> 'required',
            'city' => 'required',
        ],
      );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        /*Save Church basic details on users table*/
        $add_church = new User();
        $add_church->name = $request->name_of_leader;
        $add_church->email = $request->email_of_leader;
        $add_church->role_id = 4;
        $add_church->status = 1;
        $add_church->save();
        /*Save Church other details on church_details table*/
        $church_details=new ChurchDetail;
        $church_details->user_id=$add_church->id;
        $church_details->church_name =$request->name;
        $church_details->church_email =$request->email;
        $church_details->address =$request->address;
        $church_details->latitude =$request->latitude;
        $church_details->longitude =$request->longitude;
        $church_details->address_2 =$request->address_2;
        $church_details->state =$request->state;
        $church_details->city =$request->city;
        $church_details->denomination_id = $request->denomination;
        /* save the new denomination if exist*/ 
        if($request->has('new_denomination')){
            $church_details->new_denomination =$request->new_denomination;
        }
        $church_details->description =$request->description;
        $church_details->zip_code =$request->zip_code;
        $church_details->country_id =$request->country;
        $church_details->save();

        if($add_church){
              /* Send Email for church email verification*/
            $data = [
                'subject' => 'Registration verification for Churches',
                'template' => 'mails.church_email_varification', //church register mail
                'email_to' => $add_church->email,
                'name' => $add_church->name,
                'verify_url' => route('user.verify.email',[getEncrypted($add_church->id),$this->getVerifyToken()]),
            ];
            QueueEmails::dispatch($data, new SendEmailInQueue($data));
            return redirect()->route('church.index')->with('toast-success','Church created successfully.');
        }else{
            return redirect()->back()->with('toast-error','Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = "Edit Church";
        $church = User::select('*')->with('church_details')->find(getDecrypted($id));
        $getAllContrycode = Country::where(function($q){
            $q->where('phone','!=','+1');
            $q->orWhere('code','US');
        })->get();
        $denomination = ChurchType::orderBy('display_order','asc')->where('status',1)->get();
        if($church){
        /* Success Response */
            return view('backend.church.edit',compact('church','getAllContrycode','denomination'))->with($data);
        }
        /* Error Response */
        return redirect()->back()->with('toast-error','Something went wrong.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* Update church details */
    public function update(Request $request, $id)
    {
        /* Check validation */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/',
            'denomination' => 'required',
            'address'=> 'required',
            'zip_code' => 'required',
            'state'=> 'required',
            'city' => 'required',
        ],
      );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
         /* Update church basic details */
        $church = User::find(getDecrypted($id));
        $church->name = $request->name_of_leader;
        $church->email = $request->email_of_leader;
        $church->status = isset($request->status)? 1 : 0;
        $church->save();
         /* Update church other details */
        $church_details= ChurchDetail::where('user_id',getDecrypted($id))->first();
        if (empty($church_details)) {
            $church_details = new ChurchDetail;
            $church_details->user_id = getDecrypted($id);
        }
        $church_details->address =$request->address;
        $church_details->latitude =$request->latitude;
        $church_details->longitude =$request->longitude;
        $church_details->address_2 =$request->address_2;
        $church_details->state =$request->state;
        $church_details->city =$request->city;
        $church_details->church_name =$request->name;
        $church_details->church_email =$request->email;
        $church_details->denomination_id = $request->denomination;
        if($request->has('new_denomination')){
            $church_details->new_denomination =$request->new_denomination;
        }
        $church_details->description =$request->description;
        $church_details->zip_code =$request->zip_code;
        $church_details->country_id =$request->country;
        $church_details->save();
        if($church){
            return redirect()->route('church.index')->with('toast-success','Church updated successfully.');
        }else{
            return redirect()->back()->with('toast-error','Something went wrong.');
        }

    }

    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = User::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success','Church status updated successfully','Success');
        return response()->json(['status'=>"success",'message'=>'Church status updated  successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Delete church*/
        $delete = User::select('id','is_delete')->find(getDecrypted($id));
        if($delete){
            $delete->is_delete=1;
            $delete->save();
            \Session::flash('toast-success', 'Church deleted successfully');
            return response()->json(['status'=>"success",'message'=>'Category deleted successfully.']);
         }

    }
    /*Verify the token*/
    private function getVerifyToken(){
        $date = Carbon::now()->addMinutes(60)->toDateTimeString();
        $base = getEncrypted($date);
        return Crypt::encryptString($base);
    }
}
