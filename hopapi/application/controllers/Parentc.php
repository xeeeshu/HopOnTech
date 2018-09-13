<?php

require(APPPATH.'/libraries/REST_Controller.php');

class Parentc extends REST_Controller{
	  var $status;
    var $str_response;

    public function __construct() {
         parent::__construct();
         $this->load->model('Udcmodel');
         $this->load->model('Usermodel');
         $this->load->model('Parentmodel');
		 $this->load->helper('email');
    }
    public function sendresponse(){
        $responseObj = array(
            'status' => $this->status ,
            'Result' => $this->str_response 
        );
        $this->response($responseObj);
    }
	public function parentRegistration_post(){
        $postJson = $this->post('postData');
        $postData = json_decode($postJson);
        if (isset($postData->First_Name) == true && isset($postData->Middle_Name) == true && isset($postData->Last_Name) ==  true && isset($postData->Email) ==  true && isset($postData->Cell_Number) == true && isset($postData->Password) ==  true && isset($postData->Parent_Type) == true && isset($postData->Phone_Number) == true && isset($postData->NIC) == true) {
            if ($postData->First_Name != null  && $postData->Last_Name != null && $postData->Email != null && $postData->Password != null && $postData->Parent_Type != null && $postData->Phone_Number != null && $postData->NIC != null) {
                if (valid_email($postData->Email) == true) {
                   $emailFilter =(object) array(
                        'User_Id' =>(int)0 , 
                        'Email' =>$postData->Email,
                        'Password' =>"",
                        'isSingle' =>true
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
                        'Type' =>"Parent"
                    );
                    $userData  = array(
                        'Table' => 'users',
                        'Value' =>$userEnity 
                    );
                    $userResult = $this->Udcmodel->create($userData);             
                    $fileExt = explode('/', $_FILES['parentImage']['type']);
                        $config['upload_path'] = 'assets/images/parents/';
                        $config['file_name'] = $userResult.'_'.rand().'_'.str_replace (' ', '',$postData->Last_Name).'_profile_pic.'.$fileExt[1];
                        $config['allowed_types'] = '*';
                        $config['max_filename'] = '255';
                        $config['max_size'] = '10024'; //10 MB
                        $config['overwrite'] = TRUE;
                        if(isset($_FILES['parentImage']['name'])){
                            if(0 < $_FILES['parentImage']['error']){
                                 $this->status = '0';
                                $this->str_response = "Error Occured";
                            }
                        else{
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('parentImage')) {
                                $result =  $this->upload->display_errors();
                                $this->status = '0';
                                $this->str_response = $result;
                            } 
                            $Image=$config['file_name'];
                            $parentEntity = array(
                                'UserId_FK'=>$userResult,
                                'Phone_Number' => $postData->Phone_Number,
                                'Parent_Type'  =>$postData->Parent_Type,
                                'NIC' =>$postData->NIC,
                                'Parent_Image'  =>$Image
                            );
                            $parentData =array(
                                'Table'=> "parent_profile",
                                'Value' => $parentEntity 
                            );           
                            $parentResult=$this->Udcmodel->create($parentData);
                            $addressEntity = array(
                                'UserId_FK' =>$parentResult,
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
                            if ($userResult == true && $parentResult == true && $addressResult == true) {
                                $this->status = '1';
                                $this->str_response ="You Registered Successfully";           
                            }
                            else{
                                $this->status = '0';
                                $this->str_response ="Not Registered";
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
                $this->str_response = "Incomplete Information [* Fill Required Fields ]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = 'Input Parameter not Defined';
        }
        $this->sendresponse();
    }
    public function studentRegistration_post(){
    	$postJson = $this->post('postData');
    	$postData = json_decode($postJson);
    	 if (isset($postData->First_Name) == true && isset($postData->Middle_Name) == true && isset($postData->Last_Name) ==  true && isset($postData->Nick_Name) ==  true && isset($postData->ParentId_FK) ==true && isset($postData->Student_Age) ==  true && isset($postData->School_Name) == true && isset($postData->School_City) == true && isset($postData->School_Postal_Code) == true && isset($postData->School_Province) == true && isset($postData->School_Contact) == true){
		if ($postData->First_Name != null && $postData->Last_Name !=  null  && $postData->ParentId_FK != null && $postData->Student_Age !=  null && $postData->School_Name!= null && $postData->School_City != null && $postData->School_Postal_Code == true && $postData->School_Province != null && $postData->School_Contact != null) {
				$fileExt = explode('/', $_FILES['childImage']['type']);
            	$config['upload_path'] = 'assets/images/parents/';
            	$config['file_name'] = $userResult.'_'.rand().'_'.str_replace (' ', '',$postUser->Name).'_profile_pic.'.$fileExt[1];
            	$config['allowed_types'] = '*';
            	$config['max_filename'] = '255';
            	$config['max_size'] = '10024'; //10 MB
            	$config['overwrite'] = TRUE;
            	if(isset($_FILES['childImage']['name'])){
                	if(0 < $_FILES['childImage']['error']){
                    	$this->status = '0';
                    	$this->str_response ="Error In File"; 
               	 	}
            		else{
                		$this->load->library('upload', $config);
                		$this->upload->initialize($config);
                		if (!$this->upload->do_upload('childImage')) {
                    		$result =  $this->upload->display_errors();
                   			$this->status = '0';
                   			$this->str_response =$result; 
                		} 
                		$Image=$config['file_name'];
                		$studentEntity = array(
                			'ParentId_FK'=>$postData->Parent_Id,
                			'First_Name' => $postData->First_Name,
                			'Middle_Name'  =>$postData->Middle_Name,
                			'Nick_Name'  =>$postData->Nick_Name,
                			'Student_Image'  =>$postData->$Image,
                			'Student_Age'  =>$postData->Student_Age,
                			'Health_Issue'  =>$postData->Health_Issue,
                			'Equipment_Required'  =>$postData->Equipment_Required
                		);
                		$studentData =array(
                  			'Table'=> 'student',
                    		'Value' => $studentEntity 
                		);           
                		$studentResult=$this->Udcmodel->create($studentData);
                		$schoolEntity = array(
                    		'StudentId_FK' =>$studentResult,
                    		'School_Name' => $postData->School_Name,
                    		'School_Unit'  =>$postData->School_Unit,
                    		'School_City' =>$postData->School_City , 
                    		'School_Postal_Code' =>$postData->School_Postal_Code,
                    		'School_Province' =>$postData->School_Province,
                    		'School_Contact' =>$postData->School_Contact
                		);
                		$schoolData = array(
                    		'Table' => 'student_school',
                    		'value'=>$schoolEntity 
                		);
                		$schoolResult = $this->Udcmodel->create($addressData);
                		if ( $studentResult == true && $schoolResult == true) {
                    		$this->status = '1';
                    		$this->str_response ="Student Registered Successfully";           
                		}
                		else{
                    		$this->status = '0';
                    		$this->str_response ="Not Registered";
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
                $this->str_response = "Incomplete Information [* Fill Required Fields ]";
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
    public function updateparentProfile_post(){
        $postData = (object)$this->post();
        if (isset($postData->First_Name) == true && isset($postData->Last_Name) == true && isset($postData->Middle_Name) == true &&isset($postData->First_Name) == true && isset($postData->Driver_Id) == true && isset($postData->User_Id) == true && isset($postData->Phone_Number) == true && isset($postData->Parent_Type) == true) {
            if ($postData->First_Name != null  && $postData->Last_Name != null && $postData->Medical_Issue != null && $postData->Phone_Number != null && $postData->Emergency_Contact != null  && $postData->Parent_Id != null && $postData->User_Id != null) {
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
                $updateP = array(
                    'Parent_Type' =>$postData->Parent_Type ,
                    'Phone_Number' =>$postData->Phone_Number 
                );
                $updateParent = array(
                    'Primary_Key' => 'Parent_Id',
                    'Primary_Value' => $postData->Parent_Id,
                    'Table' => 'parent_profile',
                    'Values' => $updatep
                );
                $parentResult = $this->Udcmodel->update($updateParent);
                $updateA = array(
                    'UserId_FK' =>$postData->Parent_Id ,
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
                if ($userResult == true || $parentResult == true) {
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
                $this->str_response = "Incomplete Information [* Fill Required Fields ]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }
    public function updateStudent_post(){
        $postData = (object)$this->post();
        if (isset($postData->First_Name) == true && isset($postData->Middle_Name) == true && isset($postData->Last_Name) == true && isset($postData->ParentId_FK) && isset($postData->Student_Id) == true  && isset($postData->Nick_Name) == true && isset($postData->Student_Age) == true && isset($postData->Health_Issue) == true && isset($postData->Equipment_Required) == true && isset($postData->School_Id) == true  && isset($postData->StudentId_FK) == true && isset($postData->School_Code) == true && isset($postData->School_Name) == true && isset($postData->School_Unit) == true && isset($postData->School_City) == true && isset($postData->School_Postal_Code) == true && isset($postData->School_Province) == true && isset($postData->School_Contact) == true) {
            if ($postData->First_Name != null  && $postData->Last_Name != null && $postData->Student_Id != null && $postData->ParentId_FK != null && $postData->Nick_Name != null && $postData->Student_Age != null  && $postData->School_Id != null && $postData->StudentId_FK != null && $postData->School_Code != null && $postData->School_Name != null && $postData->School_Unit != null && $postData->School_City != null && $postData->School_Postal_Code != null && $postData->School_Province != null && $postData->School_Contact != null ) {
                $updateSEntity = array(
                    'ParentId_FK'  =>$postData->ParentId_FK,
                    'First_Name' =>$postData->First_Name ,
                    'Middle_Name' =>$postData->Middle_Name ,
                    'Last_Name' =>$postData->Last_Name ,
                    'Nick_Name' =>$postData->Nick_Name ,
                    'Student_Age' =>$postData->Student_Age ,
                    'Health_Issue' =>$postData->Health_Issue ,
                    'Equipment_Required' =>$postData->Equipment_Required 
                );
                $updateStudent = array(
                    'Primary_Key' =>'Student_Id',
                    'Primary_Value' =>$postData->Student_Id,
                    'Table' =>'student',
                    'Values' =>$updateSEntity,
                );
                $student = $this->Udcmodel->update($updateStudent);
                $updateAEntity = array(
                    'StudentId_FK' =>$postData->StudentId_FK ,
                    'School_Code' =>$postData->School_Code ,
                    'School_Name' =>$postData->School_Name ,
                    'School_Unit' =>$postData->School_Unit ,
                    'School_City' =>$postData->School_City ,
                    'School_Province' =>$postData->School_Province,
                    'School_Contact' =>$postData->School_Contact
                );
                $updateSchool = array(
                    'Primary_Key' =>'School_Id' ,
                    'Primary_Value' =>$postData->School_Id ,
                    'Table' => 'student_school',
                    'Values' => $updateAEntity, 
                );
                $school = $this->Udcmodel->update($updateSchool);
                if ($student != false || $school != false) {
                    $this->status = '1';
                    $this->str_response = "Information Updated Successfully";
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Information not Updated";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Incomplete Information [* Fill Required Fields]";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = "Input Parameter not Defined";
        }
        $this->sendresponse();
    }
    public function updateImage_post(){
            $fileExt = explode('/', $_FILES['parentImage']['type']);
            $config['upload_path'] = 'assets/images/parents/';
            $config['file_name'] = $this->post('User_Id').'_'.rand().'_'.str_replace (' ', '',$this->post('First_Name')).'_profile_pic.'.$fileExt[1];
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '10024'; //10 MB
            $config['overwrite'] = TRUE;
            if(isset($_FILES['parentImage']['name'])){
                if(0 < $_FILES['parentImage']['error']){
                    $this->status = '0';
                    $this->str_response = "Error Occured";
                }
                else{
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('parentImage')) {
                        $result =  $this->upload->display_errors();
                        $this->status = '0';
                        $this->str_response = $result;
                    } 
                    else {
                        $filter = (object) array(
                            'Parent_Id' => (int)0,
                            'UserId_FK' => $this->post('User_Id'),
                            'Parent_Type' =>'',
                            'Community' => '',
                            'isSingle' => true,
                        );
                        $parentResult = $this->Parentmodel->loadParent($filter);
                        $parentResult->Parent_Image = $config['file_name'];
                        $entity = array(
                            'Table' => "parent_profile",
                            'Primary_Key' =>'Parent_Id',
                            'Primary_Value'=>$parentResult->Parent_Id,
                            'Values' => $parentResult
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
            $this->status = '1';
            $this->str_response = "File not Selected";
        }
        $this->sendresponse();
    }
    public function parentProfile_post(){
        $filter = (object)$this->post();
        if (isset($filter->User_Id) == true) {
            if ($filter->User_Id != null) {
                $userFilter =(object) array(
                    'User_Id' => $filter->User_Id,
                    'Email' => '',
                    'Password' =>'',
                    'Cell_Number'=>'',
                    'isSingle' =>true 
                );
                $user = $this->Usermodel->getuser($userFilter);
                $profileFilter =(object) array(
                    'UserId_FK' =>$filter->User_Id , 
                    'Parent_Id' =>'',
                    'Parent_Type'=>'',
                    'Community' =>'',
                    'isSingle' => true
                );
                if ($user != false ) {
                $basicProfile = $this->Parentmodel->loadParent($profileFilter);
                    if ($basicProfile != false) {
                        $addressFilter =(object) array(
                            'Parent_Id' =>$basicProfile->Parent_Id , 
                            'isSingle' =>true
                        );
                        $address = $this->Parentmodel->loadaddress($addressFilter);
                        $fullProfile = array(
                            'User_Id' => $user->User_Id,
                            'First_Name' =>$user->First_Name ,
                            'Middle_Name' =>$user->Middle_Name ,
                            'Last_Name' => $user->Last_Name,
                            'Email' =>$user->Email , 
                            'Cell_Number' =>$user->Cell_Number,
                            'Parent_Id' =>$basicProfile->Parent_Id ,
                            'UserId_FK' =>$basicProfile->UserId_FK ,
                            'Parent_Type' =>$basicProfile->Parent_Type ,
                            'Parent_Image' => $basicProfile->Parent_Image,
                            'Phone_Number' =>$basicProfile->Phone_Number ,
                            'NIC' =>$basicProfile->NIC ,
                            'Community' =>$basicProfile->Community,
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
                    $this->str_response = "User not Found";
                }
                
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Input Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = 'Filter not Set';
        }
        $this->sendresponse();
    }
    public function Student_post(){
        $filter = (object)$this->post();
        if (isset($filter->Parent_Id) == true) {
            if ($filter->Parent_Id != null) {
                $studentFilter =(object) array(
                    'Student_Id' =>(int)0 ,
                    'Parent_FK' => $filer->Parent_Id,
                    'First_Name' =>'' ,
                    'Last_Name' =>'' ,
                    'Nick_Name'  =>'' 
                );
                $student = $this->Parentmodel->loadStudent($studentFilter);
                if ($student != false) {
                    $this->status = '1';
                    $this->str_response = $student;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "No Record Found";
                }
            }
            else{
                $this->status = '0';
                $this->str_response = "Invalid Input Filter";
            }
        }
        else{
            $this->status = '0';
            $this->str_response = 'Filter not Set';
        }
        $this->sendresponse();
    }
    public function Driver_post(){
        $filter = (object)$this->post();
        if (isset($filter->Parent_Id) == true) {
            if ($filter->Parent_Id > (int) 0) {
                $driverFilter =(object) array(
                    'Parent_Id' =>$filter->Parent_Id , 
                    'isSingle' =>false
                );
                $resultDriver = $this->Parentmodel->loadDriver($driverFilter);
                if ($resultDriver != false) {
                    $this->status = '1';
                    $this->str_response = $resultDriver;
                }
                else{
                    $this->status = '0';
                    $this->str_response = "Driver not Found";
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
        if (isset($filter->User_Id) == true) {
            if ($filter->User_Id > (int) 0) {
                $rideFilter =(object) array(
                    'User_Id' =>$filter->User_Id , 
                    'isSingle' =>false
                );
                $resultRide = $this->Parentmodel->loadRide($rideFilter);
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
}
?>