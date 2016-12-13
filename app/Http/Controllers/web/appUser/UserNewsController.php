<?php

namespace App\Http\Controllers\web\appUser;

use App\Http\Controllers\BaseNewsController;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserNewsController extends BaseNewsController {

    //
    public function getAllNewsView() {
        $newsModel=new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList']=$newsModel->getAllPublishNews();
        return view('user.news_all',$this->pageData);
    }

    public function getNewByUserIdView($userId) {
        $newsModel = new News();
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setCurrentUserId($userId);
        $this->pageData['newsList'] = $newsModel->getAllNewsByUserId();
        return view('user.news_all',$this->pageData);
    }
    
    public function getNewsBySlugView($slug) {

        $newsModel = new News();        
        $newsModel->setCustomLimit(10);
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

    public function createNewsView(){

        $catModel=new Category();
        $this->pageData['category']=$catModel->getAllCategories();

        return view('user.create_news',$this->pageData);
    }

    public function createNews(Request $request){

         

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'news_title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'news_content' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = $validator->errors()->first();
            return $this->response();
        }

        $newsModel=new News();

        $image = $request->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img');
        $image->move($destinationPath, $imagename);

        $newsModel->setUserCategoryId($request->input('category'));
        $newsModel->setNewsTitle($request->input('news_title'));
        $newsModel->setPhotoUrl('img/'.$imagename);
        $newsModel->setNewsContent($request->input('news_content'));
        $newsModel->setNewsSlug($request->input('news_title'));
        $newsModel->setCreatedBy();

        $newsModel->saveNews();

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
