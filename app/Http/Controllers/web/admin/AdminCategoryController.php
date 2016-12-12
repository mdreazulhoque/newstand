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
            if ($catModel->saveCategory()){
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

    public function editCategory(Request $request){
        $catName=$request->input('cat_name');
        $catid=$request->input('id');
        $catModel=new Category();
        $catModel->setId($catid);
        $cat=$catModel->getCategoryById();


        $cat->setCategoryName($catName);
        $this->setError($catModel->errorManager->errorObj);


        if ($this->hasError()){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Error in Input";
            return $this->response();
        }else{
            if ($cat->saveCategory()){
                $this->serviceResponse->responseStat->status = true;
                $this->serviceResponse->responseStat->msg = "Category has been updated successfully";
                return $this->response();

            }else{
                $this->serviceResponse->responseStat->status = false;
                $this->serviceResponse->responseStat->msg = "Error in saving Category";
                return $this->response();
            }
        }





    }

    public function activateCategory($catId){

        if (empty($catId) || $catId<1 || !is_numeric($catId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category Id not found";
            return $this->response();
        }

        $catModel=new Category();
        $catModel->setId($catId);
        $cat= $catModel->getCategoryById();
        if (empty($cat)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category not found";
            return $this->response();
        }
        $cat->setStatus($catModel->active);


        if ($cat->saveCategory()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Category has been Activated";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }



    }

    public function deactivateCategory($catId){
        if (empty($catId) || $catId<1 || !is_numeric($catId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category Id not found";
            return $this->response();
        }

        $catModel=new Category();

        $catModel->setId($catId);
        $cat= $catModel->getCategoryById();

        if (empty($cat)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category not found";
            return $this->response();
        }

        $cat->setStatus($catModel->inactive);


        if ($cat->saveCategory()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Category has been De-activated";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }

    }


    public function deleteCategory($catId){
        if (empty($catId) || $catId<1 || !is_numeric($catId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category Id not found";
            return $this->response();
        }

        $catModel=new Category();
        $catModel->setId($catId);
        $cat= $catModel->getCategoryById();

        if (empty($cat)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category not found";
            return $this->response();
        }

        $cat->setStatus($catModel->deleted);


        if ($cat->saveCategory()){
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Category has been Deleted Successfully";
            return $this->response();
        }else{
            $this->serviceResponse->responseStat->status = true;
            $this->serviceResponse->responseStat->msg = "Something went wrong";
            return $this->response();
        }
    }

    public function getEditCategoryView($catId){
        if (empty($catId) || $catId<1 || !is_numeric($catId)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category Id not found";
            return $this->response();
        }

        $catModel=new Category();
        $catModel->setId($catId);
        $cat= $catModel->getCategoryById();
        if (empty($cat)){
            $this->serviceResponse->responseStat->status = false;
            $this->serviceResponse->responseStat->msg = "Category not found";
            return $this->response();
        }

        $this->pageData['cat']=$cat;

        return view('admin.edit_category',$this->pageData);



    }





}