<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">STUDENT APPLICATION FORM
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Student Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_student.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="" required>
            </div>
            <div class="form-group">
            <label>NRIC</label>
            <input type="text" class="form-control" name="ic" value="" required>
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" name="nationality" value="" >
            </div>
            <div class="form-group">
            <label>Race</label>
            <select name="race" class="form-control" >
                <option value="Chinese">Chinese</option>
                <option value="Indian">Indian</option>
                <option value="Malay">Malay</option>
            </select>
            </div>
            <div class="form-group">
            <label>Residential Address</label>
            <input type="text" class="form-control" name="r_address" value="" >
            </div>
            <div class="form-group">
            <label>Residential Postcode</label>
            <input type="text" class="form-control" name="r_postcode" value="" >
            </div>
            <div class="form-group">
            <label>Residential State</label>
            <select name="r_state" class="form-control" >
                <option value="-">-</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Penang">Penang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selanggor">Selanggor</option>
                <option value="Terengganu">Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Correspondence Address</label>
            <input type="text" class="form-control" name="c_address" value="" >
            </div>
            <div class="form-group">
            <label>Correspondence Postcode</label>
            <input type="text" class="form-control" name="c_postcode" value="" >
            </div>
            <div class="form-group">
            <label>Correspondence State</label>
            <select name="c_state" class="form-control" >
                <option value="-">-</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Penang">Penang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selanggor">Selanggor</option>
                <option value="Terengganu">Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Internal Exam Fee</label>
            <input type="text" class="form-control" name="i_fee" value="" >
            </div>
            <div class="form-group">
            <label>Tuition Fee</label>
            <input type="text" class="form-control" name="fee" value="" >
            </div>
            <div class="form-group">
                <div class="col-md-4">
                <label>Payment Method</label>
                <select name="p_mothod" class="form-control" >
                    <option value="ptpk">PTPK</option>
                    <option value="cash">Cash</option>
                </select>
                </div>
                <div class="col-md-3">
                <label>RM</label>
                <input type="text" class="form-control" name="cost" value="" >
                </div>
                <div class="col-md-1">
                <br />X
                </div>
                <div class="col-md-4">
                <label>Month</label>
                <input type="text" class="form-control" name="month" value="" >
                </div>
            </div>
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate()"> Check if stay hostel</h3>
                </header>
                <div class="panel-body">  
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Hostel Fee</label>
                        <input type="text" class="form-control" name="h_fee" id="h_fee" value="" disabled>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                            <label>RM</label>
                            <input type="text" class="form-control" name="h_cost" id="h_cost" value="" disabled>
                            </div>
                            <div class="col-md-1">
                            <br />X
                            </div>
                            <div class="col-md-4">
                            <label>Month</label>
                            <input type="text" class="form-control" name="h_month" id="h_month" value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="form-group">
            <label>Photo</label>
            <input type="file" class="form-control" name="photo" value="" >
            </div>
        </div>
        
        <div class="col-md-2"></div>
        
        <div class="col-md-5">
            <div class="form-group">
            <label>Chinese Name</label>
            <input type="text" class="form-control" name="c_name" value="" >
            </div>
          <div class="col-md-12" style="padding-left:0px;">
           <div class="col-md-8" style="padding-left:0px; height:30px;">
            <div class="form-group">
            <label>Date Of Birth</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="birthday" id="dtp_input2" value="" /><br/>
            </div>
           </div>
           <div class="col-md-3 col-md-offset-1" >
            <div class="form-group">
            <label>Age</label>
            <input type="text" class="form-control" name="age" value="" >
            </div>
           </div>
          </div>
          <div class="col-md-12" style="padding-left:0px;">
           <div class="col-md-8" style="padding-left:0px;">
            <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" >
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            </div>
           </div>
           <div class="col-md-3 col-md-offset-1" >
            <div class="form-group">
            <label>Marital Status</label>
            <select name="m_status" class="form-control" >
                <option value="Single">Single</option>
                <option value="Married">Married</option>
            </select>
            </div>
           </div>
          </div>
             <div class="form-group">
            <label>Religion</label>
            <select name="religion" class="form-control" >
                <option value="Buddhism">Buddhism</option>
                <option value="Christianity">Christianity</option>
                <option value="Daoism">Daoism</option>
                <option value="Hinduism">Hinduism</option>
                <option value="Islam">Islam</option>
            </select>
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="" >
            </div>
            <div class="form-group">
            <label>Student ID No.</label>
            <input type="text" class="form-control" name="s_id" value="" >
            </div>
            <div class="form-group">
            <label>Contact(Home)</label>
            <input type="text" class="form-control" name="h_contact" value="" >
            </div>
            <div class="form-group">
            <label>Contact(H/P)</label>
            <input type="text" class="form-control" name="hp_contact" value="" >
            </div>
            <div class="form-group">
            <label>Guardian</label>
            <input type="text" class="form-control" name="guardian" value="" >
            </div>
            <div class="form-group">
            <label>School</label>
            <input type="text" class="form-control" name="school" value="" >
            </div>
            
           
            
           
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" >
                <option value="Accounting">Accounting</option>
                <option value="Electronic">Electronic</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Networking">Networking</option>
                <option value="Programming">Programming</option>
            </select>
            </div>
            <div class="form-group">
            <label>Date Join</label>
<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="" >
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="join_date" id="dtp_input3" value="" /><br/>
            </div>
        </div>
        <div class="col-md-1"></div>
       
        <div class="col-md-12">
            <div class="form-group">
            <label>Do you suffer from any physical disability or illness? If so, please specify the nature of these conditions. Otherwise, state NONE.</label>
            <input type="text" class="form-control" name="desc" value="" >
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save"><i class=""></i> Save </button>
            </div>
        </div>
        </form>
     
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
function validate(){
	if(document.getElementById('hostel').checked) {
		document.getElementById('h_fee').disabled = false;
		document.getElementById("h_fee").required = true;
		document.getElementById('h_cost').disabled = false;
		document.getElementById("h_cost").required = true;
		document.getElementById('h_month').disabled = false;
		document.getElementById("h_month").required = true;
	} else {
		document.getElementById('h_fee').disabled = true;
		document.getElementById("h_fee").required = false;
		document.getElementById('h_cost').disabled = true;
		document.getElementById("h_cost").required = false;
		document.getElementById('h_month').disabled = true;
		document.getElementById("h_month").required = false;
	}
}
</script>