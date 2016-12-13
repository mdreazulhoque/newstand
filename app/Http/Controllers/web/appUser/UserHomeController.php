<?php
namespace App\Http\Controllers\Web\AppUser;
use App\Http\Controllers\BaseNewsController;
use App\Models\Category;
use App\Models\News;
class UserHomeController extends BaseNewsController
{
    /**
     * for showing new category view
     * @return \Illuminate\View\View
     */

    public function index(){        
        $newsModel=new News();        
        $newsModel->setCustomLimit(10);
        $newsModel->setCustomOffset(0);
        $this->pageData['newsList']=$newsModel->getAllPublishNews();
        return view('user.user_home',$this->pageData);
    }

    /**
     * for showing category edit view
     * @return \Illuminate\View\View
     */
    public function about(){
        return view('user.about',$this->pageData);
    }
}