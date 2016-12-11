<?php
/**
 * Created by PhpStorm.
 * User: Tomal
 * Date: 12/11/2016
 * Time: 11:42 PM
 */

namespace App\Http\Controllers\Web\Admin;


use App\Http\Controllers\BaseNewsController;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends BaseNewsController
{
    public function getllCategoryView(){

        $catModel=new Category();
        $catList=$catModel->getAllCategories();
        $this->pageData['catList']=$catList;
        return view('admin.all_category',$this->pageData);

    }

    public function getAddNewCategoryView(){

        return view('admin.add_new_category');

    }

    public function saveNewCategory(Request $request){

        $catModel=new Category();
        $catModel->setCategoryName($request->input('cat_name'));
        $this->setError($catModel->errorManager->errorObj);


        if ($this->hasError()){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Error in Input";
            return $this->response();
        }else{
            if ($catModel->insertCategory()){
                $this->serviceResponse->responseStat->status = true;
                $this->serviceResponse->responseStat->msg = "Category has been added successfully";
                return $this->response();

            }else{
                $this->serviceResponse->responseStat->status = false;
                $this->serviceResponse->responseStat->msg = "Error in saving Category";
                return $this->response();
            }
        }


    }



}