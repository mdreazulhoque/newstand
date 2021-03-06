<?php


namespace App\Models;

class News extends BaseModel
{

    /**
     * The variables are enum values for status column for this table.
     *
     * @var string
     */
    public $pending = "Pending";
    public $publish = "Publish";
    public $unpublished = "Unpublished";
    public $deleted = "Deleted";
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * one to one relation with user to news
     */
    public function user()
    {
        return $this->hasOne("App\Models\User", "id", "created_by");
    }

    /**
     * one to one relation with user to category
     */
    public function category()
    {
        return $this->hasOne("App\Models\Category", "id", "category_id");
    }

    /**
     * setter for who is publishing the news
     * @param mixed $currentUserId
     * @return boolean
     */
    public function setCurrentUserId($currentUserId)
    {
        parent::setCurrentUserId($currentUserId); // TODO: Change the autogenerated stub
    }

    /**
     * setter for category of the news
     * @param mixed $category_id
     * @return boolean
     */
    public function setUserCategoryId($category_id)
    {
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
     * setter for title of the news
     * @param mixed $news_title
     * @return boolean
     */
    public function setNewsTitle($news_title)
    {
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
     * auto generated news slug for each news frrom given news title
     * @param mixed $news_slug
     * @return boolean
     */
    public function setNewsSlug($news_slug, $constrains = true)
    {

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

        if ($constrains) {
            a:
            if ($this->isDuplicateSlug($news_slug3)) {
                $news_slug3 = $news_slug3 . "-";
                goto a;
            }
        }
        $this->news_slug = $news_slug3;
        return TRUE;
    }

    /**
     * @ Check Unique $news_slug
     */
    public function isDuplicateSlug($news_slug)
    {
        $data = $this::where('news_slug', $news_slug)->first();
        if (count($data) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**setter for photo path
     * @param mixed $photo_url
     * @return boolean
     */
    public function setPhotoUrl($photo_url)
    {

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

    /**setter for news content
     * @param mixed $news_content
     * @return boolean
     */
    public function setNewsContent($news_content)
    {

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
     * setter for status of the news
     * @param mixed $status
     * @return boolean;
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return true;
    }


    /**setter for created by
     * @param mixed $created_by
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

    /**
     * setter for updated by
     * @param mixed $updated_by
     * @return boolean
     */
    public function setUpdatedBy($updated_by)
    {
        $this->updated_by = $updated_by;
        return true;
    }


    /**
     * setter for slug by
     * @param mixed $slug
     * @return boolean
     */
    public function setSlugWhileGet($slug)
    {
        $this->news_slug = $slug;
        return true;
    }


    /**
     * create or update news
     * @return boolean
     */
    public function saveNews()
    {

        return $this->save();
    }


    /**
     * getter for news(All)
     * @return News
     */
    public function getAllNews()
    {

        $allnews = $this->with("category", "user")
            ->orderBy('id', 'desc')
            ->get();

        if ($allnews == null)
            return null;

        return $allnews;

        $news = $this->All();

        if ($news == null)
            return null;

        return $news;
    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getNewBySlug()
    {

        $allnews = $this->with("category", "user")
            ->where("status", "Publish")
            ->where('news_slug', $this->news_slug)
            ->limit($this->customLimit)
            ->offset($this->customLimit * $this->customOffset)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($allnews == null) {
            return null;
        }

        return $allnews;

    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getMyNewBySlug()
    {


        $allnews = $this->with("category", "user")
            ->whereIn("status", ["Publish", "Unpublished", "Pending"])
            ->where('news_slug', $this->news_slug)
            ->where('created_by', $this->currentUserId)
            ->limit($this->customLimit)
            ->offset($this->customLimit * $this->customOffset)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($allnews == null) {
            return null;
        }

        return $allnews;

    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getNewBySearch($search_val)
    {
        $allnews = $this->with("category", "user")
            ->where("status", "Publish")
            ->where('news_title', 'like', '%' . $search_val . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($allnews == null) {
            return null;
        }

        return $allnews;

    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getNewByCatId()
    {
        $allnews = $this->with("category", "user")
            ->where("status", "Publish")
            ->where('category_id', $this->category_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($allnews == null) {
            return null;
        }

        return $allnews;

    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getNewsById()
    {
        return $this::find($this->id);
    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getAllPublishNews()
    {
        $allnews = $this->with("category", "user")
            ->where("status", "Publish")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($allnews == null) {
            return null;
        }

        return $allnews;
    }

    /**
     * getter for news(All)
     * @return News
     */
    public function getAllNewsByUserId()
    {

        $allnews = $this->with("category", "user")
            ->whereIn("status", ["Publish", "Unpublished", "Pending"])
            ->where('created_by', $this->currentUserId)
            ->orderBy('id', 'desc')
            ->paginate(10);

        if ($allnews == null) {
            return null;
        }

        return $allnews;
    }


}
