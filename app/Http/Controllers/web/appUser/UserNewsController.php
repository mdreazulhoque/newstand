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
    public function getNewByUserIdView() {

        $newsModel = new News();
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $newsModel->setCurrentUserId($this->appCredential->id);
        $this->pageData['newsList'] = $newsModel->getAllNewsByUserId();
        return view('user.my_news',$this->pageData);
    }


    /**
     * for showing news by slug
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function getNewsBySlugView($slug) {
        $newsModel = new News();        
        $newsModel->setCustomLimit(1);
        $newsModel->setCustomOffset(0);
        $newsModel->setNewsSlug($slug,false);
        $this->pageData['newsDetails'] =$newsModel->getNewBySlug();
        return view('user.news_details',$this->pageData);
    }
    /**
     * for showing news by slug
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function getNewsByMySlugView($slug) {
        $newsModel = new News();
        $newsModel->setCustomLimit(1);
        $newsModel->setCustomOffset(0);
        $newsModel->setNewsSlug($slug,false);
        $newsModel->setCurrentUserId($this->appCredential->id);
        $this->pageData['newsDetails'] =$newsModel->getMyNewBySlug();
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
            'news_content' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/createnews')
                ->withErrors($validator)
                ->withInput();
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
        $newsModel->setCreatedBy($this->appCredential->id);


        if($newsModel->saveNews()){
            return redirect('mynews')->with('status', 'News Successfully Inserted');
        }else{
            return redirect('mynews')->with('status', 'Somthing Wrong');
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

    public function deleteNews($id){

        $newModel=new News();
        $newModel->setId($id);
        $news=$newModel->getNewsById();
        $news->setStatus($news->deleted);

        if( $news->saveNews()){
            return redirect('mynews')->with('status', 'News Successfully Deleted');
        }else{
            return redirect('mynews')->with('status', 'Somthing Wrong');
        }

    }

}
