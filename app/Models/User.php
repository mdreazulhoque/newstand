<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;


class User extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name) {
        $this->setObj($first_name);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "first_name";
            $errorObj->msg = "First Name is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->first_name = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name) {
        $this->setObj($last_name);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "last_name";
            $errorObj->msg = "Last Name is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->last_name = $this->getObj();
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
     * @param mixed $phone
     */
    public function setPhone($phone,$constrains=true) {

        $this->setObj($phone);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "phone";
            $errorObj->msg = "*Phone is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }
        if($constrains){
            if($this->isDuplicatePhone($phone)){
                $errorObj = new ErrorObj();
                $errorObj->params = "Phone";
                $errorObj->msg = "*Duplicate Phone found !";
                array_push($this->errorManager->errorObj,$errorObj);
                return false;
            }
        }

        $this->phone = $this->getObj();
        return true;
    }
     /**
     * @param mixed $dob
     */
    public function setDOB($dob) {

        $this->setObj($dob);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "dob";
            $errorObj->msg = "*Date of Birth is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

        $this->dob = $this->getObj();
        return true;
    }
    /**
     * @param mixed $address
     */
    public function setAddress($address) {

        $this->setObj($address);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "address";
            $errorObj->msg = "*Address is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

        $this->address = $this->getObj();
        return true;
    }
    

    
    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by) {
        
        $this->created_by = $created_by;
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
    /**
     * @ Check Unique $phone
     */
    public function isDuplicatePhone($phone){
        $data=$this::where('phone',$phone)->first();
        if(count($data)>0){
           return TRUE;
        }else{
           return FALSE;
        }
    }
    public function saveUser(){
        
        return $this->save();
    }
    
    public function getAllUsers(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getUserById(){
        return $this::find($this->id);
    }
    
}