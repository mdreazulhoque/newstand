<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:37 PM
 */

namespace App\Models;


class Report extends BaseModel
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reports';
    
    public function  ReportResults() {
        return $this->belongsTo("App\Models\ReportResult","report_id","id");
    }
    
    public function Patients() {
        return $this->hasOne("App\Models\Patient", "id", "patient_id");
    }
    public function Doctors() {
        return $this->hasOne("App\Models\DOctor", "id", "doctor_id");
    }
    
    
    public function setId($id) {
        $this->id = $id;
    }
    
    /**
     * @param mixed $patient_id
     */
    public function setPatientId($patient_id) {
        $this->patient_id = $patient_id;
    }
    
    /**
     * @param mixed $doctor_id
     */
    public function setDoctorId($doctor_id) {
        $this->doctor_id = $doctor_id;
    }
    
    /**
     * @param mixed $issue_date
     */
    public function setIssueDate($issue_date) {
        $this->issue_date = $issue_date;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment) {
        $this->comment = $comment;
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

    public function insertReport($data){
        if($data->save()){
            return true;
        }
        return false;
    }
    
    public function getAllReports(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getReportById(){
        return $this::find($this->id);
    }
    
    
    
    public function DeleteReportById(){
       // return $this::destroy($this->id);
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }

}