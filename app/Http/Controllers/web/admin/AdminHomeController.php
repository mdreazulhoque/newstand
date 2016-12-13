<?php
namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\BaseNewsController;

class AdminHomeController extends BaseNewsController
{
    /**
     * show admin.admin_home view
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.admin_home');
    }
}