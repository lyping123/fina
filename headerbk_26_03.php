<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Synergy College</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>
<style>
 
.dropdown-menu > li.kopie > a {
    padding-left:5px;
}
 
.dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
   top:0;left:100%;
   margin-top:-6px;margin-left:-1px;
   -webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;
 }
  
.dropdown-submenu > a:after {
  border-color: transparent transparent transparent #333;
  border-style: solid;
  border-width: 5px 0 5px 5px;
  content: " ";
  display: block;
  float: right;  
  height: 0;     
  margin-right: -10px;
  margin-top: 5px;
  width: 0;
}
 
.dropdown-submenu:hover>a:after {
    border-left-color:#555;
 }

/*.dropdown-menu > li > a:hover, .dropdown-menu > .active > a:hover {
  text-decoration: underline;
}  */
  
@media (max-width: 767px) {

  .navbar-nav  {
     display: inline;
  }
  .navbar-default .navbar-brand {
    display: inline;
  }
  .navbar-default .navbar-toggle .icon-bar {
    background-color: #fff;
  }
  .navbar-default .navbar-nav .dropdown-menu > li > a {
    color: red;
    background-color: #ccc;
    border-radius: 4px;
    margin-top: 2px;   
  }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a {
     color: #333;
   }
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
   .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
     background-color: #ccc;
   }

   .navbar-nav .open .dropdown-menu {
     border-bottom: 1px solid white; 
     border-radius: 0;
   }
  .dropdown-menu {
      padding-left: 10px;
  }
  .dropdown-menu .dropdown-menu {
      padding-left: 20px;
   }
   .dropdown-menu .dropdown-menu .dropdown-menu {
      padding-left: 30px;
   }
   li.dropdown.open {
    border: 0px solid red;
   }

}
 
@media (min-width: 768px) {
  ul.nav li:hover > ul.dropdown-menu {
    display: block;
  }
  #navbar {
    text-align: center;
  }
}  

</style>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php">Synergy College</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Student <span class="caret"></span></a>
                        <ul class="dropdown-menu">
							<li><a href="registration_form.php">Student Registration Form</a></li>
                            <!--<li><a href="tuition_fee.php">Tuition fee</a></li>-->
                        	<li><a href="student_list.php">Student List</a></li>
                            <!--<li><a href="sijil.php">Sijil Maintaince</a></li>-->
                            <li><a href="job_tracer.php">Job_tracer List</a></li>
                            <li><a href="internship.php">Internship List</a></li>
							<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Verification</a>
								<ul class="dropdown-menu">
									<li><a href="verification_form.php">Add Student Verification</a></li>
									<li><a href="verification_list.php">Student Verification List</a></li>
								</ul>
							</li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Visitor Log Book <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="visitor_form.php">Add Visitor Log</a></li>
                        	<li><a href="visitor_list.php">Visitor Log List</a></li>
                        </ul>
                    </li>
                    <!--<li>
                        <a href="student_list.php">Student List</a>
                    </li>-->
                    <!--<li>
                        <a href="#">Attendance</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">Receipt<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="receipt_form.php">New Receipt</a></li>
                        	<li><a href="receipt_list.php">Receipt List</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Receipt<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="f_receipt_form1.php">New Receipt(Pusat Kemahiran)</a></li>
                        	<li><a href="f_receipt_form2.php">New Receipt(Synergy Central)</a></li>
                        	<li><a href="f_receipt_list1.php">Receipt List(Pusat Kemahiran)</a></li>
                        	<li><a href="f_receipt_list2.php">Receipt List(Synergy Central)</a></li>
                        </ul>
                    </li>-->
                    
                    <li class="dropdown">
                        <a href="#">Cash Bill<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="f_receipt_form1.php">New Cash Bill</a></li>
                        	<li><a href="f_receipt_list1.php">Cash Bill List</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#">Credit Note<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="f_cn_form1.php">New Credit Note</a></li>                          
                          <li><a href="f_cn_list1.php">Credit Note List</a></li>                          
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="Graduate.php">Graduate</span></a>
                        
                    </li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
               	    <li>
                        <a href="school_list.php">Schools List</a>
                    </li>
                    <!--<li>
                        <a href="student_barcode_list.php">Student Barcode</a>
                    </li>-->
                <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin' || $_SESSION['dp'] == 'Department Head'){ ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> PP <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="add_pp_form.php">Add PP</a></li>
                        	<li><a href="pp_list.php">PP List</a></li>
                        </ul>
                    </li>
                <?php }?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Group <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="add_group_form.php">Add Group</a></li>
                        	<li><a href="group_list.php">Group List</a></li>
                        </ul>
                    </li>
                <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){?>
                    <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?=$_SESSION['name']?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="login.php?action=logout">Logout</a></li>
                  <!--<li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>-->
                </ul>
              </li>
                <?php }else{?>
                    <li>
                        <a href="index.php">login</a>
                    </li>
              <?php }?>
                
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>