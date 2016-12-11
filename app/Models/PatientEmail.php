<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:34 PM
 */

namespace App\Models;


class PatientEmail extends BaseModel
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient_emails';
    
       
    public function Patients() {
        return $this->hasOne("App\Models\Patient", "id", "patient_id");
    }
    public function Reports() {
        return $this->hasOne("App\Models\Report", "id", "report_id");
    }
    
    
    public function setId($id) {
        $this->id = $id;
    }
    
    
    /**
     * @param mixed $subject
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body) {
        $this->body = $body;
    }
   
    

    public function insertPatientEmail($data){
        if($data->save()){
            return true;
        }
        return false;
    }
    
    public function getAllPatientEmails(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getPatientEmailById(){
        return $this::find($this->id);
    }
    
    
    
    public function DeletePatientEmailById(){
        return $this::destroy($this->id);
    }
}