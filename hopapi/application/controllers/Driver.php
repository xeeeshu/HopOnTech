<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Driver extends REST_Controller{

	var $status;
    var $str_response;

    public function __construct() {
        parent::__construct();
        $this->load->model('Udcmodel');
        $this->load->model('Usermodel');
        $this->load->model('Drivermodel');
        $this->load->helper('email');
    }
    public function sendresponse(){
    	$responseObj = array(
            'status' => $this->status ,
            'Result' => $this->str_response 
        );
        $this->response($responseObj);
    }
	 public function DriverRegistration_post(){
        $postJson = $this->post('postData');
        $postData = json_decode($postJson);
        if (isset($postData->First_Name) == true && isset($postData->Middle_Name) == true && isset($postData->Last_Name) ==  true && isset($postData->Email) ==  true && isset($postData->Cell_Number) ==true && isset($postData->Password) ==  true  && isset($postData->Emergency_Contact) == true && isset($postData->Phone_No) == true && isset($postData->Service_Start_Date) == true && isset($postData->Service_End_Date) == true) {
            if ($postData->First_Name != null  && $postData->Last_Name != null && $postData->Email != null && $postData->Password != null  && $postData->Emergency_Contact != null && $postData->Phone_No != null &&$postData->Service_Start_Date != null && $postData->Service_End_Date != null) {
                if (valid_email($postData->Email) == true) {
                   $emailFilter =(object) array(
                        'User_Id' =>(int)0 ,
                        'Email'  =>$postData->Email,
                        'Password'=>"",
                        'isSingle'=>true
                    );
                   $resultEmail = $this->Usermodel->getuser($emailFilter);
                   if ($resultEmail == false) {
                   $userEnity = array(
                        'First_Name' =>$postData->First_Name ,
                        'Middle_Name' =>$postData->Middle_Name,
                        'Last_Name'  =>$postData->Last_Name,
                        'Email'  =>$postData->Email,
                        'Password' => md5($postData->Password),
                        'Cell_Number' =>$postData->Cell_Number,
                        'Type' =>"Driver"
                    );
                    $userData  = array(
                        'Table' => 'users',
                        'Value' =>$userEnity 
                    );
                    $userResult = $this->Udcmodel->create($userData);
                    $fileExt = explode('/', $_FILES['driverImage']['type']);
                        $config['upload_path'] = 'assets/images/drivers/';
                        $config['file_name'] = $userResult.'_'.rand().'_'.str_replace (' ', '',$postData->First_Name).'_profile_pic.'.$fileExt[1];
                        $config['allowed_types'] = '*';
                        $config['max_filename'] = '255';
                        $config['max_size'] = '10024'; //10 MB
                        $config['overwrite'] = TRUE;
                        if(isset($_FILES['driverImage']['name'])){
                            if(0 < $_FILES['driverImage']['error']){
                                $this->status = '0';
                                $this->str_response ="Error In File"; 
                            }
                        else{
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('driverImage')) {
                                $result =  $this->upload->display_errors();
                                $this->status = '0';
                                $this->str_response =$result;  
                            } 
                            $Image=$config['file_name'];
                            $driverEntity = array(
                                'UserId_FK'=>$userResult,
                                'Phone_No' =>$postData->Phone_No,
                                'Emergency_Contact'  =>$postData->Emergency_Contact,
                                'Service_Start_Date' =>$postData->Service_Start_Date,
                                'Service_End_Date' =>$postData->Service_End_Date,
                                'Driver_Image'  =>$Image
                            );
                            $driverData =array(
                                'Table'=> 'driver_profile',
                                'Value' => $driverEntity 
                            );           
                            $driverResult=$this->Udcmodel->create($driverData);
                            $addressEntity = array(
                                'UserId_FK' =>$driverResult,
                                'House' => $postData->House,
                                'Unit' =>$postData->Unit , 
                                'City' =>$postData->City,
                                'Province' =>$postData->Province,
                                'Postal_Code'  =>$postData->Postal_Code
                            );
                            $addressData = array(
                                'Table' => 'address',
                                'Value'=>$addressEntity 
                            );
                            $addressResult = $this->Udcmodel->create($addressData);
                            if ($userResult == true && $driverResult == true && $addressResult == true) {                                            
                                $this->status = '1';
                                $this->str_response ="Register Successfully";           
                            }
                            else{
                                $this->status = '0';
                                $this->str_response ="Not Registered";
                            }  
                        }
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = "Please Select Image File";
                    }
                   }
                   else{
                    $this->status = '0';
                    $this->str_response = "Email not Available try Another";
                   }
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Invalid Email";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';
        }
        $this->sendresponse();
    }
    public function driverLicense_post(){
    	$postJson = $this->post('postData');
    	$postData = json_decode($postJson);
    	if (isset($postData->License_Number) == true && isset($postData->Issue_Authority) == true && isset($postData->Issue_Date) == true && isset($postData->Expire_Date) == true) {
    		if ($postData->License_Number != null && $postData->Issue_Authority != null &&
    			$postData->Issue_Date != null && $postData->Expire_Date != null) {
    				$fileExt = explode('/', $_FILES['licenseImage']['type']);
           		$config['upload_path'] = 'assets/images/drivers/license';
           	 	$config['file_name'] = 'DL'.'_'.rand().'_'.str_replace (' ', '',$postData->License).'.'.$fileExt[1];
            	$config['allowed_types'] = '*';
            	$config['max_filename'] = '255';
            	$config['max_size'] = '10024'; //10 MB
            	$config['overwrite'] = TRUE;
            	if(isset($_FILES['licenseImage']['name'])){
                	if(0 < $_FILES['licenseImage']['error']){
                    	$this->status = '0';
                    	$this->str_response ="Error In File"; 
                	}
            		else{
                		$this->load->library('upload', $config);
                		$this->upload->initialize($config);
                		if (!$this->upload->do_upload('licenseImage')) {
                    		$result =  $this->upload->display_errors();
                   			$this->status = '0';
                   			$this->str_response =$result; 
                		} 
                		$Image=$config['file_name'];
                		$licenseEntity = array(
                			'DriverId_FK'=>$postData->Driver_Id,
                			'License_Image'  =>$postData->$Image,
                			'License_Number' => $postData->License_Number,
                			'Issue_Authority'  =>$postData->Issue_Authority,
                			'Issue_Date'  =>$postData->Issue_Date,
                			'Expire_Date'  =>$postData->Expire_Date
                		);
                		$licenseData =array(
                  			'Table'=> 'driver_license',
                    		'Value' => $licenseEntity 
                		);           
                		$licenseResult=$this->Udcmodel->create($licenseData);
                		if ( $licenseResult == true) {
                    		$this->status = '1';
                    		$this->str_response ="Added Successfully";           
                		}
                		else{
                    		$this->status = '0';
                    		$this->str_response ="Not Added";
                		}  
            		}
            	}
            	else{
                	$this->status = '0';
                	$this->str_response = "Please Select File";
            	}
    		}
    		else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
    		}
    	}
    	else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';
    	}
    	$this->sendresponse();
    }
    public function driverVehicle_post(){
    	$postJson = $this->post('postData');
    	$postData = json_decode($postJson);
    	if (isset($postData->Vehicle_Type) == true && isset($postData->Vehicle_No) == true && isset($postData->Vehicle_Color) == true && isset($postData->Vehicle_Condition) == true){
    		if ($postData->Vehicle_Type != null && $postData->Vehicle_No != null && $postData->Vehicle_Color != null && $postData->Vehicle_Condition != null) {
    			$fileExt = explode('/', $_FILES['vehicleImage']['type']);
           		$config['upload_path'] = 'assets/images/drivers/vehicle';
           	 	$config['file_name'] = 'DV'.'_'.rand().'_'.str_replace (' ', '',$postData->Vehicle_No).'.'.$fileExt[1];
            	$config['allowed_types'] = '*';
            	$config['max_filename'] = '255';
            	$config['max_size'] = '10024'; //10 MB
            	$config['overwrite'] = TRUE;
            	if(isset($_FILES['vehicleImage']['name'])){
                	if(0 < $_FILES['vehicleImage']['error']){
                    	$this->status = '0';
                    	$this->str_response ="Error In File"; 
                	}
            		else{
                		$this->load->library('upload', $config);
                		$this->upload->initialize($config);
                		if (!$this->upload->do_upload('vehicleImage')) {
                    		$result =  $this->upload->display_errors();
                   			$this->status = '0';
                   			$this->str_response =$result; 
                		} 
                		$Image=$config['file_name'];
                		$vehicleEntity = array(
                			'DriverId_FK'=>$postData->Driver_Id,
                			'Vehicle_Image'  =>$postData->$Image,
                			'Vehicle_Type' => $postData->Vehicle_Type,
                			'Vehicle_No'  =>$postData->Vehicle_No,
                			'Vehicle_Company'  =>$postData->Vehicle_Company,
                			'Vehicle_Condition'  =>$postData->Vehicle_Condition
                		);
                		$vehicleData =array(
                  			'Table'=> 'driver_vehicle',
                    		'Value' => $vehicleEntity 
                		);           
                		$vehicleResult=$this->Udcmodel->create($vehicleData);
                		if ( $vehicleResult == true) {
                    		$this->status = '1';
                    		$this->str_response ="Added Successfully";           
                		}
                		else{
                    		$this->status = '0';
                    		$this->str_response ="Not Added";
                		}  
            		}
            	}
            	else{
                	$this->status = '0';
                	$this->str_response = "Please Select File";
            	}
    		}
    		else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
    		}

    	}
    	else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';
    	}
    	$this->sendresponse();
    }
    public function driverCrime_post(){
    	$postJson = $this->post('postData');
    	$postData = json_decode($postJson);
    	if (isset($postData->Driver_Id) == true && isset($postData->Crime_Title) == true && isset($postData->Crime_Detail) == true && isset($postData->Crime_Status) == true) {
    		if ($postData->Driver_Id == null && $postData->Crime_Title != null && $postData->Crime_Detail != null && $postData->Crime_Status != null) {
    			$fileExt = explode('/', $_FILES['crimeFile']['type']);
           		$config['upload_path'] = 'assets/images/drivers/crimerecord/';
           	 	$config['file_name'] = 'DCR'.'_'.rand().'_'.str_replace (' ', '',$postData->Driver_Id).'.'.$fileExt[1];
            	$config['allowed_types'] = '*';
            	$config['max_filename'] = '255';
            	$config['max_size'] = '10024'; //10 MB
            	$config['overwrite'] = TRUE;
            	if(isset($_FILES['crimeFile']['name'])){
                	if(0 < $_FILES['crimeFile']['error']){
                    	$this->status = '0';
                    	$this->str_response ="Error In File"; 
                	}
            		else{
                		$this->load->library('upload', $config);
                		$this->upload->initialize($config);
                		if (!$this->upload->do_upload('crimeFile')) {
                    		$result =  $this->upload->display_errors();
                   			$this->status = '0';
                   			$this->str_response =$result; 
                		} 
                		$Image=$config['file_name'];
                		$crimeEntity = array(
                			'DriverId_FK'=>$postData->Driver_Id,
                			'Crime_Title' => $postData->Crime_Title,
                			'Crime_Detail'  =>$postData->Crime_Detail,
                			'Crime_Status'  =>$postData->Crime_Status,
                			'Document_File'  =>$postData->$Image
                		);
                		$crimeData =array(
                  			'Table'=> 'driver_vehicle',
                    		'Value' => $crimeEntity 
                		);           
                		$crimeResult=$this->Udcmodel->create($crimeData);
                		if ( $crimeResult == true) {
                    		$this->status = '1';
                    		$this->str_response ="Added Successfully";           
                		}
                		else{
                    		$this->status = '0';
                    		$this->str_response ="Not Added";
                		}  
            		}
            	}
            	else{
                	$this->status = '0';
                	$this->str_response = "Please Select File";
            	}
    		}
    		else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
    		}
    	}
    	else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';
    	}
    	$this->sendresponse();
    }
    public function driverFirstaid_post(){
    	$postData = (object)$this->post();
    	if (isset($postData->Driver_Id) == true && isset($postData->Start_Date) == true && isset($postData->End_Date) == true) {
    		if ($postData->Driver_Id != null && $postData->$postData->Start_Date != null && $postData->$postData->End_Date != null) {
    			$driverCPR = array(
    				'Table' => 'driver_cpr', 
    				'value' =>$postData
    			);
    			$resultCPR = $this->Udcmodel->create($driverCPR);
    			if ($resultCPR != false) {
    				$this->status = '1';
    				$this->str_response = "Added Successfully";
    			}
    			else{
    				$this->status = '0';
    				$this->str_response = " Not Added";
    			}
    		}
    		else{
    			$this->status = '0';
    			$this->str_response = "Incomplete Information [*]";
    		}
    	}
    	else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';	
    	}
    	$this->sendresponse();
    }
    //////////*********
    //               End Of Saving Function 
                                            ////////////*******
    public function editdriverProfile_post(){
        $postData = (object)$this->post();
        if (isset($postData->First_Name) == true && isset($postData->Last_Name) == true && isset($postData->Middle_Name) == true &&isset($postData->First_Name) == true && isset($postData->Driver_Id) == true && isset($postData->User_Id) == true) {
            if ($postData->First_Name != null && $postData->Middle_Name != null && $postData->Last_Name != null && $postData->Medical_Issue != null && $postData->Phone_No != null  && $postData->Emergency_Contact != null && $postData->Service_Start_Date != null && $postData->Service_End_Date != null && $postData->Driver_Id != null && $postData->User_Id != null) {
                $updateU = array(
                    'First_Name' =>$postData->First_Name ,
                    'Middle_Name' =>$postData->Middle_Name ,
                    'Last_Name' =>$postData->Last_Name 
                );
                $updateUser = array(
                    'Primary_Key' => 'User_Id',
                    'Primary_Value' => $postData->User_Id,
                    'Table' => 'users',
                    'Values' => $updateU
                );
                $userResult = $this->Udcmodel->update($updateUser);
                $updateD = array(
                    'Medical_Issue' =>$postData->Medical_Issue ,
                    'Phone_No' =>$postData->Phone_No ,
                    'Emergency_Contact' =>$postData->Emergency_Contact,
                    'Service_Start_Date' =>$postData->Service_Start_Date,
                    'Service_End_Date' =>$postData->Service_End_Date,
                    'Community' =>$postData->Community
                );
                $updateDriver = array(
                    'Primary_Key' => 'Driver_Id',
                    'Primary_Value' => $postData->Driver_Id,
                    'Table' => 'driver_profile',
                    'Values' => $updateD
                );
                $driverResult = $this->Udcmodel->update($updateDriver);
                $updateA = array(
                    'UserId_FK' =>$postData->Driver_Id ,
                    'House' => $postData->House,
                    'Unit' => $postData->Unit,
                    'City' => $postData->City,
                    'Province' => $postData->Province,
                    'Postal_Code' => $postData->Postal_Code
                );
                $updateAddress = array(
                    'Primary_Key' => 'Address_Id',
                    'Primary_Value' =>$postData->Address_Id,
                    'Table'         =>'address',
                    'Values'        =>$updateA
                     );
                $addressResult = $this->Udcmodel->update($updateAddress);
                if ($userResult == true || $driverResult == true || $addressResult == true) {
                    $this->status = '1';
                    $this->str_response = "Profile Updated Successfully";
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Profile Not Updated";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }
   
    public function updateImage_post(){
            $fileExt = explode('/', $_FILES['driverImage']['type']);
            $config['upload_path'] = 'assets/image/drivers/';
            $config['file_name'] = $this->post('User_Id').'_'.rand().'_'.str_replace (' ', '',$this->post('First_Name')).'_profile_pic.'.$fileExt[1];
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '10024'; //10 MB
            $config['overwrite'] = TRUE;
            if(isset($_FILES['driverImage']['name'])){
                if(0 < $_FILES['driverImage']['error']){
                    $this->status = '0';
                    $this->str_response = "Error Occured";
                }
                else{
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('driverImage')) {
                        $result =  $this->upload->display_errors();
                        $this->status = '0';
                        $this->str_response = $result;
                    } 
                    else {
                        $filter = (object) array(
                            'Driver_Id' => (int)0,
                            'UserId_FK' => $this->post('User_Id'),
                            'isSingle' => true,
                        );
                        $driverResult = $this->Drivermodel->loadDriver($filter);
                        $driverResult->Driver_Image = $config['file_name'];
                        $entity = array(
                            'Table' => "driver_profile",
                            'Primary_Key' =>'Driver_Id',
                            'Primary_Value'=>$driverResult->Driver_Id,
                            'Value' => $driverResult
                        );
                        $result=$this->Udcmodel->update($entity);
                        if($result){
                            $this->status = '1';
                            $this->str_response = "Profile Picture Updated Successfully"; 
                        }
                        else{
                            $this->status = '0';
                            $this->str_response = "Profile Picture not Updated";
                        } 
                    }
                }
            }
        else{
            $this->status = '0';
            $this->str_response = "File not Selected";
        }
        $this->sendresponse();
    }
    public function driverProfile_post(){
        $filter = (object)$this->post();
        if (isset($filter->User_Id) == true) {
            if ($filter->User_Id != null) {
                $userFilter =(object) array(
                    'User_Id' => $filter->User_Id, 
                    'Email' =>'',
                    'Password' =>'',
                    'isSingle' =>true
                );
                $user = $this->Usermodel->getuser($userFilter);
                if ($user != false) {
                    $profileFilter = array(
                        'UserId_FK' =>$filter->User_Id , 
                        'Driver_Id'=>'',
                        'isSingle' =>true
                    );
                    $BasicProfile = $this->Drivermodel->loadDriver($profileFilter);
                    if ($BasicProfile != false) {
                        $address = $this->Drivermodel->loadaddress($BasicProfile);
                        $fullProfile = array(
                            'User_Id' => $user->User_Id, 
                            'First_Name' =>$user->First_Name,
                            'Middle_Name' =>$user->Middle_Name,
                            'Last_Name' =>$user->Last_Name,
                            'Email' =>$user->Email,
                            'Cell_Number' =>$user->Cell_Number,
                            'Driver_Id'  => $BasicProfile->Driver_Id,
                            'UserId_FK'  => $BasicProfile->UserId_FK,
                            'Driver_Image'  => $BasicProfile->Driver_Image,
                            'Medical_Issue'  => $BasicProfile->Medical_Issue,
                            'Phone_No'  => $BasicProfile->Phone_No,
                            'Emergency_Contact'  => $BasicProfile->Emergency_Contact,
                            'Service_Start_Date'  => $BasicProfile->Service_Start_Date,
                            'Service_End_Date'  => $BasicProfile->Service_End_Date,
                            'Defense_Driving_Course_Date'  => $BasicProfile->Defense_Driving_Course_Date,
                            'Community'  => $BasicProfile->Community,
                            'Address_Id' =>$address->Address_Id,                         
                            'ParentId_FK' =>$address->UserId_FK ,
                            'Unit' =>$address->Unit ,
                            'House' => $address->House,
                            'City' => $address->City,
                            'Province' =>$address->Province ,
                            'Postal_Code' =>$address->Postal_Code ,
                        ); 
                        $this->status = '1';
                        $this->str_response = $fullProfile;   
                    }
                    else{
                        $this->status = '1';
                        $this->str_response = $user;
                    } 
                }
                else{
                    $this->status = '0';
                    $this->str_response = "User Not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function License_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id != null) {

                $license = $this->Drivermodel->loadLicense($filter);
                if ($license != false) {
                    $this->status = '1';
                    $this->str_response = $license;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "License Not Found"; 
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function Crime_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id != null) {
                $crime = $this->Drivermodel->loadCrime($filter);
                if ($crime != false) {
                    $this->status = '1';
                    $this->str_response = $crime;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Crime Not Found"; 
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }    
    public function Vehicle_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id != null) {
                $vehicle = $this->Drivermodel->loadVehicle($filter);
                if ($vehicle != false) {
                    $this->status = '1';
                    $this->str_response = $vehicle;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Vehicle Not Found"; 
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function VehicleReg_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id != null) {
                $VehicleReg = $this->Drivermodel->loadVehicleReg($filter);
                if ($VehicleReg != false) {
                    $this->status = '1';
                    $this->str_response = $VehicleReg;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Vehicle Registration Not Found"; 
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function Firstaid_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id != null) {
                $firstAid = $this->Drivermodel->loadFirstaid($filter);
                if ($firstAid != false) {
                    $this->status = '1';
                    $this->str_response = $firstAid;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "First Aid CPR Not Found"; 
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Parameter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function startRide_post(){
        $postData = (object)$this->post();
        if (isset($postData->ShiftId_FK) == true && isset($postData->Source_Address) == true && isset($postData->Source_GPS) == true && isset($postData->Destination_Address) == true && isset($postData->Destination_GPS) == true ) {
            if ($postData->ShiftId_FK > (int) 0 && $postData->Source_Address != null || $postData->Source_GPS != null && $postData->Destination_Address != null || $postData->Destination_GPS != null) {
                $ride = array(
                    'Table' =>'driver_rides' ,
                    'Value' =>$postData
                );
                $resultRide = $this->Udcmodel->create($ride);
                if ($resultRide != false) {
                    $this->status = '1';
                    $this->str_response = "Ride Start Successfully";
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Ride not Started";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }
    public function rideStatus_post(){
        $postData = (object)$this->post();
        if (isset($postData->RideId_FK) == true && isset($postData->IsCompleted) == true && isset($postData->Cancel_Reason) == true) {
            if ($postData->RideId_FK > (int) 0 && $postData->IsCompleted == 1) {
                $rideStatus = array(
                    'RideId_FK' =>$postData->RideId_FK , 
                    'IsCompleted' =>$postData->IsCompleted
                );
               $resultStatus = $this->Udcmodel->create($rideStatus);
               if ($resultStatus != false) {
                   $this->status = '1';
                   $this->str_response = "Ride Completed Successfully";
               }
               else{
                   $this->status = '0';
                   $this->str_response = "Ride not Completed";
               }
            }   
            else 
                if ($postData->RideId_FK > (int) 0 && $postData->IsCompleted == 0 && $postData->Cancel_Reason != null) {
                    $rideStatus = array(
                        'Table' =>'ride_status',
                        'Value' => $postData 
                );
               $resultStatus = $this->Udcmodel->create($rideStatus);
                if ($resultStatus != false) {
                        $this->status = '1';
                        $this->str_response = "Ride Canceled";
                    }
                    else{
                        $this->status = '0';
                        $this->str_response = "Ride not Canceled";
                    }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [*]";
            }
        }
        else{
            $this->status ='0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }
    public function Shifts_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id > (int) 0) {
                $shiftFilter =(object) array(
                    'DriverId_FK' =>$filter->Driver_Id , 
                    'isSingle' =>false
                );
                $resultShift = $this->Drivermodel->loadShift($shiftFilter);
                if ($resultShift != false) {
                    $this->status = '1';
                    $this->str_response = $resultShift;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Shift not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response ="Empty Filter ";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function Rides_post(){
        $filter = (object)$this->post();
        if (isset($filter->Driver_Id) == true) {
            if ($filter->Driver_Id > (int) 0) {
                $rideFilter =(object) array(
                    'DriverId_FK' =>$filter->Driver_Id , 
                    'isSingle' =>false
                );
                $resultRide = $this->Drivermodel->loadRides($rideFilter);
                if ($resultRide != false) {
                    $this->status = '1';
                    $this->str_response = $resultRide;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Ride not Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response ="Empty Filter ";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Filter not Defined";
        }
        $this->sendresponse();
    }
    public function reportStudent_post(){
        $postData = (object)$this->post();
        if (isset($postData->DriverId_FK) == true && isset($postData->StudentId_FK) == true && isset($postData->Problem_Title) == true && isset($postData->Attempt) == true && isset($postData->Comment) == true) {
            if ($postData->DriverId_FK > (int) 0 && $postData->StudentId_FK > (int) 0 && $postData->Problem_Title != null && $postData->Attempt != null ) {
                $insertReport = array(
                    'Table' =>'student_Report' , 
                    'Value' =>$postData
                );
                $resultReport = $this->Udcmodel->create($insertReport);
                if ($resultReport != false) {
                    $this->status = '1';
                    $this->str_response = "Student Reported Successfully";
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Student not Reported ";
                }
            }
            else{
                    $this->status = '0';
                    $this->str_response = "Incomplete Information Error[*]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }                                                                            
}
?>