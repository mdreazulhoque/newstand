<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/11/2016
 * Time: 9:09 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends BaseNewsController
{
    public function index(Request $request){

        return json_encode(Auth::guard("web"));
        return view('user.email_verification');
        $stop_date = '2009-09-30 20:24:00';
        //echo 'date before day adding: ' . $stop_date;
        $stop_date = date('Y-m-d H:i:s', strtotime($stop_date . ' +1 day'));
        
        return 'date after adding 1 day: ' . date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 day'));

        return view('user.dashboard.dashboard_home');
    }
}