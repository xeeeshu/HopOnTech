<?php

require(APPPATH.'/libraries/REST_Controller.php');

class User extends REST_Controller{
    var $status;
    var $str_response;

    public function __construct() {
         parent::__construct();
         $this->load->model('Udcmodel');
         $this->load->model('Usermodel');
    }
        public function sendresponse(){
            $responseObj = array(
                'status' => $this->status ,
                'Result' => $this->str_response 
            );
            $this->response($responseObj);
        }
        public function register_post(){
            $postData =(object) $this->post();
           if ( isset($postData->First_Name) == true && isset($postData->Middle_Name) == true && isset($postData->Last_Name) ==  true && isset($postData->Email) ==  true && isset($postData->Cell_Number) ==true && isset($postData->Password) ==  true)  {
                if ($postData->First_Name != null && $postData->Middle_Name != null && $postData->Last_Name != null && $postData->Email != null && $postData->Cell_Number != 
                    null && $postData->Password != null ) {
                    if (valid_email($postData->Email) == true) {
                       $postData->Password = md5($postData->Password);
                        $insertEntity = array(
                            'Table' =>'Users' ,
                            'Value'=>$postData
                        );
                        $result = $this->Udcmodel->create($insertEntity);
                        if ($result != 0) {
                            $this->status = '1';
                            $this->str_response = "User Register Successfully";
                        }
                        else{
                            $this->status = '0';
                            $this->str_response = "User Not Register";
                        }
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = 'Invalid Email';
                    }
                    
                }
                else{
                    $this->status = '0';
                    $this->str_response = 'Incomplete Information [* Fill Required Fields]';
                
                }
            }
        else{
            $this->status = "0";
            $this->str_response ="Input Field value Not set";
        }
        $this->sendresponse();
    }

    public function loginUser_post(){
        $postData = (object)$this->post();
        if (isset($postData->Email) ==  true && isset($postData->Password) == true) {
            if ($postData->Email !=  null && $postData->Password != null) {
                $postData->Password = md5($postData->Password);
                $result = $this->Usermodel->getuser($postData);
                if ($result != false) {
                    $this->status = '1';
                    $this->str_response = $result;    
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Invalid Email or Password";
                }                
            }
            else{
                $this->status = '0';
                $this->str_response = "Email & Password Is Required (*)";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter Not set";
        }
        $this->sendresponse();
    }
    public function updatePassword_post(){
        $postData = (object)$this->post();
        if ( isset($postData->Password) == true && isset($postData->NewPassword) == true) {
            if ($postData->Password != null && $postData->NewPassword != null) {
                $getUser =(object) array(
                    'Email' =>"" , 
                    'Password' =>md5($postData->Password),
                    'isSingle' =>true
                );
                $userResult = $this->Usermodel->getuser($getUser);
                if ($userResult == true) {
                    $userResult->Password = md5($postData->NewPassword);
                    $updateEntity = array(
                        'Table' => "users",
                        'Primary_Key' => 'User_Id',
                        'Primary_Value' =>$userResult->User_Id,
                        'Values' => $userResult
                    );
                    $updateResult = $this->Udcmodel->update($updateEntity);
                    if ($updateResult == true) {
                        $this->status = '1';
                        $this->str_response = "Password Updated Successfully";
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = "Password not Updated";
                    }
                }
                else{
                    $this->status = '0';
                    $this->str_response = "User Not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [* Fill Required Fields ]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not set";
        }
        $this->sendresponse();
    }    
   
}

?>