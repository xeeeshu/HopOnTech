<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Admin extends REST_Controller{

	var $status;
    var $str_response;

    public function __construct() {
        parent::__construct();
        $this->load->model('Udcmodel');
        $this->load->model('Usermodel');
        $this->load->helper('email');
    }
    public function sendresponse(){
    	$responseObj = array(
            'status' => $this->status ,
            'Result' => $this->str_response 
        );
        $this->response($responseObj);
    }
    public function getParents_post(){
    	$resultParents = $this->Usermodel->getparents();
    	if ($resultParents != 0) {
    		$this->status = '1';
    		$this->str_response = $resultParents;
    	}
    	else{
    		$this->status = '0';
    		$this->str_response = "Result Not Found";
    	}
    	$this->sendresponse();
    }
    public function getDrivers_post(){
    	$resultDrivers = $this->Usermodel->getdrivers();
    	if ($resultDrivers != 0) {
    		$this->status = '1';
    		$this->str_response = $resultDrivers;
    	}
    	else{
    		$this->status = '0';
    		$this->str_response = "Result Not Found";
    	}
    	$this->sendresponse();
    }
	public function driverShift_post(){
    	$postData = (object)$this->post();
    	if (isset($postData->DriverId_FK) == true && isset($postData->StudentId_FK) == true && isset($postData->Pick_Up) == true && isset($postData->Drop_Off) == true && isset($postData->Session) == true && isset($postData) == true ) {
    		if ($postData->DriverId_FK != null && $postData->StudentId_FK != null && $postData->Pick_Up != null && $postData->Drop_Off != null  && $postData->Session ) {
    			$driverTask = array(
    				'Table' => 'driver_shift', 
    				'Value' =>$postData
    			);
    			$resultTask = $this->Udcmodel->create($driverTask);
    			if ($resultTask != false) {
    				$this->status = '1';
    				$this->str_response = "Shift Assigned Successfully";
    			}
    			else{
    				$this->status = '0';
    				$this->str_response = " Not Assigned";
    			}
    		}
    		else{
    			$this->status = '0';
    			$this->str_response = "Incomplete Information [* Fill Required Fields ]";
    		}
    	}
    	else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';	
    	}
    	$this->sendresponse();
    }
    public function userStatus_post(){
        $postData = (object)$this->post();
        if (isset($postData->Email) == true) {
            if ($postData->Email != null && valid_email($postData->Email) == true) {
                $userEntity =(object) array(
                    'User_Id' => (int) 0,
                    'Email' => $postData->Email,
                    'Password' => "",
                    'isSingle' =>true
                );
                $user = $this->Usermodel->getuser($userEntity);
                if ($user->IsBlock == 0) {
                    $updateEntity = array(
                        'IsBlock'=> 1
                    );
                    $updateUser = array(
                        'Primary_Key' => 'User_Id',
                        'Primary_Value' =>$user->User_Id,
                        'Table' =>'users' ,
                        'Values' =>$updateEntity 
                    );
                    $resultUser = $this->Udcmodel->update($updateUser);
                    if ($resultUser != false) {
                        $this->status = '1';
                        $this->str_response ="User Blocked Successfully";
                    }
                    else{
                        $this->status = '0';
                        $this->str_response ="User not Blocked ";
                    }
                }
                else{
                    $updateEntity = array(
                        'IsBlock'=> 0
                    );
                    $updateUser = array(
                        'Primary_Key' => 'User_Id',
                        'Primary_Value' =>$user->User_Id,
                        'Table' =>'users' ,
                        'Values' =>$updateEntity 
                    );
                    $resultUser = $this->Udcmodel->update($updateUser);
                    if ($resultUser != false) {
                        $this->status = '1';
                        $this->str_response ="User UnBlocked Successfully";
                    }
                    else{
                        $this->status = '0';
                        $this->str_response ="User not UnBlocked ";
                    }
                }
            }
            else{
                $this->status = '0';
                $this->str_response ="Invalid User Email";
            }   
        }
        else{
            $this->status = '0';
            $this->str_response ="Parameter not Defined";
        }
        $this->sendResponse();
    }
    public function activateUser_post(){
        $postData = (object)$this->post();
        if (isset($postData->Email) ==  true) {
            if ($postData->Email != null ) {
                if (valid_email($postData->Email) == true) {
                     $userEntity =(object) array(
                        'User_Id' => (int) 0,
                        'Email' => $postData->Email,
                        'Password' => "",
                        'isSingle' =>true
                    );
                    $user = $this->Usermodel->getuser($userEntity);
                    if ($user != false) {
                        $userEntity = array(
                            'IsActive' =>1  
                        );
                        $updateUser = array(
                            'Primary_Key' =>'User_Id' ,
                            'Primary_Value' =>$user->User_Id,
                            'Table'  =>'users',
                            'Values' =>$userEntity
                        );
                        $resultUser = $this->Udcmodel->update($updateUser);
                        if ($resultUser != false) {
                            $this->status = '1';
                            $this->str_response = "User Activated Successfully";
                        }
                        else{
                            $this->status = '0';
                            $this->str_response = "User not Activated";
                        } 
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = "User not Found";
                    }
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Invalid Email";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Email is Required"; 
            } 
        }
        else{
            $this->status = '0';
            $this->str_response = "Parameter not Defined";
        }   
        $this->sendresponse();
    }
    public function verifyUser_post(){
        $filter = (object)$this->post();
        if (isset($filter->Email) == true) {
            if ($filter->Email != null && valid_email($filter->Email) == true) {
                $userFilter =(object) array(
                    'User_Id' => (int) 0,
                    'Email'  =>$filter->Email,
                    'Password' =>'',
                    'isSingle' => true
                );
                $user = $this->Usermodel->getuser($userFilter);
                if ($user != false) {
                    $updateEntity = array(
                        'IsVerified' =>1 
                    );
                    $updateUser = array(
                        'Primary_Key' =>'User_Id' , 
                        'Primary_Value' => $user->User_Id,
                        'Table'  =>'users',
                        'Values' => $updateEntity
                    );
                    $resultUser = $this->Udcmodel->update($updateUser);
                    if ($resultUser != false) {
                        $this->status = '1';
                        $this->str_response = "User Verified Successfully";
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = "Not Verified";
                    }
                }
                else{
                    $this->status = '0';
                    $this->str_response ="User not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Email";
            }
        }
        else{
            $this->status = '0';
            $this->str_response ="Parameter not Defined";
        }
        $this->sendresponse();
    }
    public function detailDriver_post(){
        $filter = (object)$this->post();
        if (isset($filter->User_Id) == true) {
            if ($filter->User_Id > (int) 0) {
                $resultDriver =  $this->Usermodel->getDetailDriver($filter);
                if ($resultDriver != false) {
                    $this->status = '1';
                    $this->str_response = $resultDriver;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Driver Not Defined";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Empty Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter Not Defined";
        }
        $this->sendresponse();
    }
    public function detailParent_post(){
        $filter = (object)$this->post();
        if (isset($filter->User_Id) == true) {
            if ($filter->User_Id > (int) 0) {
                $resultParent =  $this->Usermodel->getDetailParent($filter);
                if ($resultParent != false) {
                    $this->status = '1';
                    $this->str_response = $resultParent;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Parent Not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Empty Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter Not Defined";
        }
        $this->sendresponse();
    }
    public function detailShift_post(){
        $filter = (object)$this->post();
        if (isset($filter->Shift_Id) == true) {
            if ($filter->Shift_Id > (int) 0) {
                $resultShift =  $this->Usermodel->loadDetailShift($filter);
                if ($resultShift != false) {
                    $this->status = '1';
                    $this->str_response = $resultShift;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Shift Not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Empty Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter Not Defined";
        }
        $this->sendresponse();
    }
    public function Shifts_post(){ 
        $Shift =  $this->Usermodel->loadShifts();
        if ($Shift != false) {
            $this->status = '1';
            $this->str_response = $Shift;
        }
        else{
            $this->status = '0';
            $this->str_response = "Shift Not Found";
        }
        $this->sendresponse();
    }
    public function detailRide_post(){
        $filter = (object)$this->post();
        if (isset($filter->Shift_Id) == true) {
            if ($filter->Shift_Id > (int) 0) {
                $resultRide =  $this->Usermodel->loadDetailRide($filter);
                if ($resultRide != false) {
                    $this->status = '1';
                    $this->str_response = $resultRide;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Ride Not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Empty Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter Not Defined";
        }
        $this->sendresponse();
    }
    public function Report_post(){
        $resultReport =  $this->Usermodel->loadReport();
        if ($resultReport != false) {
            $this->status = '1';
            $this->str_response = $resultReport;
        }
        else{
            $this->status = '0';
            $this->str_response = "Report Not Found";
        }
        $this->sendresponse();
    }                  
}
?>