<?php
if (!isset($_SESSION)) {
  session_start();
}
include("include/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Synergy portal</title>

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
    <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'> -->
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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="max-height: 500px; overflow-y: auto;">
                <ul class="nav navbar-nav" >
                    <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Student <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="registration_form.php">Student Registration Form</a></li>
                        <li><a href="file_list.php?btn_0=ALL">Add student Document</a></li>
                        <li><a href="checkhandbook.php">Check College handbook agreement</a></li>
                            <li><a href="newaddress.php">View student address now</a></li>
                            <li><a href="add_studentresult.php">Add student exam result(JPK PI A)</a></li>
                            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add student Examination</a>
                            <ul class="dropdown-menu">
                              
                              <li><a href="transcript.php">Transcript</a></li>
                            </ul> -->
                            <li><a href="student_schedulesform.php">Add student class schedules</a></li>
                            <li><a href="add_announcement.php">Add announcement</a></li>
                        	  <li><a href="student_list.php">Student List</a></li>
                            <li><a href="student_payment.php">View Student Payment</a></li>
                            <li><a href="check_outstanding.php">View student outstanding</a></li>
                            <li><a href="memo_fee_form.php">Add student memo fee form</a></li>
                            <!--<li><a href="sijil.php">Sijil Maintaince</a></li>-->
                            <li><a href="job_tracer.php">Job_tracer List</a></li>
                            <li><a href="internship.php">Internship List</a></li>
                            <li><a href="mou.php?btn_0=ALL">Mou</a></li>
							<!--<li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Verification</a>
								<ul class="dropdown-menu">
									<li><a href="verification_form.php">Add Student Verification</a></li>
									<li><a href="verification_list.php">Student Verification List</a></li>
								</ul>
							</li>-->
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Verification</a>
                            <ul class="dropdown-menu">
                              <li><a href="verification_form.php">Add Student Verification</a></li>
                              <li><a href="verification_list.php">Student Verification List</a></li>
                            </ul>
                          </li>
                          
                          <li>
                          <a href="student_parent_list.php" >student Family</a>
                          </li>
                          </li>
                            <li><a href="semester_break.php">Semester Break</a></li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Holiday</a>
                            <ul class="dropdown-menu">
                              <li><a href="add_holiday.php">Add Holiday</a></li>
                              <li><a href="holiday_list.php">Holiday List</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Schools & Syllabus</a>
                            <ul class="dropdown-menu">
                              <li><a href="school_list.php">Schools List</a></li>
                              <li><a href="syllabus_list.php">Syllabus List</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add saksi</a>
                            <ul class="dropdown-menu">
                              <li><a href="saksi_form.php">Add Saksi form</a></li>
                              <li><a href="saksi_list.php">Saksi List</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="view_semester_break.php">view semester Break</a>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leave</a>
                            <ul class="dropdown-menu">
                              <li><a href="studentleavelist.php">Manage Student Leave</a></li>
                              <li><a href="admin_applyleave_form.php">Apply Leave for Student</a></li>
                              <li><a href="studentapplyleavelist.php">Apply Leave List</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PTPK</a>
                            <ul class="dropdown-menu">
                              <li><a href="issue.php">Manage issue PTPK</a></li>
                              <!-- <li><a href="document.php">Manage ptpk document</a></li> -->
                              <li><a href="ptpk_information.php">Add Student PTPK</a></li>
                              <li><a href="ptpk_list.php">Student PTPK List</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Attendance</a>
                            <ul class="dropdown-menu">
                              <li><a href="take_attend.php">Take Attendance</a></li>
                              <li><a href="list_information.php">Monthy Attendance</a></li>
                              <li><a href="verify_attendance.php">Daily Attendance</a></li>
                            </ul>
                          </li>
                          <li class="dropdown dropdown-submenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Finger print Attendance</a>
                            <ul class="dropdown-menu">
                              <li><a href="finger_print_list.php">Upload Attendance</a></li>
                              <li><a href="finger_print_file.php">Manage fingr Print file</a></li>
                            </ul>
                          </li>
                        </ul>
                        
                    </li>
                    <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin' || $_SESSION['dp'] == 'Department Head'){ ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Visitor Log Book <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="visitor_form.php">Add Visitor Log</a></li>
                        	<li><a href="visitor_list.php">Visitor Log List</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pre Register List<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="pre_register_list.php">Pre Register List</a></li>
                            <li><a href="online_register_student.php">Online register list</a></li>
                            <li><a href="rejected_list.php">rejected list</a></li>
                            <li><a href="referral_list.php">referral program list</a></li>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Cash Bill <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="f_receipt_form1.php">New Cash Bill</a></li>
                        	<li><a href="f_receipt_list1.php">Cash Bill List</a></li>
                          <li><a href="f_receipt_listnew.php">Cash Bill List(special)</a></li>
                          <li><a href="display_receipt.php">Vertify Student Receipt</a></li>
                          <li><a href="check_receipt.php">Check Receipt form</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Credit Note <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="f_cn_form1.php">New Credit Note</a></li>                          
                          <li><a href="f_cn_list1.php">Credit Note List</a></li>                          
                        </ul>
                    </li>
                   
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Certificate <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="view_cercollection.php">certificate collected list</a></li>
                        <li><a href="get_cer1.php">certificate collection form</a></li>
                          <li><a href="cerificate_receipt_form.php">certificate Recieve form</a></li>                          
                          <li><a href="view_recieve_list.php">certificate receive list</a></li>
                          
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="career_list.php" class="dropdown-toggle" data-toggle=""  aria-haspopup="true" aria-expanded="false"> Career</a>
                    </li>
                    <!--<li class="dropdown">
                        <a href="Graduate.php">Graduate</a>
                        
                    </li>-->
                    <?php }?>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <!--<li>
                        <a href="student_barcode_list.php">Student Barcode</a>
                    </li>-->
                <?php if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin' || $_SESSION['dp'] == 'Department Head'){ ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> PPL <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        	<li><a href="lawatan_ppl.php">Lawatan PPl</a></li>
                        	<li><a href="ppl_list.php">Lawatan PPL List</a></li>
                        </ul>
                    </li>
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



<script>
  document.addEventListener('keydown', function (event) {
  switch(event) {
  case 1:
    document.getElementById("textbox1").value+=1;
    break;
  case 2:
    document.getElementById("textbox1").value+=2;
    break;
  case 3:
    document.getElementById("textbox1").value+=3;
    break;
  default:
}

});

</script>