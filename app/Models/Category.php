<?php


namespace App\Models;

class Category extends BaseModel
{

    /**
     * @The variables are enum values for status column for this table.
     *
     * @var string
     */
    public $inactive = "Inactive";
    public $active = "Active";
    public $deleted = "Deleted";

    /**
     * @The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * @for setting category
     * @param mixed $category_name
     * @param $category_name
     * @param $constrains=true
     * @return boolean
     */
    public function setCategoryName($category_name, $constrains = true)
    {
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
     * @param mixed $category_name
     * @param $category_name
     *
     * @return boolean
     */
    public function isDuplicateCategoryName($category_name)
    {
        $data = $this::where('category_name', $category_name)->where('status', '!=', 'Deleted')->first();
        if (count($data) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * set status
     * @param mixed $category_name
     * @param $status
     *
     * @return boolean
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return true;
    }

    /**
     * set created by
     * @param mixed $created_by
     *
     * @return boolean
     */
    public function setCreatedBy($created_by)
    {
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

    /**set updated by
     * @param mixed $updated_by
     *
     * @return boolean
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
        return true;
    }

    /**
     * create new or update category
     *
     * @return boolean
     */
    public function saveCategory()
    {
        return $this->save();
    }

    /**
     * get all category
     *
     * @return Category list
     */
    public function getAllCategories()
    {
        $categories = $this->All();

        if ($categories == null)
            return null;

        return $categories;
    }

    /**
     * get category by ID
     *
     * @return Category
     */
    public function getCategoryById()
    {
        return $this::find($this->id);
    }


    /**
     * get all Activated category
     *
     * @return Category
     */
    public function getAllActiveCategories()
    {
        $allcategories = $this::where("status", "Active")
            ->get();

        if ($allcategories == null) {
            return null;
        }

        return $allcategories;
    }



}
