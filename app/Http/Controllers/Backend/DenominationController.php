<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChurchType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DenominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit;
    /*For limit of pagination in denomination module */
    public function __construct()
    {
        $this->limit = 10;
    }

    public function index(Request $request)
    {
         $data['page_title'] = "Denomination List";
        $query = ChurchType::select('*')->where('is_delete',0)->orderBy('display_order','asc');
        /* Search filter */ 
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        $denominations=$query->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('components.denomination_table',compact('denominations'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.denomination.index',compact('denominations'))->with($data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Add Denomination";
        return view('backend.denomination.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*For add new deomination */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],
      );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        /* store new denomination in church_types table */ 
        $denomination = new ChurchType();
        $denomination->name = $request->name;
        $denomination->display_order = $request->display_order;
        $denomination->status = 1;
        $denomination->save();

        /*Success Response*/
        if($denomination){
            return redirect()->route('denomination.index')->with('toast-success','Denomination created successfully.');
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
    /*For edit page of deomination */
    public function edit($id)
    {
        $data['page_title'] = "Edit Denomination";
        $denomination = ChurchType::where('id',getDecrypted($id))->first();
        if($denomination){
            return view('backend.denomination.edit',compact('denomination'))->with($data);
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
    /*For update deomination */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ],
      );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $denomination = ChurchType::find(getDecrypted($id));
        $denomination->name = $request->name;
        $denomination->display_order = $request->display_order;
        $denomination->status = isset($request->status)? 1 : 0;
        $denomination->save();

        if($denomination){
            return redirect()->route('denomination.index')->with('toast-success','Denomination updated successfully.');
        }else{
            return redirect()->back()->with('toast-error','Something went wrong.');
        }
    }

    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = ChurchType::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success','Denomination status updated successfully','Success');
        return response()->json(['status'=>"success",'message'=>'Denomination status updated  successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     * Delete deomination
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $denomination = ChurchType::select('id','is_delete')->find(getDecrypted($id));
        if($denomination){
            $denomination->is_delete=1;
            $denomination->save();
            \Session::flash('toast-success', 'Denomination deleted successfully');
            return response()->json(['status'=>"success",'message'=>'Denomination deleted successfully.']);
         }
    }

    public function isDenominationExists(Request $request)
    {
        $isValid = true;
        $message = '';

        $isExist = ChurchType::whereNotIn('id',[$request->id])->where('name','=',$request->name)->first();

        if($isExist){
            $isValid = false;
            $message = 'Denomination is already exists';
        }

        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }
}
