<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use Validator;
use Session;
use Hash;
 
class LoginController extends Controller{
    
	function index(Request $request){
        return view('admin-login'); 
    }

    function check_login(Request $request){
		$this->validate($request, [
			'username'   => 'required',
			'password'  => 'required'
		]);

		$result = DB::select("select id,username,password,role_id from admins where username='".$request->username."'");

		if(count($result) == 1){
			if(Hash::check($request->password,$result[0]->password)){

				$request->session()->flush();
                $request->session()->put('admin_id',$result[0]->id);
                $request->session()->put('username',$result[0]->username);
                $request->session()->put('role_id',$result[0]->role_id);
                
                return redirect('/admin-dashboard');
			}else{
				return back()->with('error', 'Wrong Password');
			}
		}else{
			return back()->with('error', 'Wrong Login Details');
		}

    }

    public function admin_logout(){
        session()->flush();
        return redirect('/admin-login');
    }

    public function generate_hash($text){
    	echo Hash::make($text);
    }

    function user_index(Request $request){
        return view('user-login'); 
    }

    function check_login_user(Request $request){
		$this->validate($request, [
			'email'   => 'required',
			'password'  => 'required'
		]);

		$result = DB::select("select id,email,password,role_id from users where email='".$request->email."'");

		if(count($result) == 1){
			if(Hash::check($request->password,$result[0]->password)){

				$request->session()->flush();
                $request->session()->put('user_id',$result[0]->id);
                $request->session()->put('role_id',$result[0]->role_id);
                
                return redirect('/user-dashboard');
			}else{
				return back()->with('error', 'Wrong Password');
			}
		}else{
			return back()->with('error', 'Wrong Login Details');
		}

    }

    public function user_logout(){
        session()->flush();
        return redirect('/user-login');
    }

}
