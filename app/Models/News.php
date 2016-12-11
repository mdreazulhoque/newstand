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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

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

        $this->creatd_by = $this->getObj();
        return true;
    }
    
    /**
     * @param mixed $updated_by
     */
    public function setUpdatedBy($updated_by) {
        $this->updated_by = $updated_by;
        return true;
    }

    public function insertNews() {

        return $this->save();
    }

    public function getAllNews() {
        $users = $this->All();

        if ($users == null)
            return null;

        return $users;
    }

    public function getNewsById() {
        return $this::find($this->id);
    }

}
