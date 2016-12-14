<?php


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
     * setter for role
     * @param mixed $role
     * @return boolean
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
     * setter for user id
     * @param mixed $user_id
     * @return boolean
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
     * setter for email
     * @param mixed $email
     * @return boolean
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
        if($constrains){
            if($this->isDuplicateEmail($email)){
                $errorObj = new ErrorObj();
                $errorObj->params = "email";
                $errorObj->msg = "*Duplicate Email found !";
                array_push($this->errorManager->errorObj,$errorObj);
                return false;
            }
        }


        $this->email = $this->getObj();
        return TRUE;
    }
    /**
     * password setter using bcrypt
     * @param mixed $password
     * @return boolean
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
     * status setter
     * @param mixed $status
     * @return boolean
     */
    public function setStatus($status) {        
        $this->status = $status;
        return true;
    }
    

    
    /**
     * setter created by
     * @param mixed $created_by
     * @return boolean
     */
    public function setCreatedBy($created_by) {
       
        $this->created_by = $created_by;
        return true;
    }
    
    /**
     * setter for remember token
     * @param mixed $remember_token
     * @return boolean
     */
    public function setRememberToken($remember_token) {
        $this->remember_token = $remember_token;
        return true;
    }

    /**
     * setter for updated by
     * @param mixed $updated_by
     * @return boolean
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

    /**
     * create or update Login infromation of user
     *
     * @return boolean
     */
    public function saveLoginUser(){
        
        return $this->save();
    }

    /**
     * getter for user(All)
     *
     * @return LoginUser list
     */
    public function getAllLoginUsers(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }

    /**
     * getter for user(All)
     *
     * @return LoginUser list
     */
    public function getLoginUserById(){
        return $this::where('id',$this->id)->with("user_detail")->first();
    }
    /**
     * getter for user(All)
     *
     * @return LoginUser list
     */
    public function getLoginUserByEmail(){

        return $this::where('email',$this->email)->where('role',$this->role)->first();
    }
    /**
     * one to one relation with LoginUser table to User table
     */
    public function user_detail()
    {
        return $this->hasOne("App\Models\User","id","user_id");
    }
}