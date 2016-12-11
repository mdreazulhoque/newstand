<?php
/**
 * Created by PhpStorm.
 * Project: NewsStand
 * File: BaseNewsController.php
 */

namespace App\Http\Controllers;

use App\Http\Controllers\coreBaseClass\ControllerErrorObj;
use App\Http\Controllers\coreBaseClass\ServiceResponse;
use App\Models\BaseMallBDModel;
use Illuminate\Support\Facades\Session;
use View;
class BaseNewsController extends Controller{

    public $controllerErrorObj;
    public $serviceResponse;
    public $pageData;
    public $appCredential;
    function __construct()
    {
	
        $this->pageData = [];
        $this->requestError = [];
        $this->controllerErrorObj = new ControllerErrorObj();
        
        //Images URL
        $this->pageData['baseUrl'] ="http://localhost/";       
        
        $this->serviceResponse = new ServiceResponse();
       /* $this->appCredential = $this->getSession();

        $this->serviceResponse->responseStat->isLogin = ($this->appCredential->id>0)?true:false;
        $this->pageData['isLogin'] = $this->serviceResponse->responseStat->isLogin;

        $this->pageData["appCredential"] = $this->appCredential;*/

        

    }
    public function response(){
        if($this->serviceResponse->responseStat->status!=false){
            $this->serviceResponse->responseStat->status=!($this->hasError());
        }
        return response()->json($this->serviceResponse);
    }
    public function setError($errorArray){
        $this->serviceResponse->responseStat->requestError = array_merge($this->serviceResponse->responseStat->requestError,$errorArray);
    }
    public function setControllerError($errorObj){
        array_push($this->serviceResponse->responseStat->requestError,clone $errorObj);
    }
    public function setModelFunctionError($param,$msg){
        if($msg==""){
            return;
        }
        $controllerErrorObj = new ControllerErrorObj();

        $controllerErrorObj->params = $param;
        $controllerErrorObj->msg = $msg;

        array_push($this->serviceResponse->responseStat->requestError,$controllerErrorObj);
    }
    public function hasError(){
        return (count($this->serviceResponse->responseStat->requestError)>0)?true:false;
    }
    public function isSessionExpired(){
        return  ($this->serviceResponse->responseStat->isLogin)?false:true;
    }
    private function getSession(){
        return (Session::get('AppCredential')==null)?new AppCredential():Session::get('AppCredential');
    }
}