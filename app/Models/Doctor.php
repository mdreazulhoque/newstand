<?php

namespace App\Models;
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:22 PM
 */
class Doctor extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';
    
    public function users() {
        return $this->hasOne("App\Models\User", "id", "user_id");
    }
    
    
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    
    /**
     * @param mixed $last_name
     */
    public function setQualification($qualification) {
        $this->qualification = $qualification;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoomNo($room_no) {
        $this->room_no = $room_no;
    }

    /**
     * @param mixed $phone
     */
    public function setDeptName($dept_name) {
        $this->dept_name = $dept_name;
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

    public function insertDoctor($data){
        if($data->save()){
            return true;
        }
        return false;
    }
    
    public function getAllDoctors(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getDoctorById(){
        return $this::find($this->id);
    }
    
    
    
    public function DeleteDoctorById(){
       // return $this::destroy($this->id);
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }

}