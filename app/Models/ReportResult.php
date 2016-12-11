<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:48 PM
 */

namespace App\Models;


class ReportResult extends BaseModel
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'doctors';
    
    public function Reports() {
        return $this->hasOne("App\Models\Report", "id", "report_id");
    }
    public function LabTests() {
        return $this->hasOne("App\Models\LabTest", "id", "lab_test_id");
    }
    
    
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @param mixed $result
     */
    public function setResult($result) {
        $this->result = $result;
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
    

    public function insertReportResult($data){
        if($data->save()){
            return true;
        }
        return false;
    }
    
    public function getAllReportResults(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getReportResultById(){
        return $this::find($this->id);
    }
    
    
    
    public function DeleteReportResultById(){
        return $this::destroy($this->id);
    }

}