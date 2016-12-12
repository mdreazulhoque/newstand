<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/13/2016
 * Time: 1:09 AM
 */

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\BaseNewsController;
use App\Models\News;

class AdminNewsController extends BaseNewsController
{

    public function getAllNews(){
        $newsModel=new News();
        $newsList=$newsModel->getAllNews();
        $this->pageData['newsList']=$newsList;

        return view('admin.all_news',$this->pageData);
    }

}