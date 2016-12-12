<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseNewsController;
use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\LoginUser;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseNewsController{

    public function setPasswordView(){
        return view('user.email_verification');
    }

    public function setPassword($id,Request $request){

        $validator = Validator::make($request->all(), [
            'password' => 'required|max:50',
            'confirm_password' => 'required|max:50|same:password',

        ]);
        if ($validator->fails()) {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

        $emailVerificationModel = new EmailVerification();

        $emailVerificationModel->setToken($id);

        $emailVerificationObj = $emailVerificationModel->getByToken();

        if($emailVerificationObj ==""){

            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Invalid Token";
            return $this->response();
        }

        if(date("Y-m-d H:i:s")>$emailVerificationObj->expire_date){

            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Sorry your token is expired !";
            return $this->response();
        }

        $loginUserModel = new LoginUser();

        $loginUserModel->setId($emailVerificationObj->login_user_id);

        $loginUserObj = $loginUserModel->getLoginUserById();

        $loginUserObj->setPassword($request->input("password"));

        if ($loginUserObj->saveLoginUser()) {

            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "password successfully set!";
            //return redirect to a page to set password
            return $this->response();

        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "error in login user !";
            return $this->response();
        }

    }
}