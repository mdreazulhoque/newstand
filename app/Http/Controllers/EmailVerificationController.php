<?php

namespace App\Http\Controllers;



use App\Models\EmailVerification;
use App\Models\LoginUser;
use Illuminate\Http\Request;


class EmailVerificationController extends BaseNewsController{
    
    public function verifyEmail($id,Request $request){

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

        $loginUserObj->setStatus("Active");

        if($loginUserObj->saveLoginUser()){

            $emailVerificationObj->setStatus("Completed");

            if($emailVerificationObj->saveEmailVerification()){
                $this->serviceResponse->responseStat->status = true;
                $this->serviceResponse->responseStat->msg = "Your Email is Successfully Verified !";
                //return redirect to a page to set password
                return redirect('user/password_set/view')->with('token',$id);
            }else{
                $this->serviceResponse->responseStat->status = true;
                $this->serviceResponse->responseStat->msg = "error in email verification !";
                return $this->response();
            }
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "error in login user !";
            return $this->response();
        }

        $this->serviceResponse->responseStat->status = false;
        $this->serviceResponse->responseStat->msg = "Failed to verify !";
        return $this->response();
        
        
    }
    
}