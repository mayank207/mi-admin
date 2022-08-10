<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PastorsController extends Controller
{
    protected $limit;
    /*For the pagination limit on the pastors module  */
    public function __construct()
    {
        abort(404);
        $this->limit = 10;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = "Pastors List";
        $query = User::select('*')
                ->where('role_id',5)
                ->orderBy('id','desc')
                ->where('is_delete',0);
         /*Search Filter */
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
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

        $pastors = $query->paginate($this->limit)->appends($request->all());
        /* Ajax responce*/
        if($request->ajax()){
            $view = view('components.pastors_table',compact('pastors'))->render();
            return response()->json(['status'=>200,'message','content'=>$view]);
        }
        return view('backend.pastors.index',compact('pastors'))->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['page_title'] = "Edit Pastor";
        $pastor = User::select('*')
        ->where('is_delete',0)->find(getDecrypted($id));
        return view('backend.pastors.edit',compact('pastor'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*For update pastor */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/|unique:users,email,'.getDecrypted($id).',id',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $pastor = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
            $pastor->name=$request->name;
            $pastor->email = $request->email;
            $pastor->status = isset($request->status)? 1 : 0;
            $pastor->save();

        return redirect()->route('pastors.index')->with('toast-success','Pastor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*For delete pastor */
    public function destroy($id,Request $request)
    {
        $Pastor = User::where('is_delete',0)->where('id',getDecrypted($id))->first();
        if($Pastor){
            $Pastor->is_delete = 1;
            $Pastor->save();
            \Session::flash('toast-success', 'Pastor deleted successfully');
            return response()->json(['status'=>"success",'message'=>"Pastor deleted successfully."]);
        }
        return response()->json(['status'=>"fail",'message'=>"Something went wrong."]);
    }
    /*For update pastor status*/
    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = User::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success','Pastor status updated successfully','Success');
        return response()->json(['status'=>"success",'message'=>'Pastor status updated  successfully.']);
    }
}
