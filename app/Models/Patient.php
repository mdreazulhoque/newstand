<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:33 PM
 */

namespace App\Models;


class Patient extends BaseModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patients';
    
    
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @ create Passcode
     */
    public function createPasscode() {
        return rand(10000, 1000000) . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10) . rand(10000, 1000000);
    }
    
    /**
     * @ Check Unique Passcode
     */
    public function CheckUniquePasscode($pass_code){

        $data=$this::where('pass_code',$pass_code)->first();
        if(count($data)>0){
           return TRUE;
        }else{
           return FALSE;
        }
    }
    
    /**
     * @ Check Unique Passcode
     */
    public function CheckUniqueEmail($email){

        $data=$this::where('email',$email)->first();
        if(count($data)>0){
           return TRUE;
        }else{
           return FALSE;
        }
    }
    /**
     * @param mixed $email
     */
    public function setRegNo($id) {
        $this->reg_no = 'lab_' . str_pad($id, 7, '0', STR_PAD_LEFT);
    }
     /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }
    
    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setPasscode($pass_code) {
        $this->pass_code = bcrypt($pass_code);
    }

    public function setPhoneNo($phone_no) {
        $this->phone_no = $phone_no;
    }

    public function setDOB($dob) {
        $this->dob = $dob;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function setAddress($address) {
        $this->address = $address;
    }
    
    /**
     * @param mixed $user_id
     */
    public function setCreatedBy($user_id) {
        $this->creatd_by = $user_id;
    }
    
    /**
     * @param mixed $user_id
     */
    public function setUpdatedBy($user_id) {
        $this->updated_by = $user_id;
    }
    
    /**
     * @param mixed $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }


    public function insertPatient($data) {
        if ($data->save()) {
            return TRUE;
        }

        return FALSE;
    }
    
    
    public function getAllPaients(){
        $paients=$this->All();

        if ($paients==null)
            return null;

        return $paients;
    }
    
    public function getPaientById(){
        return $this::find($this->id);
    }
    public function DeletePaientById(){
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }
}