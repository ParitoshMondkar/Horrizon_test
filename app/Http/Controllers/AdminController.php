<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class AdminController extends Controller{
    
    public function index(){
    	return view('admin-dashboard');
    }

    public function add_categories(){

    	$result_categories = DB::select("select * from categories");
    	return view('add-categories' , ["result_categories" => $result_categories]);
    }

    public function validate_add_categories(Request $request){

    	$response = array();

		if($request->category == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Category Details";
		}else{

			DB::select("insert into categories(category_name) values('".$request->category."')");
			$response["status"] = "success";
			$response["msg"] = "success";
		}

		echo json_encode($response);
    }

    public function add_products(){

    	$result_categories = DB::select("select * from categories");

    	$result_products = DB::select("select pm.id as product_id, pm.product_title, pm.category_id,cm.category_name, pm.description, pm.price, pm.created_by , ad.username
from products as pm 
INNER JOIN categories as cm on cm.id=pm.category_id
INNER JOIN admins as ad on ad.id=pm.created_by
where pm.created_by='".Session::get('admin_id')."'");
    	return view('add-products' , ["result_categories" => $result_categories,"result_products"=>$result_products]);
    }

    public function validate_add_products(Request $request){

    	$response = array();

		if($request->product_title == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Product Title";
		}elseif($request->category_id == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Select Category Details";
		}elseif($request->description == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Valid Description";
		}elseif($request->price == ""){
			$response["status"] = "error";
			$response["msg"] = "Please Enter Price Details";
		}
		else{

			DB::select("insert into products(product_title, category_id, description, price, created_by) values('".$request->product_title."','".$request->category_id."','".$request->description."','".$request->price."','".Session::get('admin_id')."')");
			$response["status"] = "success";
			$response["msg"] = "success";
		}

		echo json_encode($response);
    }

    public function order_list(){

    	$order_data = DB::select("select pm.id as product_id, pm.product_title, pm.category_id,cm.category_name, pm.description, pm.price ,ord.unique_order_id , us.`name` as CustomerName
from products as pm 
INNER JOIN categories as cm on cm.id=pm.category_id
INNER JOIN orders as ord on ord.product_id=pm.id
INNER JOIN users as us on us.id=ord.user_id");

    	return view( "order-list" , [ "order_data" => $order_data ] );
    }

}
