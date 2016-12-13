<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Auth\AuthController;
use App\Models\LoginUser;
use App\Models\DataModel\AppCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseNewsController{

    public function loginView()
    {
        return view('user.login',$this->pageData);
    }
    public function adminloginView()
    {
        return view('admin.login',$this->pageData);
    }

    /**
     * for login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function loginAttempt(Request $request){

        $email = $request->input("email");
        $password = $request->input("password");

        $validator = Validator::make($request->all(), array(
            'email' => 'required|email|max:255',
            'role' => 'required',
            'password' => 'required',
        ));

        if ($validator->fails())
        {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

        $loginUserModel = new LoginUser();
        $loginUserModel->setEmail($request->input("email"),false);
        $loginUserModel->setRole($request->input("role"));

        $loginUserObj = $loginUserModel->getLoginUserByEmail();


        if($loginUserObj==""){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Email doesn't exist";
            return $this->response();
        }

        if($loginUserObj->status!="Active"){

            if($loginUserObj->status=="Pending"){
                $this->serviceResponse->responseStat->status = false;
                $this->serviceResponse->responseStat->msg = "Sorry your email is not verified";
                return $this->response();
            }
            
            if($loginUserObj->status=="Banned"){
                $this->serviceResponse->responseStat->status = false;
                $this->serviceResponse->responseStat->msg = "Sorry your email is Banned";
                return $this->response();
            }
        }

        $auth = new AuthController();

        if($auth->authenticate($email,$password)){
            $user  = Auth::user();

            $appCredential = new AppCredential();
            $appCredential->castMe($user);

            Session::put('AppCredential', $user);
            return $this->response();
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->isLogin = true;
            $this->serviceResponse->responseStat->msg = "Login Successful";
            
            return $this->response();

        }
        $this->serviceResponse->responseStat->status = false;
        $this->serviceResponse->responseStat->msg = "Login Failed";
        return $this->response();

    }

    /**
     * For Logout
     * @return \Illuminate\Http\Response
     */

    public function logout(){
        Auth::logout();
        return redirect('home')->send();

    }
    

}