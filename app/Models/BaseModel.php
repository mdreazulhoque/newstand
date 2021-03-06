<?php
namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BaseModel extends Eloquent
{
    public $errorManager;
    public $modelValidation;

    private $obj;
    public $errorStatus;
    public $errorMsg;
    public $customLimit;
    public $customOffset;
    protected $customOrder = "DESC";
    protected $currentUserId;
    public $fnObj = null;
    public $fnErrorMsg = "";
    public $fnError = false;
    public $email_validation_pattern="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";


    public function __construct()
    {
        $this->obj = new \stdClass();
        $this->errorStatus= false;
        $this->errorMsg = "";

        $this->errorManager = new ErrorManager();

        $this->customLimit = -1;
        $this->customOffset = -1;
    }
    /**
     * set id of any table row
     * @param $id
     *
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * set logged in user id
     * @param $currentUserId
     *
     */
    public function setCurrentUserId($currentUserId){
        $this->currentUserId = $currentUserId;
    }


    /**
     * setter for custom order for fetching data
     */
    public function setCustomOrderAsc()
    {
        $this->customOrder = "asc";
    }


    /**
     * setter for custom limit
     * @param $customLimit
     * @return boolean
     */
    public function setCustomLimit($customLimit){
        $customLimitInt = 1;
        try{
            $customLimitInt= intval($customLimit);
            $customLimitInt = ($customLimitInt==0)?1:$customLimitInt;
        }catch (Exception $ex){
            $errorObj = new ErrorObj();

            $errorObj->params = "limit";
            $errorObj->msg = "limit int required";

            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

        $this->customLimit= $customLimitInt;
        return true;
    }

    /**
     * setter for custom offset
     * @param $customLimit
     * @return boolean
     */
    public function setCustomOffset($offset){
        try{
            if($offset<0){
                $this->customOffset = 0;
                return true;
            }
            $this->customOffset= (int)$offset;
        }catch (Exception $ex){
            $errorObj = new ErrorObj();

            $errorObj->params = "offset";
            $errorObj->msg = "offset int required";

            array_push($this->errorManager->errorObj,$errorObj);
            return false;
        }

    }

    public function getObj()
    {
        return $this->obj;
    }

    public function setObj($obj)
    {
        $this->obj = $obj;
    }

    public function basicFilter(){
        $this->obj = trim($this->obj);
    }

    public function basicValidation(){
        $this->basicFilter();
        if($this->obj == null || $this->obj=="")
            return false;
        return true;
    }

    public function validationWithoutFilter(){
        if($this->obj == null || $this->obj=="")
            return false;
        return true;
    }





}

class ErrorManager{
    public $errorObj;

    /**
     * ErrorManager constructor.initialize error object
     */
    public function __construct(){
        $this->errorObj = [];

    }
}

class ErrorObj
{
    public $params;
    public $msg;

    function __construct()
    {
        $this->params = "";
        $this->msg = "";
    }
}