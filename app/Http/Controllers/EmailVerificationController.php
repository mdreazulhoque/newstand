<?php

namespace App\Http\Controllers;



use App\Models\EmailVerification;
use App\Models\LoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
    
    public function getResendVerificationView(){
        return view('user.resend_email_verification');
    }
    
    public function sendResendVerificationLink(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }
        
        $loginUserModel = new LoginUser();
        $loginUserModel->setRole($request->input("role"));
        $loginUserModel->setEmail($request->input("email"),FALSE);
        
        $userObj = $loginUserModel->getLoginUserByEmail();
        
        if($userObj ==""){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Email not found !";
            return $this->response();
        }
        
        $emailVerificationModel = new EmailVerification();
        
        $emailVerificationModel->setLoginUserId($userObj->user_id);
        
        $emailVerificationObj = $emailVerificationModel->getByLoginUserId();
        
        $emailVerificationObj->setExpireDate(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day')));
        
        if($emailVerificationObj->saveEmailVerification()){
            
          $to = $request->input("email");

                        $subject = "Resend Verification email !";

                        $pageData['last_name'] = $userObj->last_name;
                        $pageData['token'] = $emailVerificationObj->token;

                        $message = view('email.verification_mail',$pageData);

                        $emailControllerObj = new EmailController();
                        $emailControllerObj->sendEmail($to,$subject,$message);
                        
                        $this->serviceResponse->responseStat->status = true;
                        $this->serviceResponse->responseStat->msg = "Successfully sent link, check your email !";
                        return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = FALSE;
                        $this->serviceResponse->responseStat->msg = "Error sending email!";
                        return $this->response();
        }
        
        $this->serviceResponse->responseStat->status = FALSE;
                        $this->serviceResponse->responseStat->msg = "Failed!";
                        return $this->response();
    }
    
}