<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Auth\AuthController;
use App\Models\LoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseNewsController{

    public function loginView()
    {
        return view('user.login',$this->pageData);
    }

    /**
 * for login
 * @param  \Illuminate\Http\Request  $request
 * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
 */

    public function loginAttempt(Request $request){

        $email = $request->input("email");
        $password = $request->input("password");

        $validator = Validator::make($request->all(), array(
            'email' => 'required|email|max:255',
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
     * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
     */

    public function logout(){
        Auth::logout();
        $this->serviceResponse->responseStat->status = true;
        $this->serviceResponse->responseStat->msg = "Successfully logged out !";
        return $this->response();

    }

}