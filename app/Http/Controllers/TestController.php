<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/11/2016
 * Time: 9:09 PM
 */

namespace App\Http\Controllers;


class TestController extends BaseNewsController
{
    public function index(){
        return view('user.news_details');
    }
}