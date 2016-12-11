<?php

namespace App\Http\Controllers;



use App\Models\EmailVerification;
use App\Models\LoginUser;

class EmailVerificationController extends BaseNewsController{
    
    public function verifyEmail($id){

        $emailVerificationModel = new EmailVerification();

        $emailVerificationModel->setToken($id);

        if($emailVerificationModel->getByToken() ==""){

            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Invalid Token";
            return $this->response();
        }

        $emailVerificationObj = $emailVerificationModel->getByToken();


        if(date("Y-m-d H:i:s")>$emailVerificationObj->expire_date){

            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Sorry your token is expired !";
            return $this->response();
        }

        $loginUserModel = new LoginUser();

        $loginUserModel->setId($emailVerificationObj->login_user_id);

        $loginUserObj = $loginUserModel->getLoginUserById();

        $loginUserObj->status = "Active";

        if($loginUserModel->updateLoginUser($loginUserObj)){

            $emailVerificationObj->status = "Completed";

            if($emailVerificationModel->updateEmailVerification($emailVerificationObj)){
                $this->serviceResponse->responseStat->status = true;
                $this->serviceResponse->responseStat->msg = "Successfully Verified !";
                return $this->response();
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