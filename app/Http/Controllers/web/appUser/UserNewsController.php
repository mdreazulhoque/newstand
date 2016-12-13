<?php

namespace App\Http\Controllers\web\appUser;

use App\Http\Controllers\BaseNewsController;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserNewsController extends BaseNewsController {

    /**
     * for showing all news view
     * @return \Illuminate\View\View
     */
    public function getAllNewsView() {
        $newsModel=new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList']=$newsModel->getAllPublishNews();
        return view('user.news_all',$this->pageData);
    }


    /**
     * for showing all news posted by a user
     * @param $userId
     * @return \Illuminate\View\View
     */
    public function getNewByUserIdView($userId) {
        $newsModel = new News();
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setCurrentUserId($userId);
        $this->pageData['newsList'] = $newsModel->getAllNewsByUserId();
        return view('user.news_all',$this->pageData);
    }


    /**
     * for showing news by slug
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function getNewsBySlugView($slug) {

        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setSlugWhileGet($slug); 
        $this->pageData['newsDetails'] =$newsModel->getNewBySlug();
        return view('user.news_details',$this->pageData);
    }

    /**
     * for showing search result view
     * @param $search_val
     * @return \Illuminate\View\View
     */
    public function getNewsBySearchView($search_val) {
        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList'] =$newsModel->getNewBySearch($search_val);
        $this->pageData['searchVal'] =$search_val;
        return view('user.news_all',$this->pageData);
    }


    /**
     * for showing news by a category
     * @param $catId
     * @return \Illuminate\View\View
     */
    public function getNewsByCatIdView($catId) {

        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setUserCategoryId($catId); 
        $this->pageData['newsList'] =$newsModel->getNewByCatId();
        return view('user.news_all',$this->pageData);
    }

    /**
     * for creating a news
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Controllers\coreBaseClass\ServiceResponse
     */
    public function createNews(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'phone' => 'required|max:15',
            'birth_month' => 'required|max:2',
            'birth_day' => 'required|max:2',
            'birth_year' => 'required|max:4',
            'address' => 'required|max:150',
            'email' => 'required|email|max:255|unique:login_users',
        ]);

        if ($validator->fails()) {
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

    }


    /**
     * for making pdf
     * @param  $slug
     * @return pdf view
     */
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


    /**
     * for rss feed
     * @param  $slug
     * @return recent 10 news for rss feed
     */

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
