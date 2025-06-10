<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add1'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to update visitor details after add new student.');
}

?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
?>
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
        <form class="form-horizontal" method="post" action="register.php" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="" required>
            </div>
            <div class="form-group">
            <label>NRIC</label>
            <input type="text" class="form-control" name="ic" value="" pattern="^\d{12}$" required>e.g 991010071010
            </div>
            <div class="form-group">
            <label>Birth cert</label>
            <input type="text" class="form-control" name="b_sen" value=""  >
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
            <label>permanent Address</label>
            <input type="text" class="form-control" name="c_address" value="" >
            </div>
            <div class="form-group">
            <label>Home Postcode</label>
            <input type="text" class="form-control" name="c_postcode" value="" >
            </div>
            <div class="form-group">
            <label> State</label>
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
            <label>Tuition Fee Left</label>
            <input type="text" class="form-control" name="l_fee" value="" >
            </div>
            <div class="form-group">
            <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h4>Fee reminder setup</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <label>Payment Method</label>
                            <select name="p_mothod" id="pay" class="form-control" >
                                <option value="ptpk" >PTPK</option>
                                <option value="cash">Cash</option>
                                <option value="semester">Semester</option>
                                <option value="l_payment">Last Payment</option>
                                
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="t_start">Start date</label>
                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" name="t_start" value="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="t_end">End date</label>
                            <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" name="t_end" value="">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Monthly Payments</label>
                            <input type="text" class="form-control" name="m_l" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate()"> Check if stay hostel</h3>
                </header>
                <div class="panel-body" id="panel" style="display:none">  
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Parent Name</label>
                        <input type="text" class="form-control" name="p_name" id="p_name" value="" >
                        </div>
                        <div class="form-group">
                        <label>Parent Contact</label>
                        <input type="text" class="form-control" name="p_con" id="p_con" value="">
                        </div>
                        <div class="form-group">
                        <label>PP Name</label>
                        <select name="pp_name" class="form-control">
                            <option>Choose</option>
                            <?php 
                            $query="select * from login where l_status='ACTIVE' and level='pp'";
                            $sttr=mysqli_query($conn,$query);
                            while($result=mysqli_fetch_array($sttr)){
                                
                            
                            ?>
                            <option value="<?php echo $result['l_name']?>"><?php echo $result['l_name']?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Check in date</label>
                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" value="" >
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" name="check_in" id="dtp_input4" value="" />
                        </div>
                        <div class="form-group">
                        <label>Hostel</label>
                        <select name="hostel1" class="form-control">
                            <option>~Hostel~</option>
                             <?php
                                                $c_qry = "SELECT * FROM hostel WHERE h_status = 'ACTIVE'";
                                                $c_result = mysqli_query($conn, $c_qry);
												
												
                                                while ($c_row = mysqli_fetch_array($c_result))
                                                {
													 $spite=explode(" ",$c_row['h_gender']);
													  $count="select count(id) as count from student_detail where h_id='".$c_row['id']."' and s_status='ACTIVE'";
													 $result_c=mysqli_query($conn,$count);
													 $num=mysqli_fetch_array($result_c);
													 $slot=$c_row['slot']-$num['count'];
													 if($spite[0]<>"LECTURER"){
                                                    ?>
                                                    <option value="<?= $c_row['id'] ?>"><?= $c_row['h_address'] ?> (<?= $c_row['h_gender'] ?>)(Slot avaible:<?php if($slot>0){echo $slot;}else{echo "no slot avaible";} ?>)</option>
                                                <?php }} ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <label>Security Deposit</label>
                            <input type="text" class="form-control" name="s_deposit" placeholder="RM" value="" required />
                        </div>
                        
                    </div>
                </div>  
            </div>
            
            <!--<div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title"><input type="checkbox" id="ptpk" name="ptpk" value="YES"> Check if registered PTPK</h3>
                </header>
            </div>-->
            
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
            <input type="text" class="form-control" name="age" value="">
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
            <input type="text" class="form-control" name="h_contact" value="" pattern="^\d{2}-\d{7}$">e.g 04-XXXXXXX
            </div>
            <div class="form-group">
            <label>Student Contact(H/P)</label>
            <input type="text" class="form-control" name="hp_contact" value="" pattern="^\d{3}-\d{7,8}$">e.g 012-3456789 student.
            </div>
            <div class="form-group">
            <label>Contact(Guardian)</label>
            <input type="text" class="form-control" name="guardian" value="" pattern="^\d{3}-\d{7,8}$">e.g 012-3456789
            </div>
            <!--<div class="form-group">
            <label>School</label>
            <input type="text" class="form-control" name="school" value="" >
            </div>-->
            <div class="form-group">
            <label>Date Join</label>
<div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" type="text" value="" >
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="join_date" id="dtp_input3" value="" />
            </div>
           
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" required>
                <option value="">Choose</option>
                <option value="Testing">Testing</option>
                <option value="Accounting">Accounting</option>
                <option value="Electronic">Electronic</option>
                <option value="Multimedia">Multimedia</option>
                <option value="Networking">Networking</option>
                <option value="Programming">Programming</option>
            </select>
            </div>
            
		<?php /*if(isset($_SESSION['level']) && $_SESSION['level'] == 'admin' || $_SESSION['level'] == 'superadmin'){ ?>
            <div class="form-group">
            <label>PP</label>
            <select name="pp" class="form-control" id="pp" required>
                <option value="">Choose</option>
                <option value="Testing">Testing</option>
                <?php
					$c_qry1 = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE'";
					$c_result1 = mysqli_query($conn,$c_qry1);
					while($c_row1 = mysqli_fetch_array($c_result1)){
				?>
                <option value="<?=$c_row1['id']?>"><?=$c_row1['l_name']?></option>
                <?php }?>
            </select>
            </div>
            
                
            <div class="form-group">
            <label>Group</label>
            <select name="group" class="form-control" id="group" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>
                <?php }?>
            </select>
            </div>
		<?php }elseif(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){ ?>
            <div class="form-group">
            <label>PP</label>
            <select name="pp" class="form-control" id="pp" required>
                <option value="">Choose</option>
                <option value="Testing">Testing</option>
                <?php
					$c_qry1 = "SELECT * FROM login WHERE level = 'pp' AND l_status = 'ACTIVE' AND c_id = '".$_SESSION['course']."'";
					$c_result1 = mysqli_query($conn,$c_qry1);
					while($c_row1 = mysqli_fetch_array($c_result1)){
				?>
                <option value="<?=$c_row1['id']?>"><?=$c_row1['l_name']?></option>
                <?php }?>
            </select>
            </div>
                
            <div class="form-group">
            <label>Group</label>
            <select name="group" class="form-control" id="group" required>
                <option value="">Choose</option>
                <option value="Testing">Testing</option>
                <?php
					$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>
                <?php }?>
            </select>
            </div>
		<?php }else{?>
            <div class="form-group">
            <label>Group</label>
            <select name="group" class="form-control" required>
                <option value="">Choose</option>
                <option value="Testing">Testing</option>
                <?php
					$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE' AND c_id = '".$_SESSION['course']."'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>
                <?php }?>
            </select>
            </div>
			<input type="hidden" name="pp" value="<?=$_SESSION['id']?>" /><br/>
		<?php }*/?>
            
            <!--<div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title"><input type="checkbox" id="hostel" name="hostel" value="hostel" onclick="validate1()"> Check if registered JPK</h3>
                </header>
                <div class="panel-body">  
                    <div class="col-md-12">
						<div class="form-group">
							<label>Level</label>
							<select name="level" class="form-control" disabled>
								<option value="2">Level 2</option>
								<option value="3">Level 3</option>
								<option value="4">Level 4</option>
								<option value="Single Tier">Single Tier</option>
							</select>
						</div>
                        <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control" name="h_fee" id="h_fee" value="" disabled>
                        </div>
                        <div class="form-group">
                        <label>End Date</label>
                        <input type="text" class="form-control" name="h_fee" id="h_fee" value="" disabled>
                        </div>
                    </div>
                </div>  
            </div>-->
            
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
		document.getElementById('panel').style= "display:block";
		
	} else {
		document.getElementById('panel').style= "display:none";
		
	}
}

$(document).ready(function () {
    $("#pp").change(function () {
		$("#group").empty();
        var val = $(this).val();
		$("#group").append('<option value="">Choose</option><option value="Testing">Testing</option>');
		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){

		?>

		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>');
		}
		<?php }?>
    });
});

$(document).ready(function () {
		$("#group").empty();
		$("#group").append('<option value="">Choose</option><option value="Testing">Testing</option>');
        var val = $('select[name=pp]').val()
		<?php
			$c_qry = "SELECT * FROM student_group WHERE g_status = 'ACTIVE'";
			$c_result = mysqli_query($conn,$c_qry);
			while($c_row = mysqli_fetch_array($c_result)){
				
		?>
		
		if (val == "<?=$c_row['p_id']?>") {
			$("#group").append('<option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>');
}
		<?php }?>
});

</script>