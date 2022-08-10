<?php

namespace App\Http\Controllers\Backend;
use Validator;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit;
    /* limit of pagination in category us module */
    public function __construct()
    {
        abort(404);
        $this->limit = 10;
    }

    public function index(Request $request)
    {
        $data['page_title'] = "Category List";
        $query = Category::select('*');
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('title', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        if($request->orderby != "" || $request->orderbycolumn != ""){
            $query = $query->orderBy($request->orderbycolumn,$request->orderby);
        }else{
            $query = $query->orderBy('id','desc');
        }
        $category=$query->paginate($this->limit)->appends($request->all());
        if($request->ajax()){
            $view = view('components.category_table',compact('category'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.category.index',compact('category'))->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = "Add Category";
        return view('backend.category.add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories,title',
        ],
        [
            'title.required' => 'Please enter category',
            'title.unique' => 'This category is already exsist',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['status'=>"fail",'message'=>$validator->messages()->first()]);
            }else{
                return redirect()->back()->with('alert-error',$validator->messages()->first());
            }
        }
        $add = new Category();

        $slug =  Str::slug( $request->title, '-');
    	$exists = Category::where('slug',$slug)->first();
    	if(isset($exists) && count($exists)){
    		$slug = $slug.'-'.time();
    	}else{
    		$slug = $slug;
    	}
        $add->slug =  $slug;

        $add->title = $request->title;
        $add->status = 1;
        $add->save();
        /*Success Response*/
        if($request->ajax()){
            \Session::flash('toast-success','Category created successfully.');
            return response()->json(['status'=>"success",'redirect_url'=>route('category.index')]);
        }else{
            return redirect()->route('category.index');
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
        $data['page_title'] = "Edit Category";
        $category = Category::select('*')->find(getDecrypted($id));
        if($category){
            return view('backend.category.edit',compact('category'))->with($data);
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories,title,'.getDecrypted($id).',id'
        ],
        [
            'title.required' => 'Please enter category',
            'title.unique' => 'This category is already exsist',
        ]);
        $category = Category::find(getDecrypted($id));

        $slug =  Str::slug( $request->title, '-');
    	$exists = Category::where('slug',$slug)->first();
    	if($exists){
    		$slug = $slug.'-'.time();
    	}else{
    		$slug = $slug;
    	}
        $category->slug =  $slug;

        $category->title = $request->title;
        $category->status = isset($request->status)? 1 : 0;
        $category->save();
        /*Success Response*/
        \Session::flash('toast-success','Category updated successfully.');
        if($request->ajax()){
            return response()->json(['status'=>"success",'redirect_url'=>route('category.index')]);
        }else{
            return redirect()->route('category.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exists= BusinessCategory::where('category_id',getDecrypted($id))->count();
        if($exists>0){
            \Session::flash('toast-error', 'This category can not delete, this category is assosiated with business');
            return response()->json(['status'=>"success",'message'=>'This category can not delete, this category is assosiated with business']);
        }

        $delete = Category::select('id')->find(getDecrypted($id));
        if($delete){
            /* Record Delete*/
            $delete->delete();
            \Session::flash('toast-success', 'Category deleted successfully');
            return response()->json(['status'=>"success",'message'=>'Category deleted successfully.']);
         }

    }
    /* For the update category status */
    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = Category::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success', 'Category status updated successfully');
        return response()->json(['status'=>"success",'message'=>'Category status updated successfully.']);
    }
    /* For the check business category is exist or not */
    public function isCategoryExists(Request $request){

        $isValid = true;
        $message = '';

        $isExist = Category::whereNotIn('id',[$request->id])->where('title','=',$request->title)->first();

        if($isExist){
            $isValid = false;
            $message = 'Category is already exists';
        }

        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }
}
