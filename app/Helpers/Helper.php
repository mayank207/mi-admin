<?php

/* Encryption Id */
function getEncrypted($id){
    $encrypted_string=openssl_encrypt($id,config('services.encryption.type'),config('services.encryption.secret'));
    return base64_encode($encrypted_string);
}
/* Decryption Id */
function getDecrypted($id){
    $string=openssl_decrypt(base64_decode($id),config('services.encryption.type'),config('services.encryption.secret'));
    return $string;
}

/* Footer title */
function footer_title(){
    return "Copyright &copy; ".date('Y').' ' .env('APP_NAME').". All rights reserved.";
}


function customOrderBy($column_name = "", $orderby_val = "", $request_column = "", $column_title = "", $default_column = "", $default_val = "")
{
    if($column_title == ""){
        $column_title = ucwords(str_replace('_', ' ', $column_name));
    }
    if(($request_column == $column_name) || $default_column != ""){
        if($default_val != ""){
            $orderby_val = $orderby_val;
        }
        if($orderby_val == 'asc'){
            $cust_column = '<th class="orderby sorting sorting_asc" data-column="'.$column_name.'" data-orderby="'. $orderby_val .'">'. $column_title .'</th>';
        }else{
            $cust_column = '<th class="orderby sorting sorting_desc" data-column="'.$column_name.'" data-orderby="'. $orderby_val .'">'. $column_title .'</th>';
        }
    }else{
        $cust_column = '<th class="orderby sorting" data-column="'.$column_name.'" data-orderby="asc">'. $column_title .'</th>';
    }
    return $cust_column;
}

/* Active Sidebar */
function getActiveClass($routes = [],$is_default=0)
{
    $class = '';
    if(in_array(\Route::currentRouteName(), $routes)){
        $class = "active";
        if($is_default == 1){
            $class = "hover show";
        }elseif($is_default == 2){
            $class = "menu-active-bg";
        }
    }
    return $class;
}

/* Breadcrumb */
function setBreadCrumb($title,$url=null,$is_first=0){
    $html = '';
    if($is_first != 1){
        $html = '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>';
    }
    if($url != null){
        $html .='<li class="breadcrumb-item text-muted"> <a href="'.$url.'" class="text-muted text-hover-primary">'.$title.'</a></li>';
    }else{
        $html .='<li class="breadcrumb-item text-dark">'.$title.'</li>';
    }
    return $html;
}

function formatBytes($size, $precision = 2)
{
    if ($size > 0) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    } else {
        return $size;
    }
}

function get_microtime(){
	return round(microtime(true) * 1000);
}

function getCMSTitle($text){
    return ucfirst(str_replace('-',' ',$text));
}
