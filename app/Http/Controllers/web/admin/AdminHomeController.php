<?php
namespace App\Http\Controllers\Web\Admin;
use App\Http\Controllers\BaseNewsController;
class AdminHomeController extends BaseNewsController
{

    public function index(){
        return view('admin.admin_home');
    }
}