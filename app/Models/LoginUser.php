<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;


class LoginUser extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'login_users';
    protected $hidden = array('password','remember_token');
    /**
     * @param mixed $role
     */
    public function setRole($role) {        
        $this->setObj($role);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "role";
            $errorObj->msg = "Role is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->role = $this->getObj();
        return true;
    }
    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id) {
        $this->setObj($user_id);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "user_id";
            $errorObj->msg = "User id is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->user_id = $this->getObj();
        return true;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email,$constrains=true) {

        $this->setObj($email);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "email";
            $errorObj->msg = "*Email is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }
         
         if (!preg_match($this->email_validation_pattern, $email)) {
             $errorObj = new ErrorObj();
            $errorObj->params = "email";
            $errorObj->msg = "*Email is invalid";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;  
         }
        /*if($constrains){
            if($this->isDuplicateEmail($email)){
                $errorObj = new ErrorObj();
                $errorObj->params = "email";
                $errorObj->msg = "*Duplicate Email found !";
                array_push($this->errorManager->errorObj,$errorObj);
                return false;
            }
        }*/


        $this->email = $this->getObj();
        return TRUE;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password) {

        $this->setObj($password);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "password";
            $errorObj->msg = "Password is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }
        $this->password = bcrypt($password);
        return TRUE;
    }
    
    /**
     * @param mixed $status
     */
    public function setStatus($status) {        
        $this->status = $status;
        return true;
    }
    

    
    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by) {
         $this->setObj($created_by);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "created_by";
            $errorObj->msg = "*Created By is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

        $this->created_by = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $remember_token
     */
    public function setRememberToken($remember_token) {
        $this->remember_token = $remember_token;
        return true;
    }

    /**
     * @param mixed $updated_by
     */
    public function setUpdatedBy($updated_by) {
        $this->updated_by = $updated_by;
        return true;
    }


    /**
     * @ Check Unique $email
     */
    public function isDuplicateEmail($email){
        $data=$this::where('email',$email)->first();
        if(count($data)>0){
           return TRUE;
        }else{
           return FALSE;
        }
    }
    
    public function saveLoginUser(){
        
        return $this->save();
    }

    public function updateLoginUser($userLoginObj){

        if($userLoginObj->save()){
            return true;
        }
        return false;
    }
    
    public function getAllLoginUsers(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    public function getLoginUserById(){
        return $this::where('id',$this->id)->with("user_detail")->first();
    }

    public function getLoginUserByEmail(){

        return $this::where('email',$this->email)->first();
    }

    public function user_detail()
    {
        return $this->hasOne("App\Models\User","id","user_id");
    }
}