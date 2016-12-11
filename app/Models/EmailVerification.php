<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;


class EmailVerification extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_verifications';
    
    /**
     * @param mixed $verification_link
     */
    public function setVerificationLink($verification_link) {        
        $this->setObj($verification_link);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "verification_link";
            $errorObj->msg = "varification link is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->verification_link = $this->getObj();
        return true;
    }

    /**
     * @param mixed $expire_date
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

        $this->creatd_by = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $updated_by
     */
    public function setUpdatedBy($updated_by) {
        $this->updated_by = $updated_by;
        return true;
    }
    
    
    public function insertEmailVerification(){
        
        return $this->save();
    }
    
    public function getAllEmailVerifications(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getEmailVerificationById(){
        return $this::find($this->id);
    }
    
}