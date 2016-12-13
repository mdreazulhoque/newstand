<?php


namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\BaseNewsController;
use App\Models\News;

class AdminNewsController extends BaseNewsController
{
    /**
     * show admin.all_news view
     * @return \Illuminate\View\View
     */
    public function getAllNews(){
        $newsModel=new News();
        $newsList=$newsModel->getAllNews();


        $this->pageData['newsList']=$newsList;

        return view('admin.all_news',$this->pageData);
    }

    /**
     * for publishing a news
     * @param  $newsId
     * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
     */

    public function publishNews($newsId){
        if (empty($newsId) || $newsId<1 || !is_numeric($newsId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $newsModel=new News();
        $newsModel->setId($newsId);

        $news= $newsModel->getNewsById();
        $news->setUpdatedBy($this->appCredential->id);

        if (empty($news)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $news->setStatus($newsModel->publish);


        if ($news->saveNews()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "News has been Published to the portal";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }
    }

    /**
     * for unpublishing a news
     * @param  $newsId
     * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
     */
    public function unpublishNews($newsId){
        if (empty($newsId) || $newsId<1 || !is_numeric($newsId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $newsModel=new News();
        $newsModel->setId($newsId);
        $news= $newsModel->getNewsById();
        $news->setUpdatedBy($this->appCredential->id);

        if (empty($news)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $news->setStatus($newsModel->unpublished);


        if ($news->saveNews()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "News has been unpublished from portal";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }
    }
    /**
     * for deleting a news
     * @param  $newsId
     * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
     */
    public function deleteNews($newsId){
        if (empty($newsId) || $newsId<1 || !is_numeric($newsId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $newsModel=new News();
        $newsModel->setId($newsId);
        $news= $newsModel->getNewsById();

        if (empty($news)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "News not found";
            return $this->response();
        }

        $news->setStatus($newsModel->deleted);
        $news->setUpdatedBy($this->appCredential->id);


        if ($news->saveNews()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "News has been Deleted Successfully";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }

    }

}