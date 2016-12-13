<?php


namespace App\Models\DataModel;

class AppCredential{

    public $id;
    public $email;
    public $role;

    function __construct()
    {
        $this->email = "";
        $this->role = "";
        $this->id = 0;
    }
    public function castMe($obj)
    {
        if($obj!=null){
            $this->id = (int) $obj->id;
            $this->email = $obj->email;
            $this->role = $obj->role;
        }
    }
    public function castMeFromObj($obj)
    {

        if($obj!=null){
            $this->id = (int) $obj['id'];
            $this->email = $obj['email'];
            $this->role = $obj['role'];
        }
    }


}