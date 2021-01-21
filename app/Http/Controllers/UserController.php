<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Session;

class UserController extends Controller
{

	public function index(){

		$result_products = DB::select("select pm.id as product_id, pm.product_title, pm.category_id,cm.category_name, pm.description, pm.price, pm.created_by, cr.id as cart_id , cr.user_id , cr.product_id as cart_product_id , (CASE WHEN(cr.id is null) THEN 'Add to Cart' ELSE 'Added' END) as add_to_cart
from products as pm 
INNER JOIN categories as cm on cm.id=pm.category_id
LEFT JOIN cart as cr on cr.product_id=pm.id");

		return view("user-dashboard" , ["result_products" => $result_products , "user_id" => Session::get('user_id')]);
	}

    public function user_register(){
    	return view('user-register');
    }

    public function validate_user_register(Request $request){

    	$response = array();

		if($request->name == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Customer Name";
		}elseif($request->email == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Email Id";
		}elseif($request->mobile == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Mobile Number";
		}elseif($request->password == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Password";
		}else{

			DB::select("insert into users(name, email, mobile, password) values('".$request->name."' , '".$request->email."' , '".$request->mobile."' , '".Hash::make($request->password)."')");
			$response["status"] = "success";
			$response["msg"] = "success";
		}

		echo json_encode($response);
    }

    public function add_to_cart(Request $request){

    	$response = array();

    	$cart_value_exist = DB::select("select * from cart where product_id='".$request->product_id."' and user_id='".$request->user_id."'");

    	if(count($cart_value_exist) == 0){
    		DB::select("Insert into cart (user_id , product_id) values ('".$request->user_id."','".$request->product_id."')");

    		$response["status"] = "added";
    	}else{
    		$response["status"] = "exist";
    	}

    	echo json_encode($response);
    }

    public function cart(){

    	$cart_data = DB::select("select pm.id as product_id, pm.product_title, pm.category_id,cm.category_name, pm.description, pm.price, pm.created_by, cr.id as cart_id , cr.user_id , cr.product_id as cart_product_id , (CASE WHEN(cr.id is null) THEN 'Add to Cart' ELSE 'Added' END) as add_to_cart
from products as pm 
INNER JOIN categories as cm on cm.id=pm.category_id
LEFT JOIN cart as cr on cr.product_id=pm.id");

    	return view('cart' , [ "cart_data" => $cart_data , "user_id" => Session::get('user_id') ]);
    }

    public function remove_from_cart(Request $request){

    	DB::select("delete from cart where id='".$request -> cart_id."'");

    	$response["status"] = "success";
    	echo json_encode($response);

    }

    public function place_order(Request $request){

    	$user_cart_data = DB::select("select * from cart where user_id='".$request->user_id."'");
    	$unique_order_id = time().uniqid();

    	foreach($user_cart_data as $cart_item){
    		DB::select("insert into orders(unique_order_id,user_id,product_id) values ('".$unique_order_id."','".$request->user_id."','".$cart_item->product_id."')");
    	}

    	DB::select("delete from cart where user_id='".$request->user_id."'");

    	$response["status"] = "success";
    	echo json_encode($response);
    }
}
