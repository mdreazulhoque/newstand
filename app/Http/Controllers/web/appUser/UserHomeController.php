<?php
namespace App\Http\Controllers\Web\AppUser;
use App\Http\Controllers\BaseNewsController;

class UserHomeController extends BaseNewsController
{

    public function index(){
        return view('user.user_home');
    }
}