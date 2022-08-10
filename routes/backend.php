<?php

use Illuminate\Support\Facades\Route;


Route::get('/backend', function () {
    return redirect('backend/login');
});
Route::prefix('backend')->group(function () {
    Route::match(['get','post'],'login', 'LoginController@login')->name('backend.login');
    Route::get('logout','LoginController@logout')->name('backend.logout');
});

Route::prefix('backend')->middleware(['backend'])->group(function () {

    Route::get('/dashboard', 'HomeController@index')->name('backend.home');

    //settings
    Route::match(['get','post'],'/account-setting/{id}', 'HomeController@account_setting')->name('admin.account_setting');

    // customer management route
    Route::resource('users', UserController::class);
    Route::post('users/update_status/{id}', 'UserController@status_update')->name('user.update_status');
    Route::post('users/bluk_update', 'UserController@bulk_updates')->name('user.bulk_updates');
    Route::post('users/email_exists', 'UserController@isEmailExists')->name('backend.user.email_exists');
    Route::post('users/username_exists', 'UserController@isUsernameExists')->name('backend.user.username_exists');
    Route::post('users/churchEmailExists', 'UserController@isChurchEmailExists')->name('backend.church.isChurchEmailExists');

    // business management route
     Route::resource('business', BusinessController::class);
     Route::post('business/update_status/{id}', 'BusinessController@status_update')->name('business.update_status');
     Route::post('business/bluk_update', 'BusinessController@bulk_updates')->name('business.bulk_updates');
     Route::post('business/upload_business_media/{id}', 'BusinessController@upload_business_media')->name('business.media_uploads');
     Route::post('business/update_approval_status/{id}', 'BusinessController@update_approval_status')->name('business.update_approval_status');
     Route::post('business/personal_details_update/{id}', 'BusinessController@personal_details_update')->name('business.personal_details_update');
     Route::post('business/business_email_exists', 'BusinessController@isbusinessEmailExists')->name('backend.business.email_exists');
     Route::post('business/fetch_sub_category', 'BusinessController@fetch_sub_category')->name('fetch_sub_category');
     Route::post('business/update_categories', 'BusinessController@update_categories')->name('business.update_categories');
     Route::post('business/media_destroy','BusinessController@busiess_media_delete')->name('business_media.destroy');

    //church Routes
    Route::resource('church', ChurchController::class);
    Route::post('church/update_status/{id}', 'ChurchController@status_update')->name('church.update_status');

    //pastors Routes
    // Route::resource('pastors', PastorsController::class);
    // Route::post('pastors/update_status/{id}', 'PastorsController@status_update')->name('pastors.update_status');
    
    //Category Routes
    // Route::resource('category', CategoryController::class);
    // Route::post('category/update_status/{id}', 'CategoryController@status_update')->name('category.update_status');
    // Route::post('category/category_exists', 'CategoryController@isCategoryExists')->name('isCategoryExists');

    //subCategory Routes
    Route::resource('business_services', SubCategoryController::class);
    Route::post('business_services/update_status/{id}', 'SubCategoryController@status_update')->name('sub_category.update_status');
    Route::post('business_services/sub_category_exists', 'SubCategoryController@isSubCategoryExists')->name('isSubCategoryExists');

    /* CMS Module RouteS */
    Route::get('cms-module', 'CmsController@index')->name('cms.module');
    Route::match(['GET','POST'],'cms-module/update/{key}', 'CmsController@update')->name('cms.update');

    /* Contact us RouteS */
    Route::get('contact_us/{id?}', 'ContactusController@index')->name('contact_us.index');
    Route::post('contact_us/bulk_delete', 'ContactusController@bulk_delete')->name('contact_us.bulk_delete');
    Route::delete('contact_us/destroy/{id}', 'ContactusController@destroy')->name('contact_us.destroy');


    /* Ask Quotes RouteS */
    Route::get('ask_quotes/{id?}', 'AskquotesController@index')->name('ask_quotes.index');
    Route::post('ask_quotes/bulk_delete', 'AskquotesController@bulk_delete')->name('ask_quotes.bulk_delete');
    Route::delete('ask_quotes/destroy/{id}', 'AskquotesController@destroy')->name('ask_quotes.destroy');

    /* Review RouteS */
    Route::post('all_review', 'BusinessController@business_all_review')->name('business.all_review');
    Route::delete('review/destroy/{id}', 'BusinessController@reviewDestroy')->name('review.destroy');
    Route::post('review/bulk_delete', 'BusinessController@review_bulk_delete')->name('review.bulk_delete');
    Route::get('review-search/{id}', 'BusinessController@reviewSearch')->name('review.search');

    //Denomination
    Route::resource('denomination', DenominationController::class);
    Route::post('denomination/update_status/{id}', 'DenominationController@status_update')->name('denomination.update_status');
    Route::post('denomination/denomination_exists', 'DenominationController@isDenominationExists')->name('isDenominationExists');
});
