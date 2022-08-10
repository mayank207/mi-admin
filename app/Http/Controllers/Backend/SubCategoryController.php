<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BusinessSubcategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit;
    /*For limit of pagination in the subcategory module */
    public function __construct()
    {
        $this->limit = 10;

    }

    public function index(Request $request)
    {
        $data['page_title']='Business Services List';
        $query = SubCategory::with('userDetails')->select('*')->orderBy('id','desc');
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('title', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
         /* Status filter */
         if ($request->get('status')) {
            if (!empty($request->status)) {
                $query->where('category_id', $request->get('status'));
            }
        }

        $categories=Category::where('status',1)->select('id','title')->get();
        $sub_categories=$query->paginate($this->limit)->appends($request->all());

        if($request->ajax()){
            $view = view('components.sub_category_table',compact('sub_categories'))->render();
            return response()->json(['status'=>200,'message'=>'','content'=>$view]);
        }
        return view('backend.sub_category.index',compact('sub_categories','categories'))->with($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Add Service';
        $categories = Category::where('status',1)->orderBy('title','asc')->select('*')->get();
        return view('backend.sub_category.add',compact('categories'))->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' =>  'required|unique:sub_categories,title',
        ],
        [
            'title.required' => 'Please enter service',
            'title.unique' => 'This service is already exsist',
        ]);
        /*Send failed response if request is not valid */
        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json(['status'=>"fail",'message'=>$validator->messages()->first()]);
            }else{
                return redirect()->back()->with('toast-error',$validator->messages()->first());
            }
        }
        /*store the subcategory on sub_categories table */
        $add = new SubCategory();
        $add->category_id = 0;
         /*Generate slug of sub category */
        $slug =  Str::slug( $request->title, '-');
    	$exists = SubCategory::where('slug',$slug)->first();
        if($exists){
            $slug = $slug.'-'.time();
        }else{
            $slug = $slug;
        }
        $add->slug =  $slug;

        $add->title = $request->title;
        $add->status = 1;
        $add->save();

        /*Success Response*/
        \Session::flash('toast-success','Service created successfully.');
        return redirect()->route('business_services.index');
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
        $data['page_title'] = "Edit Service";
        $sub_category = SubCategory::select('*')->find(getDecrypted($id));
        $categories = Category::where('status',1)->orderBy('title','asc')->select('*')->get();
        /*Success responce */
        if($sub_category){
            return view('backend.sub_category.edit',compact('sub_category','categories'))->with($data);
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
    /*update the subcategory on sub_categories table */
    public function update(Request $request, $id)
    {
        /*Check validation */
        $validator = \Validator::make($request->all(), [
            'title' =>  'required|unique:sub_categories,title,'.getDecrypted($id).',id',
        ],
        [
            'title.required' => 'Please enter service',
            'title.unique' => 'This service is already exsist',
        ]);
            $category = SubCategory::find(getDecrypted($id));
            /*update the subcategory slug */
            $slug =  Str::slug( $request->title, '-');
            $exists = SubCategory::where('slug',$slug)->first();
            if($exists){
                $slug = $slug.'-'.time();
            }else{
                $slug = $slug;
            }
            $category->slug =  $slug;
            $category->title = $request->title;
            $category->category_id=$request->category_id;
            $category->status = isset($request->status)? 1 : 0;
            $category->save();

            /*Success Response*/
            \Session::flash('toast-success','Service updated successfully.');
            if($request->ajax()){
                return response()->json(['status'=>"success",'redirect_url'=>route('business_services.index')]);
            }else{
                return redirect()->route('business_services.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*For delete subcategory*/
    public function destroy($id)
    {
        $exists= BusinessSubcategory::where('subcategory_id',getDecrypted($id))->count();
        if($exists>0){
            \Session::flash('toast-error', 'This subcategory can not delete, this category is assosiated with business');
            return response()->json(['status'=>"success",'message'=>'This subcategory can not delete, this category is assosiated with business']);
        }
        $delete = SubCategory::select('id')->find(getDecrypted($id));
        if($delete){
            /* Record Delete*/
            $delete->delete();
            \Session::flash('toast-success','Service deleted successfully.');
            return response()->json(['status'=>"success",'message'=>'Service deleted successfully.']);
         }
    }
    /*For update status of subcategory*/
    public function status_update(Request $request,$id){
        /* Record status update*/
        $status = SubCategory::select('id','status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success','Service status updated  successfully');
            return response()->json(['status'=>"success",'message'=>'Service status updated  successfully.']);
    }
    /*For check subcategory is exist or not (validation)*/
    public function isSubCategoryExists(Request $request){
        $isValid = true;
        $message = '';

        $query = SubCategory::select('id');
        if($request->has('id') && $request->id){
            $query = $query->whereNotIn('id',[$request->id]);
        }
        $services_exists = $query->where('title','=',$request->title)->first();

        if($services_exists){
            $isValid = false;
            $message = 'This service is already exists';
        }
        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }
}
