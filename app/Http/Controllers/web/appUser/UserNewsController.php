<?php

namespace App\Http\Controllers\web\appUser;

use App\Http\Controllers\BaseNewsController;
use App\Models\News;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserNewsController extends BaseNewsController
{
    //
    public function getAllNewsView(){
        $newsModel=new News();
        $this->pageData['newsList']=$newsModel->getAllNews();
        return $this->pageData['newsList'];

    }
    public function getNewsBySlugView(){

        $slug="guis4567";
        $newsModel=new News();
        if($newsModel->setSlugWhileGet($slug)){
            $newsModel->getNewBySlug();
        }

    }
    public function getNewByUserIdView(){
        $userID=1;
        $newsModel=new News();
        $newsModel->setCurrentUserId($userID);
        $this->pageData['newsList']=$newsModel->getAllNewsByUserId();

    }



}
