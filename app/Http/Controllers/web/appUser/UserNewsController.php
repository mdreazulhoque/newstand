<?php

namespace App\Http\Controllers\web\appUser;

use App\Http\Controllers\BaseNewsController;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserNewsController extends BaseNewsController {

    //
    public function getAllNewsView() {       
        $newsModel=new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList']=$newsModel->getAllPublishNews();
        return view('user.news_all',$this->pageData);
    }

    public function getNewByUserIdView() {
        $userID = 1;
        $newsModel = new News();
        $newsModel->setCurrentUserId($userID);
        $this->pageData['newsList'] = $newsModel->getAllNewsByUserId();
    }
    
    public function getNewsBySlugView($slug) {

        $newsModel = new News();        
        $newsModel->setCustomLimit(1);
        $newsModel->setCustomOffset(0);
        $newsModel->setSlugWhileGet($slug); 
        $this->pageData['newsDetails'] =$newsModel->getNewBySlug();
        return view('user.news_details',$this->pageData);
    }
    public function getNewsBySearchView($search_val) {
        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList'] =$newsModel->getNewBySearch($search_val);
        $this->pageData['searchVal'] =$search_val;
        return view('user.news_all',$this->pageData);
    }
    
    public function getNewsByCatIdView($catId) {

        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setUserCategoryId($catId); 
        $this->pageData['newsList'] =$newsModel->getNewByCatId();
        return view('user.news_all',$this->pageData);
    }
    //pdf download
    public function getNewsBySlugDownload($slug) {
        $newsModel = new News();        
        $newsModel->setCustomLimit(1);
        $newsModel->setCustomOffset(0);
        $newsModel->setSlugWhileGet($slug); 
        $this->pageData['newsDetails'] =$newsModel->getNewBySlug();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('user.news_download', $this->pageData);
        return $pdf->download('News_'.$slug.'.pdf');
    }
    //rss feed
    public function rss() {
        $newsModel = new News();
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $allpublishnews = $newsModel->getAllPublishNews();
        header("Content-Type: application/rss+xml; charset=ISO-8859-1");

        $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $rssfeed .= '<rss version="2.0">';
        $rssfeed .= '<channel>';
        $rssfeed .= '<title>My RSS feed</title>';
        $rssfeed .= '<link>http://localhost/newsstand/public</link>';
        $rssfeed .= '<description>This is an RSS feed for newsstand</description>';
        $rssfeed .= '<language>en-us</language>';
        $rssfeed .= '<copyright>Copyright (C) 2016 newsstand</copyright>';

        foreach ($allpublishnews as $row) {
            $link = url("news/" . urlencode($row->news_slug) . "");
            $rssfeed .= '<item>';
            $rssfeed .= '<title>' . $row->news_title . '</title>';
            $rssfeed .= '<description>' . $row->news_content . '</description>';
            $rssfeed .= '<link>' . $link . '</link>';
            $rssfeed .= '<pubDate>' . date('F d,Y   h:i A', strtotime($row->created_at)) . '</pubDate>';
            $rssfeed .= '</item>';
        }

        $rssfeed .= '</channel>';
        $rssfeed .= '</rss>';

        echo $rssfeed;
    }

}
