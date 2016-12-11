<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;


class Category extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    

    /**
     * @param mixed $category_name
     */
    public function setCategoryName($category_name) {
        $this->setObj($category_name);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "category_name";
            $errorObj->msg = "Category Name is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->category_name = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $status
     */
    public function setStatus($status) {        
        $this->status = $status;
        return true;
    }
    

    
    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by) {
         $this->setObj($created_by);

        if(!$this->basicValidation())
        {
            $errorObj = new ErrorObj();
            $errorObj->params = "created_by";
            $errorObj->msg = "*Created By is empty";
            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

        $this->created_by = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $updated_by
     */
    public function setUpdatedBy($updated_by) {
        $this->updated_by = $updated_by;
        return true;
    }
    
    
    public function insertCategory(){
        
        return $this->save();
    }
    
    public function getAllCategories(){
        $users=$this->All();

        if ($users==null)
            return null;

        return $users;
    }
    
    
    
    public function getCategoryById(){
        return $this::find($this->id);
    }
    
}