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
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css'>

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>

<body>
<style>
.dropdown-submenu{ position: relative; }

.dropdown-submenu>.dropdown-menu{
  top:0;
  left:100%;
  margin-top:-6px;
  margin-left:-1px;
  -webkit-border-radius:0 6px 6px 6px;
  -moz-border-radius:0 6px 6px 6px;
  border-radius:0 6px 6px 6px;
}

.dropdown-submenu>a:after{
  display:block;
  content:" ";
  float:right;
  width:0;
  height:0;
  border-color:transparent;
  border-style:solid;
  border-width:5px 0 5px 5px;
  border-left-color:#cccccc;
  margin-top:5px;margin-right:-10px;
}
.dropdown-submenu:hover>a:after{
  border-left-color:#555;
}
.dropdown-submenu.pull-left{ float: none; }
.dropdown-submenu.pull-left>.dropdown-menu{
  left: -100%;
  margin-left: 10px;
  -webkit-border-radius: 6px 0 6px 6px;
  -moz-border-radius: 6px 0 6px 6px;
  border-radius: 6px 0 6px 6px;
}

@media (min-width: 768px) { 

}
@media (min-width: 992px) { 

}
@media (min-width: 1200px) { 

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
                    
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin' || $_SESSION['dp'] == 'Department Head'){ ?>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pre Register List<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="pre_register_list.php">Pre Register List</a></li>
                            <li><a href="online_register_student.php">Online register list</a></li>
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
                
                    <!--<li class="dropdown">
                        <a href="Graduate.php">Graduate</a>
                        
                    </li>-->
                    <?php }?>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <!--<li>
                        <a href="student_barcode_list.php">Student Barcode</a>
                    </li>-->
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