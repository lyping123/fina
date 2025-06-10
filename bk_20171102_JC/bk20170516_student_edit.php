<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit student.');
}
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
<?php
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM student WHERE id = '".$_GET['id']."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Student Information
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
        <form class="form-horizontal" method="post" action="add_student.php?action=edit&id=<?=$row['id']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?=$row['s_name']?>" required>
            </div>
            <div class="form-group">
            <label>NRIC</label>
            <input type="text" class="form-control" name="ic" value="<?=$row['ic']?>" required>
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" name="nationality" value="<?=$row['nationality']?>" required>
            </div>
            <div class="form-group">
            <label>Race</label>
            <select name="race" class="form-control" required>
                <option value="Chinese" <?php if($row['race'] == 'Chinese'){echo "selected=\"selected\"";}?>>Chinese</option>
                <option value="Indian" <?php if($row['race'] == 'Indian'){echo "selected=\"selected\"";}?>>Indian</option>
                <option value="Malay" <?php if($row['race'] == 'Malay'){echo "selected=\"selected\"";}?>>Malay</option>
            </select>
            </div>
            <div class="form-group">
            <label>Residential Address</label>
            <input type="text" class="form-control" name="r_address" value="<?=$row['r_address']?>" required>
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" name="r_postcode" value="<?=$row['r_postcode']?>" required>
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="r_state" class="form-control" required>
                <option value="-">-</option>
                <option value="Johor" <?php if($row['r_state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['r_state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['r_state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['r_state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['r_state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['r_state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['r_state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['r_state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['r_state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['r_state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['r_state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['r_state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['r_state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Correspondence Address</label>
            <input type="text" class="form-control" name="c_address" value="<?=$row['c_address']?>" required>
            </div>
            <div class="form-group">
            <label>Postcode</label>
            <input type="text" class="form-control" name="c_postcode" value="<?=$row['c_postcode']?>" required>
            </div>
            <div class="form-group">
            <label>State</label>
            <select name="c_state" class="form-control" required>
                <option value="-">-</option>
                <option value="Johor" <?php if($row['c_state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['c_state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['c_state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['c_state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['c_state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['c_state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['c_state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['c_state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['c_state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['c_state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['c_state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['c_state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['c_state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
            </select>
            </div>
            <div class="form-group">
            <label>Internal Exam Fee</label>
            <input type="text" class="form-control" name="i_fee" value="<?=$row['i_fee']?>" required>
            </div>
            <div class="form-group">
            <label>Tuition Fee</label>
            <input type="text" class="form-control" name="fee" value="<?=$row['tuition_fee']?>" required>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                <label>Payment Method</label>
                <select name="p_mothod" class="form-control" required>
                    <option value="ptpk" <?php if($row['p_method'] == 'ptpk'){echo "selected=\"selected\"";}?>>PTPK</option>
                    <option value="cash" <?php if($row['p_method'] == 'cash'){echo "selected=\"selected\"";}?>>Cash</option>
                </select>
                </div>
                <div class="col-md-3">
                <label>RM</label>
                <input type="text" class="form-control" name="cost" value="<?=$row['cost_per_month']?>" required>
                </div>
                <div class="col-md-1">
                <br />X
                </div>
                <div class="col-md-4">
                <label>Month</label>
                <input type="text" class="form-control" name="month" value="<?=$row['p_month']?>" required>
                </div>
            </div>
            <?php if($row['h_status'] == 'YES'){?>
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate()" checked> Check if stay hostel</h3>
                </header>
                <div class="panel-body">  
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Hostel Fee</label>
                        <input type="text" class="form-control" name="h_fee" id="h_fee" value="<?=$row['h_fee']?>" required>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                            <label>RM</label>
                            <input type="text" class="form-control" name="h_cost" id="h_cost" value="<?=$row['h_cost_per_month']?>" required>
                            </div>
                            <div class="col-md-1">
                            <br />X
                            </div>
                            <div class="col-md-4">
                            <label>Month</label>
                            <input type="text" class="form-control" name="h_month" id="h_month" value="<?=$row['h_month']?>" required>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <?php }else{?>
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
            <?php }?>
            <div class="form-group">
            <label>Photo</label>
            <input type="file" class="form-control" name="photo" value="">
            </div>
        </div>
        
        <div class="col-md-1"></div>
        
        <div class="col-md-5">
            <div class="form-group">
            <label>Chinese Name</label>
            <input type="text" class="form-control" name="c_name" value="<?=$row['chinese_name']?>" required>
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?=$row['s_email']?>" required>
            </div>
            <div class="form-group">
            <label>Student ID No.</label>
            <input type="text" class="form-control" name="s_id" value="<?=$row['s_id']?>" required>
            </div>
            <div class="form-group">
            <label>Contact(Home)</label>
            <input type="text" class="form-control" name="h_contact" value="<?=$row['h_contact']?>" required>
            </div>
            <div class="form-group">
            <label>Contact(H/P)</label>
            <input type="text" class="form-control" name="hp_contact" value="<?=$row['hp_contact']?>" required>
            </div>
            <div class="form-group">
            <label>Guardian</label>
            <input type="text" class="form-control" name="guardian" value="<?=$row['guardian']?>" required>
            </div>
            <div class="form-group">
            <label>School</label>
            <input type="text" class="form-control" name="school" value="<?=$row['school']?>" required>
            </div>
            <div class="form-group">
            <label>Birthday</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['birthday']?>" required="required">
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="birthday" id="dtp_input2" value="<?=$row['birthday']?>" /><br/>
            </div>
            <div class="form-group">
            <label>Age</label>
            <input type="text" class="form-control" name="age" value="<?=$row['age']?>" required>
            </div>
            <div class="form-group">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="Male" <?php if($row['gender'] == 'Male'){echo "selected=\"selected\"";}?>>Male</option>
                <option value="Female" <?php if($row['gender'] == 'Female'){echo "selected=\"selected\"";}?>>Female</option>
            </select>
            </div>
            <div class="form-group">
            <label>Marital Status</label>
            <select name="m_status" class="form-control" required>
                <option value="Single" <?php if($row['m_status'] == 'Single'){echo "selected=\"selected\"";}?>>Single</option>
                <option value="Married" <?php if($row['m_status'] == 'Married'){echo "selected=\"selected\"";}?>>Married</option>
            </select>
            </div>
            <div class="form-group">
            <label>Religion</label>
            <select name="religion" class="form-control" required>
                <option value="Buddhism" <?php if($row['religion'] == 'Buddhism'){echo "selected=\"selected\"";}?>>Buddhism</option>
                <option value="Christianity" <?php if($row['religion'] == 'Christianity'){echo "selected=\"selected\"";}?>>Christianity</option>
                <option value="Daoism" <?php if($row['religion'] == 'Daoism'){echo "selected=\"selected\"";}?>>Daoism</option>
                <option value="Hinduism" <?php if($row['religion'] == 'Hinduism'){echo "selected=\"selected\"";}?>>Hinduism</option>
                <option value="Islam" <?php if($row['religion'] == 'Islam'){echo "selected=\"selected\"";}?>>Islam</option>
            </select>
            </div>
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" required>
                <option value="IT Networking" <?php if($row['course'] == 'IT Networking'){echo "selected=\"selected\"";}?>>IT Networking</option>
                <option value="Multimedia" <?php if($row['course'] == 'Multimedia'){echo "selected=\"selected\"";}?>>Multimedia</option>
                <option value="Eletronik" <?php if($row['course'] == 'Eletronik'){echo "selected=\"selected\"";}?>>Eletronik</option>
                <option value="Programming" <?php if($row['course'] == 'Programming'){echo "selected=\"selected\"";}?>>Programming</option>
                <option value="Accounting and Business" <?php if($row['course'] == 'Accounting and Business'){echo "selected=\"selected\"";}?>>Accounting and Business</option>
            </select>
            </div>
            <div class="form-group">
            <label>Date Join</label>
<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="<?=$row['date_join']?>" required="required">
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="join_date" id="dtp_input3" value="<?=$row['date_join']?>" /><br/>
            </div>
        </div>
        <div class="col-md-1"></div>
        
        <div class="col-md-12">
            <div class="form-group">
            <label>Do you suffer from any physical disability or illness? If so, please specify the nature of these conditions. Otherwise, state NONE.</label>
            <input type="text" class="form-control" name="desc" value="<?=$row['s_desc']?>" required>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
        		<button type="button" class="btn btn-warning" onclick="window.location.href='student_list.php'"> Cancel </button>
            </div>
        </div>
        </form>
    </div>  
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