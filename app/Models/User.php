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
   
    protected $hidden = array('password','remember_token');
    
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = bcrypt($password);
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

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone) {
        $this->phone = $phone;
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

    public function insertUser($data){
        if($data->save()){
            return true;
        }
        return false;
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
    
    
    
    public function DeleteUserById(){
       // return $this::destroy($this->id);
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }
}