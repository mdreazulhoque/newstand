<?php

namespace App\Http\Controllers;


use App\Models\EmailVerification;
use App\Models\LoginUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignUpController extends BaseNewsController{


    public function registrationView(){
        return view('user.registration',$this->pageData);
    }

    public function registerUser(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'phone' => 'required|max:15|unique:users',
            'birth_month' => 'required|max:2',
            'birth_day' => 'required|max:2',
            'birth_year' => 'required|max:4',
            'address' => 'required|max:150',
            'email' => 'required|email|max:255|unique:login_users',
        ]);
        if ($validator->fails()) {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

        $userModel = new User();

        $userModel->setFirstName($request->input("first_name"));
        $userModel->setLastName($request->input("last_name"));
        $userModel->setPhone($request->input("phone"));
        $userModel->setEmail($request->input("email"));
        $dob = $request->input("birth_year")."-".$request->input("birth_month")."-".$request->input("birth_day");
        $userModel->setDOB($dob);
        $userModel->setAddress($request->input("address"));

        $this->setError($userModel->errorManager->errorObj);

        if (!$this->hasError()) {
            if($userModel->saveUser()){

                $loginUserModel = new LoginUser();

                $loginUserModel->setUserId($userModel->id);
                $loginUserModel->setEmail($request->input("email"));
                $loginUserModel->setRememberToken(hash('ripemd160',time()));

                if($loginUserModel->saveLoginUser()){

                    $emailVerificationModel = new EmailVerification();
                    $emailVerificationModel->setLoginUserId($loginUserModel->id);
                    $token = hash('md5',time());
                    $emailVerificationModel->setToken($token);
                    $emailVerificationModel->setExpireDate(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day')));
                    $emailVerificationModel->setStatus("Incomplete");

                    if($emailVerificationModel->saveEmailVerification()){
                        $this->serviceResponse->responseStat->status = true;
                        $this->serviceResponse->responseStat->msg = "Registration successful, Verify email to login !";

                        //Verification Email

                        $to = $request->input("email");

                        $subject = "Verification email !";

                        $pageData['last_name'] = $request->input("last_name");
                        $pageData['token'] = $token;

                        $message = view('email.verification_mail',$pageData);

                        $emailControllerObj = new EmailController();
                        $emailControllerObj->sendEmail($to,$subject,$message);

                        
                        $this->serviceResponse->responseData = $loginUserModel->getLoginUserById();
                        return $this->response();
                    }else{
                        $this->serviceResponse->responseStat->status = false;
                        $this->serviceResponse->responseStat->msg = "Error in Email Verification";
                        return $this->response();
                    }

                }else{
                    $this->serviceResponse->responseStat->status = false;
                    $this->serviceResponse->responseStat->msg = "Error in login user";
                    return $this->response();
                }
            }

        }else{
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Error in saving User Details";
            return $this->response();
        }

        $this->serviceResponse->responseStat->status = false;
        $this->serviceResponse->responseStat->msg = "Error in Registration !";
        return $this->response();
    }



    public function registerAdmin(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'phone' => 'required|max:15',
            'dob' => 'required|max:55',
            'address' => 'required|max:150',
            'email' => 'required|email|max:255',
            'password' => 'required|max:150',
            'confirm_password' => 'required|max:150',


        ]);
        if ($validator->fails()) {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

        $userModel = new User();

        $userModel->setFirstName($request->input("first_name"));
        $userModel->setLastName($request->input("last_name"));
        $userModel->setPhone($request->input("phone"));
        $userModel->setEmail($request->input("email"));
        $userModel->setDOB($request->input("dob"));
        $userModel->setAddress($request->input("address"));

        $this->setError($userModel->errorManager->errorObj);

        if (!$this->hasError()) {
            if($userModel->saveUser()){

                $loginUserModel = new LoginUser();

                $loginUserModel->setUserId($userModel->id);
                $loginUserModel->setRole("Admin");
                $loginUserModel->setEmail($request->input("email"));
                $loginUserModel->setPassword($request->input("password"));
                $loginUserModel->setStatus("Active");
                $loginUserModel->setRememberToken(hash('ripemd160',time()));

                if ($loginUserModel->saveLoginUser()) {

                    $this->serviceResponse->responseStat->status = true;
                    $this->serviceResponse->responseStat->msg = "Admin registration has been successfully completed.";
                    $this->serviceResponse->responseData = $loginUserModel->getLoginUserById();
                    return $this->response();

                }else{
                    $this->serviceResponse->responseStat->status = false;
                    $this->serviceResponse->responseStat->msg = "Error in login user";
                    return $this->response();
                }
            }

        }else{
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Error in saving User Details";
            return $this->response();
        }

        $this->serviceResponse->responseStat->status = false;
        $this->serviceResponse->responseStat->msg = "Error in Registration !";
        return $this->response();
    }

}