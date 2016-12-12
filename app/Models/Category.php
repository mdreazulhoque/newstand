<?php

/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;

class Category extends BaseModel {

    /**
     * The variables are enum values for status column for this table.
     *
     * @var string
     */
    public $inactive="Inactive";
    public $active="Active";
    public $deleted="Deleted";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * @param mixed $category_name
     */
    public function setCategoryName($category_name, $constrains = true) {
        $this->setObj($category_name);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "category_name";
            $errorObj->msg = "Category Name is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        if ($constrains) {
            if ($this->isDuplicateCategoryName($category_name)) {
                $errorObj = new ErrorObj();
                $errorObj->params = "category_name";
                $errorObj->msg = "*Duplicate Category Name found !";
                array_push($this->errorManager->errorObj, $errorObj);
                return false;
            }
        }
        $this->category_name = $this->getObj();
        return true;
    }

    /**
     * @ Check Unique $email
     */
    public function isDuplicateCategoryName($category_name) {
        $data = $this::where('category_name', $category_name)->where('status', '!=', 'Deleted')->first();
        if (count($data) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
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

        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();
            $errorObj->params = "created_by";
            $errorObj->msg = "*Created By is empty";
            array_push($this->errorManager->errorObj, $errorObj);
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

    public function saveCategory() {

        return $this->save();
    }

    public function getAllCategories() {
        $users = $this->All();

        if ($users == null)
            return null;

        return $users;
    }

    public function getCategoryById() {
        return $this::find($this->id);
    }

    public function updateCategory($data){
        return $data->save();

    }

}
