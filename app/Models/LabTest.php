<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:31 PM
 */

namespace App\Models;


class LabTest extends BaseModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lab_tests';
    
    
    public function  ReportResults() {
        return $this->belongsTo("App\Models\ReportResult","lab_test_id","id");
    }
    
    public function labTestCategories() {
        return $this->hasOne("App\Models\LabTestCategory", "id", "category_id");
    }
    
    
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->category_name = $name;
    }
    
    /**
     * @param mixed $normal_value
     */
    public function setNormalValue($normal_value) {
        $this->normal_value = $normal_value;
    }
    /**
     * @param mixed $unit
     */
    public function setUnit($unit) {
        $this->unit = $unit;
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

    public function insertLabTest($data){
        if($data->save()){
            return true;
        }
        return false;
    }

    public function getAllLabTests(){
        $labTests=$this->All();

        if ($labTests==null)
            return null;

        return $labTests;
    }
    public function getLabTestById(){
        return $this::find($this->id);
    }
    public function DeleteLabTestById(){
        //return $this::destroy($this->id);
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }
}