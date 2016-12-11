<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:46 PM
 */

namespace App\Models;


class LabTestCategory extends BaseModel
{
   
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lab_test_categories';

    public function  labTests() {
        return $this->belongsTo("App\Models\LabTest","category_id","id");
    }
    
     
    public function setId($id) {
        $this->id = $id;
    }
    /**
     * @param mixed $category_name
     */
    public function setCategoryName($category_name) {
        $this->category_name = $category_name;
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

    
    
    public function insertLabTestCategory(){

        if($this->save()){
            return true;
        }
        return false;
    }

    
    
    public function getAllLabTestCategory(){
        $labTestCategory=$this->All();

        if ($labTestCategory==null)
            return null;

        return $labTestCategory;
    }
    
    
    
    public function getLabTestCategoryById(){
        return $this::find($this->id);
    }
    
    
    public function DeleteLabTestCategoryById(){
        //return $this::destroy($this->id);
        $this->status = "Deleted";
        if ($data->save()) {
            return TRUE;
        }
        return FALSE;
    }
}