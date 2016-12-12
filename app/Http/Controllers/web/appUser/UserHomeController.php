<?php
namespace App\Http\Controllers\Web\AppUser;
use App\Http\Controllers\BaseNewsController;
use App\Models\Category;
use App\Models\News;
class UserHomeController extends BaseNewsController
{

    public function index(){        
        $newsmodel=new News();        
        $newsmodel->setCustomLimit(10);
        $newsmodel->setCustomOffset(1);
        $this->pageData['newsList']=$newsmodel->getAllPublishNews();
        return view('user.user_home',$this->pageData);
    }
}