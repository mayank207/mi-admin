<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    protected $limit;
    public function __construct()
    {
         /* limit of pagination in contact us module */
        $this->limit = 10;
    }

    public function index(Request $request,$id=null)
    {
        $data['page_title'] = "Contact Us List";
        $query = ContactUs::select('contact_us.*')->leftjoin('business_details','business_details.id','=','contact_us.business_id')->orderBy('contact_us.id','desc');
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('mobile_number', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('contact_us.description', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('business_details.business_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('business_details.business_email', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        if($id!=null){
            $query->where('business_id', getDecrypted($id));
        }
        $contact_us=$query->with('get_business_details')->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('components.contact_us_table',compact('contact_us'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.contact_us.index',compact('contact_us'))->with($data);
    }

    /* For bulk delete from contact_us table*/
    public function bulk_delete(Request $request)
    {
        $contacts_id = $request->input('selected_ids');
        $all_contacts = ContactUs::whereIn('id',$contacts_id)->select('id')->get();

        foreach ($all_contacts as $key => $contact) {
            $contact->delete();
        }
        $success_message = 'Selected Contacts deleted successfully';
        \Session::flash('toast-success',$success_message,'Success');
        return Response()->json(['success'=>true,'message'=>$success_message]);
    }
    /* For delete from contact_us table*/
    public function destroy($id,Request $request)
    {
        $contact = ContactUs::where('id',getDecrypted($id))->first();
        if($contact){
            $contact->delete();
            $success_message = 'Contact deleted successfully';
            \Session::flash('toast-success', $success_message);
            return response()->json(['status'=>"success",'message'=>$success_message]);
        }
        return response()->json(['status'=>"fail",'message'=>"Something went wrong."]);
    }
}
