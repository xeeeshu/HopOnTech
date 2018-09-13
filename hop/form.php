<?php include('header.php');?>
<!--/banner-->
<!--    <script type="text/javascript">

    var brand = document.getElementById("logo-id");
     brand.className ='attachment_upload';
     brand.onchange = function() {
         console.log(document.getElementById('parentPicUpload').value = this.value.substring(12));
     };
    function readURL(input) {
        console.log(input)
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                console.log(e)
                console.log(e.target.result)
                $('img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById('logo-id').change(function() {

        readURL(document.getElementById('logo-id'));
    }); 

   function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    if (e.target.result != null) {
                        document.getElementById('img-preview').src=  e.target.result;
                    }

                }

                console.log(reader.readAsDataURL(input.files[0]));
            }
        }
document.getElementById('logo-id').addEventListener("change", function(){
   readURL(this); 
}) 
</script>  -->
<div class="banner1">
</div>
<!--//banner-->
<!--Gallery -->    
<section class="gallery" >
	<div class="container">
		<h2 class="heading-agileinfo why_us">Registration Forms<span>Lorem ipsum dolor sit amet, Sed ut perspiciatis unde omnis iste natus error sit voluptatem</span></h2>
		<div class="row agileinfo_work_grids">
            <div class="col-md-4 w3_agile_work_grid gallery1">
             <div class="wthree_work_grid1">
              <a href="images/g1.jpg" class="b-link-stripe b-animate-go  swipebox" title="Parents">
               <div class="agile_work_grid w3_agileits_sub_work">
                   <img src="images/g1.jpg" alt=" " class="img-responsive" />
                   <div class="agileits_w3layouts_work">
                    Parents
                </div>
            </div>
        </a>
        <br>
        <div class="text-center"><a href="#" class="btn btn-warning btn-block pb-modalreglog-submit" data-toggle="modal" data-target="#myModal2" >Parent Form</a></div>
    </div>

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="ParentRegCtrl" >
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="PersonalInfoDiv">
                <div class="modal-header reg-header">
                    <h4 class="modal-title" id="myModalLabel">Parent Registration</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name ="basicInfoForm">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control" name="fName" id="fname" name="fname" ng-model="parent.First_Name" placeholder="First Name here" required="">
                            </div>
                            <div ng-messages="basicInfoForm.fName.$error">
                                <span class="text-red" ng-message="required">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mname">Middle Name</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control" name="mName" id="mname" ng-model="parent.Middle_Name" placeholder="Middle Name here" required="">
                            </div> 
                            <div ng-messages="basicInfoForm.mName.$error">
                                <span class="text-red" ng-message="required">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                <input type="text" class="form-control" name="lName" id="lname" ng-model="parent.Last_Name" placeholder="Middle Name here" required="">
                            </div> 
                            <div ng-messages="basicInfoForm.lName.$error">
                                <span class="text-red" ng-message="required">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                <input type="email" class="form-control" name="pEmail" id="pemail" ng-model="parent.Email" placeholder="Email here" required="" ng-pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/">
                            </div>
                            <div ng-messages="basicInfoForm.pEmail.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span ng-message="pattern" class="text-red">Email is not valid.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input type="password" class="form-control" id="psw" name="Password" ng-model="parent.Password" placeholder="*******" required="" ng-minlength="8" ng-maxlenght="24" password-valid="">
                            </div> 
                            <div ng-messages="basicInfoForm.Password.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span class="text-red" ng-message="passwordlowercase">Password must have at least 1 lowercase alphabet.</span>
                                <span class="text-red" ng-message="passworduppercase">Password must have at least 1 uppercase alphabet.</span>
                                <span class="text-red" ng-message="passwordspecialchar">Password must have at least 1 special character.</span>
                                <span class="text-red" ng-message="passwordnumber">Password must have at least 1 numeric value..</span>
                                <span class="text-red" ng-message="minlength">Password should have at least 8 characters.</span>
                                <span class="text-red" ng-message="maxlength">Password should have at most 24 characters.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input type="password" class="form-control" id="C_Password" name="C_Password" placeholder=" Confirm Password here" ng-model="parent.C_Password" required="" password-Confirm="" pass-val="{{parent.Password}}">
                            </div>
                            <div ng-messages="basicInfoForm.C_Password.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span ng-message="passwordmatch" class="text-red">Password is not match</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer reg-header">
                    <button type="button" class="btn btn-success" ng-disabled="basicInfoForm.$invalid" onclick="personalInfoNext()">Next</button>
                </div>
            </div>
            <div class="modal-content element-hidden" id="PersonalInfoNext">
                <div class="modal-header reg-header">
                    <h4 class="modal-title" id="myModalLabel">Contact Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="contactInfoForm">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                <input type="text" class="form-control" name="phone" id="phone" ng-model="parent.Phone_Number" placeholder="+9205178658" ng-pattern="/^\+?\d{2}?\d{3}?\d{5}$/" required="">
                            </div>
                            <div ng-messages="contactInfoForm.phone.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span class="text-red" ng-message="pattern">Please match pattern [+925178658 || 915178658]</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                <input type="text" class="form-control" name="mobile" id="mobile" ng-model="parent.Cell_Number" placeholder="+923001234567" ng-pattern="/^\+?\d{2}?\d{3}?\d{7}$/"  required="">
                            </div>
                            <div ng-messages="contactInfoForm.mobile.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span class="text-red" ng-message="pattern">Please match pattern [+923001234567 || 923001234567]</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nic">NIC</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                <input type="text" class="form-control" name="nic" id="nic" ng-model="parent.NIC" placeholder="NIC No here" required="">
                            </div>
                            <div ng-messages="contactInfoForm.nic.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="parenttype">Parent Type</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-info"></span></span>
                                <select  class="form-control" name="parenttype" id="parenttype" ng-model="parent.Parent_Type" placeholder="National Identity No here">
                                    <option value="">Select</option>
                                    <option id="father" value="Father"> Father</option>
                                    <option value="Mother"> Mother</option>
                                    <option value="Gaurdian"> Gaurdian</option>
                                </select>
                            </div>
                            <div ng-messages="contactInfoForm.parenttype.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer reg-header">
                    <button type="button" class="btn btn-primary back-left"  
                    onclick="personalInfoBack()">Back</button>
                    <button type="button" class="btn btn-success" ng-disabled="contactInfoForm.$invalid" onclick="contactInfoNext()">Next</button>
                </div>
            </div>

            <div class="modal-content element-hidden" id="ContactInfoNext">
                <div class="modal-header reg-header">
                    <h4 class="modal-title" id="myModalLabel">Address</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="addressInfoForm">
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-building"></span></span>
                                <input type="text" class="form-control" name="unit" id="unit" ng-model="parent.Unit" placeholder="Unit here" required="">
                            </div>
                            <div ng-messages="addressInfoForm.unit.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="house">House</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fas fa-home"></span></span>
                                <input type="text" class="form-control" name="house" id="house" ng-model="parent.House" placeholder="House here" required="">
                            </div>
                            <div ng-messages="addressInfoForm.house.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-address-card"></span></span>
                                <input type="text" class="form-control" name="city" id="city" ng-model="parent.City" placeholder="City here" required="" minlength="4">
                            </div>
                            <div ng-messages="addressInfoForm.city.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span ng-message="minlength" class="text-red">*City Should have at least 4 Characters.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postalCode">Postal/Zip Code</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-map-pin"></span></span>
                                <input type="text" class="form-control" name="postalCode" id="postalCode" ng-model="parent.Postal_Code" placeholder="K1B 4L9" required="" ng-pattern="/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/">
                            </div>
                            <div ng-messages="addressInfoForm.postalCode.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span ng-message="pattern" class="text-red">* Invalid Postal Code Pattern*[K1B 4L9]</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <div class="input-group pb-modalreglog-input-group">
                                <span class="input-group-addon"><span class="fa fa-map"></span></span>
                                <input type="text" class="form-control" name="province" id="province" ng-model="parent.Province" placeholder="Province here" required="" minlength="4">
                            </div>
                            <div ng-messages="addressInfoForm.province.$error">
                                <span ng-message="required" class="text-red">* Required</span>
                                <span ng-message="minlength" class="text-red">*Province should have at least 4 Character.</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer reg-header">
                    <button type="button" class="btn btn-primary back-left"
                    onclick="contactInfoBack()">Back</button>
                    <button type="button" class="btn btn-success" ng-disabled="addressInfoForm.$invalid" onclick="addressInfoNext()">Next</button>
                </div>
            </div>

            <div class="modal-content element-hidden" id="AddressInfoNext">
                <div class="modal-header reg-header">
                    <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <div class="form-group">
                           <div class="main-img-preview">
                              <img class="thumbnail img-preview" src="images/dummyProfile.png" title="Preview Logo">
                          </div>
                          <div class="input-group">
                              <input id="parentPicUpload" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                              <div class="input-group-btn">
                                 <div class="uploadfile btn btn-danger fake-shadow" >
                                    <span><i class="glyphicon glyphicon-upload"></i> Browse Picture</span>
                                    <input id="logo-id" name="logo"  demo-file-model="myFile" type="file" file-read="userProfile" class="attachment_upload" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div></form>
                <div class="modal-footer reg-header">
                    <button type="button" class="btn btn-primary submit-left"  
                    onclick="addressInfoBack()">Back</button>
                    <button type="button" class="btn btn-success" ng-disabled="addressInfoForm.$invalid" ng-click="registerParent()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="wthree_work_grid1">
      <a href="images/g2.jpg" class="b-link-stripe b-animate-go  swipebox" title="Fee Structure">
       <div class="agile_work_grid w3_agileits_sub_work">
           <img src="images/g2.jpg" alt=" " class="img-responsive" />
           <div class="agileits_w3layouts_work">
            Fee Structure
        </div>
    </div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">Fee Structure Form</a></div>
</div>
<div class="wthree_work_grid1">
  <a href="images/g3.jpg" class="b-link-stripe b-animate-go  swipebox" title="Behavior">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g3.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
           Behavior
       </div>
   </div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">School Bus Behavior Form</a></div>
</div>
</div>
<div class="col-md-4 w3_agile_work_grid">
 <div class="wthree_work_grid1">
  <a href="images/g4.jpg" class="b-link-stripe b-animate-go  swipebox" title="Students">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g4.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
        Students
    </div>
</div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">Student Form</a></div>
</div>
<div class="wthree_work_grid1">
  <a href="images/g5.jpg" class="b-link-stripe b-animate-go  swipebox" title="Safety & Security">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g5.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
        Safety/Security
    </div>
</div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">Safety And Security Form</a></div>
</div>
<div class="wthree_work_grid1">
  <a href="images/g6.jpg" class="b-link-stripe b-animate-go  swipebox" title="   Vehicle Checklist">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g6.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
        Checklist
    </div>
</div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">Vehicle Checklist Form</a></div>
</div>
</div>
<div class="col-md-4 w3_agile_work_grid">
 <div class="wthree_work_grid1">
  <a href="images/g7.jpg" class="b-link-stripe b-animate-go  swipebox" title="Driver">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g7.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
        Driver
    </div>
</div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block pb-modalreglog-submit" data-toggle="modal" data-target="#myModal3">Driver Form</a></div>
</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="DriverRegCtrl" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="driverInfoDiv">
            <div class="modal-header reg-header">
                <h4 class="modal-title" id="myModalLabel">Driver Registration</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="basicInfoForm">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            <input type="text" class="form-control" name="dfName" id="dfname" ng-model="driver.First_Name" placeholder="First Name here" required="">
                        </div>
                        <div ng-messages="basicInfoForm.dfName.$error">
                            <span class="text-red" ng-message="required">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            <input type="text" class="form-control" name="dmName" id="dmname" ng-model="driver.Middle_Name"placeholder="Middle Name here" required="">
                        </div>
                        <div ng-messages="basicInfoForm.dmName.$error">
                            <span class="text-red" ng-message="required">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            <input type="text" class="form-control" name="dlName" id="dlname" ng-model="driver.Last_Name"placeholder="Last Name here" required="">
                        </div>
                        <div ng-messages="basicInfoForm.dlName.$error">
                            <span class="text-red" ng-message="required">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dEmail">Email</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                            <input type="email" class="form-control" name="dEmail" id="dEmail" ng-model="driver.Email"placeholder="Email here" required="" ng-pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/">
                        </div>
                        <div ng-messages="basicInfoForm.dEmail.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span ng-message="pattern" class="text-red">Email is not valid.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dPassword">Password</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                            <input type="password" class="form-control" name="dPassword" id="dPassword" ng-model="driver.Password"placeholder="*********"required="" ng-minlength="8" ng-maxlenght="24" password-valid="">
                        </div> 
                        <div ng-messages="basicInfoForm.dPassword.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span class="text-red" ng-message="passwordlowercase">Password must have at least 1 lowercase alphabet.</span>
                            <span class="text-red" ng-message="passworduppercase">Password must have at least 1 uppercase alphabet.</span>
                            <span class="text-red" ng-message="passwordspecialchar">Password must have at least 1 special character.</span>
                            <span class="text-red" ng-message="passwordnumber">Password must have at least 1 numeric value..</span>
                            <span class="text-red" ng-message="minlength">Password should have at least 8 characters.</span>
                            <span class="text-red" ng-message="maxlength">Password should have at most 24 characters.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dC_Password">Confirm Password</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                            <input type="password" class="form-control" id="c_Password" name="c_Password" placeholder=" Confirm Password here" ng-model="driver.C_Password" required="" password-Confirm="" pass-val="{{driver.Password}}">
                        </div>
                        <div ng-messages="basicInfoForm.c_Password.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span ng-message="passwordmatch" class="text-red">Password is not match</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer reg-header">
                <button type="button" class="btn btn-success" onclick="driverInfoNext()">Next</button>
            </div>
        </div>

        <div class="modal-content element-hidden" id="driverInfoNext">
            <div class="modal-header reg-header">
                <h4 class="modal-title" id="myModalLabel">Contact Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="dcontactInfoForm">
                    <div class="form-group">
                        <label for="dphone">Phone</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                            <input type="text" class="form-control" name="dphone" id="dphone" ng-model="driver.Phone_No" placeholder="+9205178658" ng-pattern="/^\+?\d{2}?\d{3}?\d{5}$/" required="">
                        </div>
                        <div ng-messages="dcontactInfoForm.dphone.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span class="text-red" ng-message="pattern">Please match pattern [+925178658 || 915178658]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dmobile">Mobile</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                            <input type="text" class="form-control" name="dmobile" id="dmobile" ng-model="driver.Cell_Number" placeholder="+923001234567" ng-pattern="/^\+?\d{2}?\d{3}?\d{7}$/"  required="">
                        </div>
                        <div ng-messages="dcontactInfoForm.dmobile.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span class="text-red" ng-message="pattern">Please match pattern [+923001234567 || 923001234567]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emergencycontact">Emergency</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                            <input type="text" class="form-control" name="emergencycontact" id="emergencycontact" ng-model="driver.Emergency_Contact" placeholder="+923001234567" ng-pattern="/^\+?\d{2}?\d{3}?\d{7}$/"  required="">
                        </div>
                        <div ng-messages="dcontactInfoForm.emergencycontact.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span class="text-red" ng-message="pattern">Please match pattern [+923001234567 || 923001234567]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startdate">Service Start</label>
                        <div class="input-group pb-modalreglog-input-group date">
                            <span class="input-group-addon "><span class="fa fa-calendar"></span></span>
                            <input type="text" class="form-control" name="startdate" id="startdate" ng-model="driver.Service_Start_Date"  placeholder="Service Start here" required="">
                        </div>
                        <div ng-messages="dcontactInfoForm.startdate.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="endDate">Service End</label>
                        <div class="input-group pb-modalreglog-input-group date">
                            <span class="input-group-addon "><span class="fa fa-calendar"></span></span>
                            <input type="text" class="form-control" name="enddate" id="endDate" ng-model="driver.Service_End_Date" placeholder="Service End Date here" required="">
                        </div>
                        <div ng-messages="dcontactInfoForm.enddate.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer reg-header">
                <button type="button" class="btn btn-primary back-left"  
                onclick="driverInfoBack()">Back</button>
                <button type="button" class="btn btn-success" onclick="dcontactInfoNext()">Next</button>
            </div>
        </div>
        <div class="modal-content element-hidden" id="dContactInfoNext">
            <div class="modal-header reg-header">
                <h4 class="modal-title" id="myModalLabel"> Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="daddressInfoForm">
                    <div class="form-group">
                        <label for="dUnit">Unit</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-building"></span></span>
                            <input type="text" class="form-control" name="dUnit" id="dUnit" ng-model="driver.Unit" ng-model="driver.Unit" placeholder="Unit here" required="">
                        </div>
                        <div ng-messages="daddressInfoForm.dUnit.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dHouse">House</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fas fa-home"></span></span>
                            <input type="text" class="form-control" name="dHouse" id="dHouse" placeholder="House here" ng-model="driver.House" required="" >
                        </div>
                        <div ng-messages="daddressInfoForm.dHouse.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dCity">City</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-address-card"></span></span>
                            <input type="text" class="form-control"  name="dCity" id="dCity" ng-model="driver.City" placeholder="City here" required="" minlength="4">
                        </div>
                        <div ng-messages="daddressInfoForm.dCity.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span ng-message="minlength" class="text-red">*City Should have at least 4 Characters.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dZip">Postal/Zip Code</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-map-pin"></span></span>
                            <input type="text" class="form-control" name="dZip" id="dZip" placeholder="K1B 4L9" ng-model="driver.Postal_Code" required="" ng-pattern="/^[ABCEGHJ-NPRSTVXY][0-9][ABCEGHJ-NPRSTV-Z] [0-9][ABCEGHJ-NPRSTV-Z][0-9]$/">
                        </div>
                        <div ng-messages="daddressInfoForm.dZip.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span ng-message="pattern" class="text-red">* Invalid Postal Code Pattern*[K1B 4L9]</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dProvince">Province</label>
                        <div class="input-group pb-modalreglog-input-group">
                            <span class="input-group-addon"><span class="fa fa-map"></span></span>
                            <input type="text" class="form-control" name="dProvince" id="dProvince" placeholder="Province here" ng-model="driver.Province" required="" minlength="4">
                        </div>
                        <div ng-messages="daddressInfoForm.dProvince.$error">
                            <span ng-message="required" class="text-red">* Required</span>
                            <span ng-message="minlength" class="text-red">* Province Should have at least 4 Characters.</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer reg-header">
                <button type="button" class="btn btn-primary back-left"
                onclick="dcontactInfoBack()">Back</button>
                <button type="button" class="btn btn-success" onclick="daddressInfoNext()" >Next</button>
            </div>
        </div>
        <div class="modal-content element-hidden" id="dAddressInfoNext">
            <div class="modal-header reg-header">
                <h4 class="modal-title" id="myModalLabel"> Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                   <div class="main-img-preview">
                      <img class="thumbnail img-preview" src="images/dummyProfile.png" title="Preview Logo">
                  </div>
                  <div class="input-group">
                      <input id="logo-D" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                      <div class="input-group-btn">
                         <div class="uploadfile btn btn-danger fake-shadow" >
                            <span><i class="glyphicon glyphicon-upload"></i> Browse Picture</span>
                            <input id="logo-id" name="logo" demo-file-model="myFile" file-read="userProfile" type="file" class="attachment_upload ng-isolate-scope">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer reg-header">
            <button type="button" class="btn btn-primary submit-left"
            onclick="daddressInfoBack()">Back</button>
            <button type="button" class="btn btn-success" ng-click="registerDriver()" >Submit</button>
        </div>
    </div>
</div>
</div>


<div class="wthree_work_grid1">
  <a href="images/g8.jpg" class="b-link-stripe b-animate-go  swipebox" title="Admission">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g8.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
         Admission
     </div>
 </div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled"> Admission Form</a></div>
</div>
<div class="wthree_work_grid1">
  <a href="images/g9.jpg" class="b-link-stripe b-animate-go  swipebox" title="School Staff">
   <div class="agile_work_grid w3_agileits_sub_work">
       <img src="images/g9.jpg" alt=" " class="img-responsive" />
       <div class="agileits_w3layouts_work">
        School
    </div>
</div>
</a>
<br>
<div class="text-center"><a href="#" class="btn btn-warning btn-block disabled">Student Behavior Form</a></div>
</div>
</div>

</div>
</div>
</section>	
<!-- //Gallery -->
<?php include('footer.php');?>