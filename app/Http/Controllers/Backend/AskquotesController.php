<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AskQuote;
use Illuminate\Http\Request;

class AskquotesController extends Controller
{
    protected $limit;
    public function __construct()
    {
        $this->limit = 10;
    }

    public function index(Request $request,$id=null)
    {
        $data['page_title'] = "Ask Quotes List";
        $query = AskQuote::select('ask_quotes.*')->leftjoin('business_details','business_details.id','=','ask_quotes.business_id')->orderBy('ask_quotes.id','desc');
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('email', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('mobile_number', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('ask_quotes.description', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('business_details.business_name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('business_details.business_email', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        if($id){
            $query->where('ask_quotes.business_id', getDecrypted($id));
        }
        $ask_quotes=$query->with('get_business_details')->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('components.ask_quotes_table',compact('ask_quotes'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.ask_quotes.index',compact('ask_quotes'))->with($data);
    }

    public function bulk_delete(Request $request)
    {
        $quotes_id = $request->input('selected_ids');
        $all_quotes = AskQuote::whereIn('id',$quotes_id)->select('id')->get();

        foreach ($all_quotes as $key => $quote) {
            $quote->delete();
        }
        $success_message = 'Selected Quotes deleted successfully';
        \Session::flash('toast-success',$success_message,'Success');
        return Response()->json(['success'=>true,'message'=>$success_message]);
    }

    public function destroy($id,Request $request)
    {
        $quote = AskQuote::where('id',getDecrypted($id))->first();
        if($quote){
            $quote->delete();
            $success_message = 'Quote deleted successfully';
            \Session::flash('toast-success', $success_message);
            return response()->json(['status'=>"success",'message'=>$success_message]);
        }
        return response()->json(['status'=>"fail",'message'=>"Something went wrong."]);
    }
}
