<!DOCTYPE html>
<html lang="en"  ng-app="hop">
<head>
  <title>Hop App</title>
  <link rel="icon" href="favicon/favicon.ico">   
  <!-- Meta Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Hop App, School Van App" />
  <!-- // Meta Tags -->
  <!--booststrap-->
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
  <!--//booststrap end-->
  <!-- font-awesome icons -->
  <link href="css/fontawesome-all.css" rel="stylesheet">
  <!-- //font-awesome icons -->
  <link rel="stylesheet" type="text/css" href="css/popup.css">
  <!--stylesheets-->
  <link href="css/style.css" rel='stylesheet' type='text/css' media="all">
  <link href="css/notification/angular-csp.css" rel="stylesheet">
  <link href="css/notification/angular-ui-notification.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="bootstrap-datepicker/css/bootstrap-datepicker.css">
  <!--//stylesheets-->
</head>
<body>
  <header>
    <div class="header-bar">
      <div class="container">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="hedder-up">
          <h1><a class="navbar-brand" href="index.php"><img class="logo" src="images/logo.png"></a></h1>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav">
           <li class="nav-item" id="home">
            <a class="nav-link" href="index.php" >Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item" id="about">
            <a href="about.php" class="nav-link" >About</a>
          </li>
          <li class="nav-item" id="form">
            <a href="form.php" class="nav-link" >Forms</a>
          </li>
          <li class="nav-item" id="contact">
            <a href="contact.php" class="nav-link" >Contact</a>
          </li>
          <li>
            <a href="#" title="Login"  class="login pb-modalreglog-submit" data-toggle="modal" data-target="#myModal"><i class="fas fa-sign-in-alt"></i></a>
          </li>
        </ul>
      </div>

      <div class="clearfix"> </div>
    </nav>  
  </div>
</div>
<!-- //Navigation -->
</header>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="loginCtrl">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header reg-header">
        <h4 class="modal-title" id="myModalLabel">Login here!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="basicInfoForm">
          <div class="form-group" >
            <label for="email">Email address</label>
            <div class="input-group pb-modalreglog-input-group">
              <span class="input-group-addon"><span class="fa fa-user"></span></span>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" ng-model="credentials.userEmail" ng-pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" required="">
            </div>
            <div ng-messages="basicInfoForm.email.$error">
              <span ng-message="required" class="text-red">* Required</span>
              <span ng-message="pattern" class="text-red">Email is not valid.</span>
            </div>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group pb-modalreglog-input-group">
              <span class="input-group-addon"><span class="fa fa-lock"></span></span>
              <input type="password" class="form-control" id="pws" placeholder="Password" ng-model="credentials.userPassword" name="password" required="">
            </div><div ng-messages="basicInfoForm.password.$error">
              <span ng-message="required" class="text-red">* Required</span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer reg-header">
        <button type="button" class="btn btn-primary login-close-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" ng-click="login()" ng-disabled="basicInfoForm.$invalid">Log in</button>
      </div>
    </div>
  </div>
</div>