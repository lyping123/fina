<?php 
include("include/db.php");
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
	session_destroy();
	
}
if(isset($_POST['login-submit'])){
    //$query="select * from student where ic='".$_POST['user_ic']."' and (s_status <> 'DELETE' && s_status <> 'QUIT')";
    $query="select * from student where REPLACE(ic, '-', '') = '".$_POST['user_ic']."' and (s_status <> 'DELETE' && s_status <> 'QUIT')";
    $sttr=mysqli_query($conn,$query);
    $result=mysqli_fetch_array($sttr);
    $num=mysqli_num_rows($sttr);
    if($num>0){
        if($result['s_status'] == 'DELETE'){
            echo "<script>
            window.location.href='student_login.php';
            alert('Your account is in delete status, contact admin to solve the problem.');
            </script>";
        
        }elseif($result['s_status'] == 'QUIT'){
            echo "<script>
            window.location.href='student_login.php';
            alert('Your account is in quit status, contact admin to solve the problem.');
            </script>";
        }elseif($result['s_status'] == 'GRADUATE'){
            echo "<script>
            window.location.href='student_login.php';
            alert('Your account is in graduate status, contact admin to solve the problem.');
            </script>";
        }else{
            $_SESSION['name']=$result['s_name'];
			$_SESSION['ic']=$result['ic'];
            $_SESSION['id']=$result[0];
			$_SESSION["course"]=$result["course"];
		    $_SESSION['level']= 'student';
            echo "<script>
            window.location.href='student_break.php';
            alert('Login Successfully.');
            </script>";
            }
    }
    else{
        echo "<script>
        window.location.href='student_break.php';
        alert('Fail to Login')
        </script>";
    }
}

$qry="SELECT * FROM announcement ORDER BY id DESC LIMIT 1";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);



?>
<html>
<head>
	<title>Your Website Title</title>
    
    
    
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="fb:app_id"          content="1063511367088109" /> 
<meta property="og:type"            content="article" /> 
<meta property="og:url"             content="http://leave-application.jom-jom.com/user/index.php" /> 
<meta property="og:title"           content="Introducing our New Site" /> 
<meta property="og:image"           content="https://scontent-sea1-1.xx.fbcdn.net/hphotos-xap1/t39.2178-6/851565_496755187057665_544240989_n.jpg" /> 
<meta property="og:description"    content="http://leave-application.jom-jom.com/user/index.php" />
<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .announcement-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
    }

    .announcement-title {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-top: 0;
    }

    .announcement-date {
      font-size: 14px;
      color: #777;
      margin-top: 5px;
    }

    .announcement-content {
      font-size: 16px;
      color: #333;
      margin-top: 10px;
    }
  </style>
  <style>
body {
    padding-top: 90px;
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:left;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

</style>
</head>
	<script>
	  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1063511367088109',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/zh_CN/sdk.js#xfbml=1&version=v2.8";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
    

    
    <link href="css/bootstrap.min.css" rel="stylesheet">
<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="announcement-container">
    <h1>Announcement</h1>
    <div>
      
      <p class="announcement-date" id="announcementDate"><?=$result["a_date"]?></p>
      <p class="announcement-content" id="announcementContent"><?=$result["announcement"]?></p>
    </div>
  </div>
  <br>
			</div>
		</div>
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-12">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<!--<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>-->
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="student_login.php" method="post" role="form" style="display: block;">
									<div class="form-group">
                                        <label>Student IC:</label>
										<input type="text" name="user_ic" id="username" tabindex="1" class="form-control" placeholder="Ic" value="">
									</div>
									
									<!--<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>-->
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<!--<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>-->
								</form>
								<form id="register-form" action="http://phpoll.com/register/process" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


    <script src="js/jquery.js"></script>
<script>
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

</script>