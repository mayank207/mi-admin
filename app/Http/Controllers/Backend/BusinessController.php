<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\BusinessMedia;
use App\Models\BusinessDetail;
use App\Models\SocialMediaLink;
use App\Models\BusinessCategory;
use App\Models\BusinessRevision;
use App\Models\BusinessSubcategory;
use App\Http\Controllers\Controller;
use App\Models\BusinessReview;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $limit;
    /* limit of pagination in business module */
    public function __construct()
    {
        $this->limit = 10;
    }

    public function index(Request $request,$status=null)
    {
        $data['page_title'] = "Business List";
        $query = BusinessDetail::with('get_revision')->select('business_details.*')
            ->where('business_details.is_delete', 0)
            ->join('users', 'business_details.user_id', '=', 'users.id');

        /* search Filter */
        if ($request->has('search_keyword') && $request->search_keyword != "") {
            $query = $query->where(function ($q) use ($request) {
                $q->where('business_details.business_name', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('business_details.business_email', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('business_details.city', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('business_details.state', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('users.first_name', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('users.last_name', 'LIKE', '%' . $request->search_keyword . '%');
                $q->orWhere('users.email', 'LIKE', '%' . $request->search_keyword . '%');
            });

        }
        if ($request->orderby != "" || $request->orderbycolumn != "") {
            $query = $query->orderBy($request->orderbycolumn, $request->orderby);
        } else {
            $query = $query->orderBy('business_details.id', 'desc');
        }
        /* From & To Date filter */
        if ($request->get('fromdate')) {
            $from_date = Carbon::createFromFormat('m-d-Y', $request->get('fromdate'))->format('Y-m-d');
            $to_date = Carbon::createFromFormat('m-d-Y', $request->get('todate'))->format('Y-m-d');
            if ($request->get('fromdate') != 0) {
                $query->whereBetween('business_details.created_at', [$from_date . ' 00:00:00', $to_date . ' 23:59:59']);
            }
        }
        /* Status filter */
        if (!is_null($request->status)) {
                $query->where('business_details.status', $request->status);
        }
        /*filter of clicks on dashboard cards (pending & approved businesses)*/ 
        if(isset($_GET['approval_status'])){
            if($_GET['approval_status'] == 1){
                $query->leftJoin('business_revisions','business_revisions.business_id','business_details.id');
                $query->where('business_details.is_approved',1)->whereNull('business_revisions.is_approved');
            }else{
                $query->where(function($q){
                    $q->where('business_details.is_approved',0)->orWhere('business_details.is_business_revision',1);
                });
            }
        }
        if ($request->subscription_status && $request->subscription_status=='1') {
            $query->leftJoin('subscribe_users','subscribe_users.user_id','=','business_details.user_id');
            $query->where('subscribe_users.end_date','>=',Carbon::now());
        }   

        $users = $query->paginate($this->limit)->appends($request->all());
        /* Ajax search*/
        if ($request->ajax()) {
            $view = view('components.business_table', compact('users'))->render();
            return response()->json(['status' => 200, 'message', 'content' => $view]);
        }
        return view('backend.business.index', compact('users'))->with($data);
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
     * For the show all business details in the view page.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business_details = BusinessDetail::where('is_delete', 0)->find(getDecrypted($id));
        $user_category = "";
        $sub_categories=[];
        $business_sub_categories=[];
        $business_revision = null;
        $user_subcategory = null;

        if($business_details != null){
            $business_revision = BusinessRevision::where('business_id',$business_details->id)->where('user_id',$business_details->user_id)->where('is_approved','!=',1)->first();
            if($business_revision){
                $business_details->business_name = $business_revision->business_name;
                $business_details->sort_description = $business_revision->sort_description;
                $business_details->description = $business_revision->description;
                $business_details->address = $business_revision->address; 
                if($business_details->sub_category != ""){
                    $user_subcategory = explode(",",$business_revision->sub_category);
                }
                $business_details->is_approved = $business_revision->is_approved;
                $business_details->reject_reason = $business_details->reject_reason;
            }
        }

            if($user_subcategory == null){
                $business_sub_categories = BusinessSubcategory::select('subcategory_id')
                ->where('user_id',$business_details->user_id)
                ->pluck('subcategory_id')
                ->toArray();
            }else{
                $business_sub_categories = $user_subcategory;
            }

            $business_details->sub_categories = SubCategory::select('id','title','category_id')->whereIn('status',[1,2])
            ->whereIn('id',$business_sub_categories)
            ->get();

            $business_details->country = Country::where('id',$business_details->country_id)->first();
        // }

        $page_title = "View";
        return view('backend.business.view', compact('business_details','page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = "Edit Business";
        $business = BusinessDetail::with('contact_us','ask_quotes','church_details')->where('is_delete', 0)->find(getDecrypted($id));
        $reviews = BusinessReview::where('business_id',getDecrypted($id))->paginate($this->limit);
        $country =  Country::where(function($q){
            $q->where('phone','!=','+1');
            $q->orWhere('code','US');
        })->get();
        $categories = Category::select('*')->where('status', 1)->orderBy('title','asc')->get();
        $sub_categories = [];
        $business_sub_categories = "";
        $secondary_sub_category= "";
        $secondary_subcategory ="";
        $secondary_category = "";
        $user_subcategory = "";
        $user_category ="";
        $secondary_sub_categories= [];
        if($business != null && $business->is_approved == 1){
            $business_revision = BusinessRevision::where('business_id',$business->id)->where('user_id',$business->user_id)->where('is_approved','!=',1)->first();
            if($business_revision){
                $business->business_name = $business_revision->business_name;
                $business->sort_description = $business_revision->sort_description;
                $business->description = $business_revision->description;
                $business->address = $business_revision->address;
                if($business->sub_category != ""){
                    $user_subcategory = explode(",",$business_revision->sub_category);
                }
                $business->is_approved = $business_revision->is_approved;
                $business->reject_reason = $business_revision->reject_reason;
            }
        }

            $sub_categories = SubCategory::whereIn('status',[1,2])->orderBy('title','asc')->select('*')->get();

            if($user_subcategory == null){
                $business_sub_categories = BusinessSubcategory::select('subcategory_id')
                ->where('is_primary',1)
                ->where('user_id',$business->user_id)
                // ->where('category_id',$business->category->category_id)
                ->pluck('subcategory_id')
                ->toArray();
            }else{
                $business_sub_categories = $user_subcategory;
            }

        return view('backend.business.edit', compact('business', 'country', 'categories', 'sub_categories', 'business_sub_categories','secondary_sub_categories','reviews','user_category','user_subcategory','secondary_category','secondary_subcategory'))->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, SubCategory $sub_category)
    {
        $validator = $request->validate(
            [
                'business_name' => 'required',
                'business_email' => 'required|email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/|unique:business_details,business_email,' . getDecrypted($id) . ',id',
                'business_mobile_number' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'address' => 'required',
                'sort_description' => 'required',
                'description' => 'required',
            ],
            [
                'business_name.required' => 'Please enter business name',
                'business_email.required' => 'Please enter business email',
                'business_email.unique' => 'Email Already exists',
                'business_email.regex' => 'Enter valid email',
                'business_mobile_number.required' => 'please enter mobile number',
                'country.required' => 'Please enter country',
                'city.required' => 'Please enter city',
                'state.required' => 'Please enter state',
                'zip_code.required' => 'Please enter zip',
            ]
        );

        $business = BusinessDetail::where('is_delete', 0)->where('id', getDecrypted($id))->first();
        if($business){
            /* Approved and main business still pending */
            if($request->is_approved == 1 || $business->is_approved != 1){
                $business->business_name = $request->business_name;
                $business->description = $request->description;
                $business->sort_description = $request->sort_description;
                $business->is_business_revision= 0;
                $business_sub_cate_ids = [];
          
                /*update Subcategory category*/
                if ($request->business_sub_category) {
                    $business_sub_categories = BusinessSubcategory::select('subcategory_id')->where('user_id', $request->user_id)->pluck('subcategory_id')->toArray();
                    
                    foreach ($request->business_sub_category as $sub_category_id) {
                        if (!in_array($sub_category_id, $business_sub_categories)) {
                            $sub_category = new BusinessSubcategory;
                            $sub_category->user_id = $request->user_id;
                            $sub_category->category_id = 0;
                            $sub_category->subcategory_id = $sub_category_id;
                            $sub_category->is_approved = 1;
                            $sub_category->is_primary = 1;
                            $sub_category->save();
                            $business_sub_cate_ids[] = $sub_category_id;
                        } else {
                            $business_sub_cate_ids[] = $sub_category_id;
                        }
                    }
                    BusinessSubcategory::whereNotIn('subcategory_id', $business_sub_cate_ids)->where('is_primary',1)->where('user_id', $request->user_id)->delete();
                }
                /*END::update Subcategory category*/


                if($request->is_approved == 1){
                    /* Business is approved */
                    $business->is_approved = 1;
                    /* Remove revision if exists */
                    BusinessRevision::where('business_id',$business->id)->where('user_id',$business->user_id)->delete();
                }elseif($request->is_approved == 2){
                    $business->is_approved = 2;
                }else{
                    $business->is_approved = 0;
                }
            }


            if($request->is_approved != 1){
                /* Reject and Pending status */
                $business_revision = BusinessRevision::where('business_id',$business->id)->where('user_id',$business->user_id)->first();
                if(!$business_revision){
                    $business_revision = new BusinessRevision;
                }
                $business_revision->business_id = $business->id;
                $business_revision->user_id = $business->user_id;
                $business_revision->business_name = $request->business_name;
                $business_revision->sort_description = $request->sort_description;
                $business_revision->description = $request->description;
                if($request->business_sub_category != null){
                    $business_revision->sub_category = implode(",",$request->business_sub_category);
                }
                if($request->is_approved == 2){
                    $business_revision->is_approved = 2;
                    $business_revision->is_approved = 2;
                }else{
                    $business_revision->is_approved = 0;
                }
                $business_revision->save();
            }

            $business_mobile_number=preg_replace('/[^0-9]/', '', $request->business_mobile_number);
            /* Update business details */
            $business->business_email = $request->business_email;
            $business->business_mobile_number = $business_mobile_number;
            $business->state = $request->state;
            $business->city = $request->city;
            $business->country_code = $request->business_country_code;
            $business->zip_code = $request->zip_code;
            $business->country_id = $request->country;
            $business->address=$request->address;
            $business->latitude=$request->latitude;
            $business->longitude=$request->longitude;
            $business->address_2=$request->address_2;
            $business->website_url = $request->website_url;
            $business->save();

            /* Update business social medias */
            $business_links = SocialMediaLink::where('business_id', $request->user_id)->first();
            if ($business_links) {
                $business_links->facebook_url = $request->facebook_url;
                $business_links->twitter_url = $request->twitter_url;
                $business_links->instagram_url = $request->instagram_url;
                $business_links->linked_in_url = $request->linked_in_url;
                $business_links->save();
            }
            return redirect()->route('business.index')->with('toast-success', "Business updated successfully.");
        }
        return redirect()->route('business.index')->with('toast-error', 'Something went wrong.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* delete business*/
        $delete = BusinessDetail::select('id')->find(getDecrypted($id));
        if ($delete) {
            /* Record Delete*/
            $delete->is_delete = 1;
            $delete->save();
            \Session::flash('toast-success', 'Business deleted successfully');
            return response()->json(['status' => "success", 'message' => 'Business deleted successfully.']);
        }
    }
    /*For bulk update on business status*/
    public function bulk_updates(Request $request)
    {
        $status = $request->input('status');
        $user_ids = $request->input('user_ids');
        if ($status != '') {
            $all_users = BusinessDetail::whereIn('id', $user_ids)->select('id', 'status')->get();

            foreach ($all_users as $key => $users) {
                $users->status = $request->input('status');
                $users->save();
            }
            \Session::flash('toast-success', 'business status updated successfully');
            return Response()->json(['success' => true, 'message' => 'All business status updated successfully']);
        } else {
            return Response()->json(['success' => false, 'message' => 'Some thing went wrong']);
        }
    }
    /* For update status of business */
    public function status_update(Request $request, $id)
    {
        /* Record status update*/
        $status = BusinessDetail::select('id', 'status')->find(getDecrypted($id));
        $status->status = $request->status;
        $status->save();
        \Session::flash('toast-success', 'Business status updated successfully');
        return response()->json(['status' => "success", 'message' => 'Business status updated  successfully.']);
    }
    /* For upload photos of business */
    public function upload_business_media(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $media = new BusinessMedia();
        $image = $request->file('file');
        $imageName = md5(time() . rand()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path() . '/uploads/business_images', $imageName);
        $media->type     = 'photos';
        $media->media_type = $image->getClientMimeType();
        $media->user_id = getDecrypted($id);
        $media->media_url = $imageName;
        $media->is_approved = '1';
        $media->save();
        return response()->json(['success' => $imageName]);
    }
    /*For update_approval_status */
    public function update_approval_status(Request $request, $id)
    {
        $business = BusinessDetail::find(getDecrypted($id));
        $status = false;
        $message = "Something went wrong.";
        if($business){
            $business_revision = BusinessRevision::where('business_id',$business->id)->where('user_id',$business->user_id)->first();
            if($business_revision){
                if($request->approve_status == 1){
                    $business=BusinessDetail::where('id',$business->id)->first();
                    $business->is_business_revision =0;
                    $business->save();
                    BusinessDetail::approvedBusiness($business,$business_revision);
                    $message = "Business approved successfully";
                    $business_revision->delete();
                }else{
                    $business_revision->reject_reason = $request->reject_reason;
                    $message = "Business rejected successfully";
                    $business_revision->is_approved = 2;
                    $business_revision->save();
                }
                $status = "success";
                \Session::flash('toast-success', $message);
            }
        }else{
            \Session::flash('toast-error', $message);
        }
        return response()->json(['status' => $status, 'message' => $message]);
    }
    /*For update personal details of business customer */
    public function personal_details_update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required|min:10|numeric',
            'email' => 'email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/|unique:users,email,' . getDecrypted($id)

        ]);
        $user = User::where('id', getDecrypted($id))->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country_code = $request->country_code;
        $user->mobile_number = $request->mobile_number;
        $user->save();
        return redirect()->back()->with('toast-success', 'User details updated successfully.');
    }
    /*For check the business email is exist or not(validation)*/
    public function isbusinessEmailExists(Request $request)
    {
        $isValid = true;
        $message = '';

        $isExist = BusinessDetail::whereNotIn('id', [$request->id])->where('business_email', $request->business_email)->first();
        if ($isExist) {
            $isValid = false;
            $message = 'Email is already exists';
        }

        return response()->json([
            'valid' => $isValid,
            'message' => $message
        ]);
    }
    /*fetch sub category for edit business page */
    public function fetch_sub_category(Request $request)
    {
        $data['sub_category'] = SubCategory::where('status',1)->orderBy('title','asc')->where("category_id", $request->id)
            ->get(["title", "id"]);
        return response()->json($data);
    }
    /* update business category */
    public function update_categories(Request $request)
    {
        $business_sub_cate_ids = [];
        /*update category category*/
        if ($request->business_category == null) {
            $category  = BusinessCategory::where('user_id', $request->user_id)->where('is_primary',1)->first();
            if ($category != null) {
                $category->delete();
            }
        }
        if (!empty($request->business_category)) {
            $category  = BusinessCategory::where('user_id', $request->user_id)->where('is_primary',1)->first();
            if ($category == null) {
                $category = new BusinessCategory;
            }
            $category->user_id = $request->user_id;
            $category->category_id = $request->business_category;
            $category->category_id = 1 ;
            $category->save();
        }
        /*update sub category category*/
        if ($request->business_sub_category) {
            $business_sub_categories = BusinessSubcategory::select('subcategory_id')->where('user_id', $request->user_id)->where('category_id', $request->business_category)->pluck('subcategory_id')->where('is_primary',1)->toArray();

            foreach ($request->business_sub_category as $sub_category_id) {
                if (!in_array($sub_category_id, $business_sub_categories)) {
                    $sub_category = new BusinessSubcategory;
                    $sub_category->user_id = $request->user_id;
                    $sub_category->category_id = $request->business_category;
                    $sub_category->subcategory_id = $sub_category_id;
                    $sub_category->is_approved = '1';
                    $sub_category->save();
                    $business_sub_cate_ids[] = $sub_category_id;
                } else {
                    $business_sub_cate_ids[] = $sub_category_id;
                }
            }
            BusinessSubcategory::whereNotIn('subcategory_id', $business_sub_cate_ids)->where('category_id', $request->business_category)->where('user_id', $request->user_id)->delete();
        }
        /*Delete old category*/
        return redirect()->back()->with('toast-success', 'Business categories updated successfully.');
    }
    /*For delete business media */
    public function busiess_media_delete(Request $request)
    {
        $business_images =BusinessMedia::where('id',$request->id)->delete();
        if($business_images){

            return response()->json(['status'=>"success",'message'=>'Business media deleted successfully.']);
        }
        else{
            return response()->json(['status'=>"failure",'message'=>'Something went wrong.']);
        }
    }
     /*For delete business review */
    public function reviewDestroy($id,Request $request)
    {
        $review = BusinessReview::where('id',getDecrypted($id))->first();
        if($review){
            $review->delete();
            $success_message = 'Review deleted successfully';
            \Session::flash('toast-success', $success_message);
            return response()->json(['status'=>"success",'message'=>$success_message]);
        }
        return response()->json(['status'=>"fail",'message'=>"Something went wrong."]);
    }
    /*For delete business review in bulk*/
    public function review_bulk_delete(Request $request)
    {
        $reviews_id = $request->input('selected_ids');
        $all_reviews = BusinessReview::whereIn('id',$reviews_id)->select('id')->get();

        foreach ($all_reviews as $key => $review) {
            $review->delete();
        }
        $success_message = 'Selected reviews deleted successfully';
        \Session::flash('toast-success',$success_message,'Success');
        return Response()->json(['success'=>true,'message'=>$success_message]);
    }
    /*For searching business review*/
    public function reviewSearch(Request $request,$id)
    {
        $business =BusinessDetail::select('id')->where('id',getDecrypted($id))->first();
        $query = BusinessReview::select('business_reviews.*','users.name')->leftjoin('users','users.id','=','business_reviews.user_id')->where('business_reviews.business_id',getDecrypted($id));
        if($request->has('search_keyword') && $request->search_keyword != ""){
            $query = $query->where(function($q) use($request){
                $q->where('users.name', 'LIKE', '%'.$request->search_keyword.'%');
                $q->orWhere('comment', 'LIKE', '%'.$request->search_keyword.'%');
            });
        }
        $reviews=$query->paginate($this->limit)->appends($request->all());
        $view = view('backend.business.review_list',compact('reviews','business'))->render();
        return response()->json(['status'=>200,'message'=>'','content'=>$view]);
    }
    /*For listing of single business all review*/
    public function business_all_review(Request $request)
    {
        $business =BusinessDetail::select('id')->where('id',getDecrypted($request->user_id))->first();
        $reviews = BusinessReview::where('business_id',getDecrypted($request->user_id))->paginate($this->limit);
        $view = view('backend.business.review_table',compact('reviews','business'))->render();
        return response()->json(['status'=>200,'message'=>'','content'=>$view]);
    }

}
