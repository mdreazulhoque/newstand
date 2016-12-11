<?php

namespace App\Http\Controllers;


use App\Models\EmailVerification;
use App\Models\LoginUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SignUpController extends BaseNewsController{

    public function registerUser(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'phone' => 'required|max:15',
            'dob' => 'required|max:55',
            'address' => 'required|max:150',
            'email' => 'required|email|max:255|unique:login_users',
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
                $loginUserModel->setEmail($request->input("email"));
                $loginUserModel->setPassword($request->input("password"));
                $loginUserModel->setRememberToken(hash('ripemd160',time()));

                if($loginUserModel->saveLoginUser()){

                    $emailVerificationModel = new EmailVerification();
                    $emailVerificationModel->setLoginUserId($loginUserModel->id);
                    $emailVerificationModel->setToken(hash('md5',time()));
                    $emailVerificationModel->setExpireDate(date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day')));
                    $emailVerificationModel->setStatus("Incompleted");

                    if($emailVerificationModel->saveEmailVerification()){
                        $this->serviceResponse->responseStat->status = true;
                        $this->serviceResponse->responseStat->msg = "User registration has been successfully completed.";
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