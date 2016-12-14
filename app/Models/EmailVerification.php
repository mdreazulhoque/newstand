<?php

namespace App\Models;


class EmailVerification extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_verifications';

    /**setter for logged in user id
     * @param $login_user_id
     * @return boolean
     */
    public function setLoginUserId($login_user_id) {
        $this->setObj($login_user_id);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "login user_id";
            $errorObj->msg = "Login User id is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->login_user_id = $this->getObj();
        return true;
    }
    
    /**
     * setter for token
     * @param mixed $verification_link
     * @return boolean
     */
    public function setToken($token) {
        $this->setObj($token);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "token";
            $errorObj->msg = "token is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->token = $this->getObj();
        return true;
    }

    /**
     * setter for expired date
     * @param mixed $expire_date
     * @return boolean
     */
    public function setExpireDate($expire_date) {
        $this->setObj($expire_date);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "expire_date";
            $errorObj->msg = "Expire Date is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->expire_date = $this->getObj();
        return true;
    }
    
    /**
     * setter for status
     * @param mixed $status
     * @return boolean
     */
    public function setStatus($status) {        
        $this->status = $status;
        return true;
    }
    

    
    /**
     * @param mixed $created_by
     * @param $created_by
     * @return boolean
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
     * setter for updated by
     * @param mixed $updated_by
     * @return boolean
     */
    public function setUpdatedBy($updated_by) {
        $this->updated_by = $updated_by;
        return true;
    }


    /**
     * create or update email verification data for new user
     * @return boolean
     */
    public function saveEmailVerification(){
        
        return $this->save();
    }

    /**
     *getter for email verification (All)
     * @return EmailVerification list
     */
    public function getAllEmailVerifications(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }

    /**
     *getter for email verification
     * @return EmailVerification
     */
    public function getByToken(){

        $emailVerificationObj = $this->where("token",$this->token)->where("status","Incomplete")->first();

        return $emailVerificationObj;


    }
    public function getByOnlyToken(){

        $emailVerificationObj = $this->where("token",$this->token)->first();

        return $emailVerificationObj;


    }

    /**
     *getter for email verification
     * @return EmailVerification list
     */
    public function getEmailVerificationById(){
        return $this::find($this->id);
    }

    /**
     *getter for email verification
     * @return EmailVerification list
     */
    public function getByLoginUserId() {
        $emailVerificationObj = $this->where("login_user_id",$this->login_user_id)->first();
        return $emailVerificationObj;
    }
    
}