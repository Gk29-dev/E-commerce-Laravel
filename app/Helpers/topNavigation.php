<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

function getNavigation(){
    
    $TopNav =  DB::table('categories')->get();
    $html = '';
    foreach($TopNav as $TopNavCategories){

      $html.= '<li class="mx-3"><a href="/category/'.$TopNavCategories->category_slug.'">'.$TopNavCategories->category_name.'</a>';
    }
    return $html;
}


function countViewCart(){
  if(session()->has('LOGIN_USER_ID')){
    $uid = session()->get('LOGIN_USER_ID');
    $countProduct = DB::table('cart')->where('user_id',$uid)->count();
    return $countProduct;
  }
  else{
    return 0;
  }
}

?>