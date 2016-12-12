<?php

/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/4/2016
 * Time: 1:49 PM
 */

namespace App\Models;

class News extends BaseModel {

    /**
     * The variables are enum values for status column for this table.
     *
     * @var string
     */
    public $pending = "Pending";
    public $publish = "Publish";
    public $unpublished = "Unpublished";
    public $deleted="Deleted";
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';
    
    public function user()
    {
        return $this->hasOne("App\Models\User","id","created_by");
    }
    public function category()
    {
        return $this->hasOne("App\Models\Category","id","category_id");
    }
    /**
     * @param mixed $category_id
     */
    public function setUserId($category_id) {
        $this->setObj($category_id);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "category_id";
            $errorObj->msg = "category id is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->category_id = $this->getObj();
        return true;
    }
    /**
     * @param mixed $news_title
     */
    public function setNewsTitle($news_title) {
        $this->setObj($news_title);
        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();

            $errorObj->params = "news_title";
            $errorObj->msg = "News Title is empty";

            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $this->news_title = $this->getObj();
        return true;
    }

    /**
     * @param mixed $news_slug
     */
    public function setNewsSlug($news_slug) {

        $this->setObj($news_slug);

        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();
            $errorObj->params = "news_slug";
            $errorObj->msg = "*news slug is empty";
            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }
        $news_slug1 = str_replace('\\', '', $news_slug);
        $news_slug2 = str_replace('/', '', $news_slug1);
        $news_slug3 = str_slug($news_slug2, "-");


        $this->news_slug = $news_slug3;
        return TRUE;
    }

    /**
     * @param mixed $photo_url
     */
    public function setPhotoUrl($photo_url) {

        $this->setObj($photo_url);

        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();
            $errorObj->params = "photo_url";
            $errorObj->msg = "*photo url is empty";
            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }

        $this->photo_url = $this->getObj();
        return true;
    }

    /**
     * @param mixed $news_content
     */
    public function setNewsContent($news_content) {

        $this->setObj($news_content);

        if (!$this->basicValidation()) {
            $errorObj = new ErrorObj();
            $errorObj->params = "news_content";
            $errorObj->msg = "*news content is empty";
            array_push($this->errorManager->errorObj, $errorObj);
            return false;
        }

        $this->news_content = $this->getObj();
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

    public function saveNews() {

        return $this->save();
    }

    public function getAllNews() {
        $allnews = $this->with("category", "user")
            ->orderBy('id', 'desc')
            ->get();

        if ($allnews == null)
            return null;

        return $allnews;
    }

    public function getNewsById() {
        return $this::find($this->id);
    }
    public function getAllPublishNews() {
        $allnews = $this->with("category", "user")
                        ->where("status", "Publish")
                        ->limit($this->customLimit)
                        ->offset($this->customLimit * $this->customOffset)
                        ->orderBy('id', 'desc')
                        ->get();

        if ($allnews == null) {
            return null;
        }
        
        return $allnews;
    }
    

}
