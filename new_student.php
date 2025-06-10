<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add1'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to update visitor details after add new student.');
}

$qry = "SELECT * FROM visitor WHERE v_status = 'ACTIVE' AND id = '".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$rows = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(!empty($row['v_register_date'])){
		echo "<div class='row'>
				<div class='alert alert-warning'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Warning!</strong> This student already registered in system.
				</div></div>";
	}elseif($row['v_status'] == 'UNACTIVE'){
		echo "<div class='row'>
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Warning!</strong> This student are unactive status.
				</div></div>";
	}elseif($rows != 1){
		echo "<div class='row'>
				<div class='alert alert-danger'>
					<button type='button' class='close' data-dismiss='alert'>&times;</button>
					<strong>Warning!</strong> Student not found in visitor list.
				</div></div>";
	}else{
		
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
        <form class="form-horizontal" method="post" action="add_student.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?=$row['s_name']?>" readonly>
            *Please change the student name in Visitor list, or change in student list after register the new student.
            </div>
            <div class="form-group">
            <label>NRIC</label>
            <input type="text" class="form-control" name="ic" value="<?=$row['s_ic']?>" pattern="^\d{12}$" required>e.g 991010071010
            </div>
            <div class="form-group">
            <label>Nationality</label>
            <input type="text" class="form-control" name="nationality" value="<?=$row['nationality']?>" >
            </div>
            <div class="form-group">
            <label>Race</label>
            <select name="race" class="form-control" >
                <option <?php if($row['race'] == 'Chinese'){echo "selected=\"selected\"";}?>   value="Chinese">Chinese</option>
                <option <?php if($row['race'] == 'Indian'){echo "selected=\"selected\"";}?>  value="Indian">Indian</option>
                <option <?php if($row['race'] == 'Malay'){echo "selected=\"selected\"";}?>  value="Malay">Malay</option>
            </select>
            </div>
            <div class="form-group">
            <label>Residential Address</label>
            <input type="text" class="form-control" name="r_address" value="<?=$row["v_location"]?>" >
            </div>
            <div class="form-group">
            <label>Residential Postcode</label>
            <input type="text" class="form-control" name="r_postcode" value="<?=$row["postcode"]?>" >
            </div>
            <div class="form-group">
            <label>Residential State</label>
            <select name="r_state" class="form-control" >
                <option value="-">-</option>
                <option value="Johor" <?php if($row['state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
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
                <option value="Johor" <?php if($row['state'] == 'Johor'){echo "selected=\"selected\"";}?>>Johor</option>
                <option value="Kedah" <?php if($row['state'] == 'Kedah'){echo "selected=\"selected\"";}?>>Kedah</option>
                <option value="Kelantan" <?php if($row['state'] == 'Kelantan'){echo "selected=\"selected\"";}?>>Kelantan</option>
                <option value="Melaka" <?php if($row['state'] == 'Melaka'){echo "selected=\"selected\"";}?>>Melaka</option>
                <option value="Negeri Sembilan" <?php if($row['state'] == 'Negeri Sembilan'){echo "selected=\"selected\"";}?>>Negeri Sembilan</option>
                <option value="Pahang" <?php if($row['state'] == 'Pahang'){echo "selected=\"selected\"";}?>>Pahang</option>
                <option value="Penang" <?php if($row['state'] == 'Penang'){echo "selected=\"selected\"";}?>>Penang</option>
                <option value="Perak" <?php if($row['state'] == 'Perak'){echo "selected=\"selected\"";}?>>Perak</option>
                <option value="Perlis" <?php if($row['state'] == 'Perlis'){echo "selected=\"selected\"";}?>>Perlis</option>
                <option value="Sabah" <?php if($row['state'] == 'Sabah'){echo "selected=\"selected\"";}?>>Sabah</option>
                <option value="Sarawak" <?php if($row['state'] == 'Sarawak'){echo "selected=\"selected\"";}?>>Sarawak</option>
                <option value="Selanggor" <?php if($row['state'] == 'Selanggor'){echo "selected=\"selected\"";}?>>Selanggor</option>
                <option value="Terengganu" <?php if($row['state'] == 'Terengganu'){echo "selected=\"selected\"";}?>>Terengganu</option>
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
                    <option value="l_payment">Last Payment</option>
                    
                </select>
                </div>
                <div class="col-md-8">
                <label>Payment Permonth RM</label>
                <input type="text" class="form-control" name="cost" value="" >
                </div>
                <!--<div class="col-md-1">
                <br />X
                </div>
                <div class="col-md-4">
                <label>Month</label>
                <input type="text" class="form-control" name="month" value="" >
                </div>-->
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
            <input type="text" class="form-control" name="c_name" value="<?=$row["c_name"]?>" >
            </div>
          <div class="col-md-12" style="padding-left:0px;">
           <div class="col-md-8" style="padding-left:0px; height:30px;">
            <div class="form-group">
            <label>Date Of Birth</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row["b_date"]?>" >
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
                <option <?php if($row["gender"]=="Male"){echo "selected=\"selected\"";}?> value="Male">Male</option>
                <option <?php if($row["gender"]=="Female"){echo "selected=\"selected\"";}?> value="Female">Female</option>
            </select>
            </div>
           </div>
           <div class="col-md-3 col-md-offset-1" >
            <div class="form-group">
            <label>Marital Status</label>
            <select name="m_status" class="form-control" >
                <option <?php if($row["gender"]=="Single"){echo "selected=\"selected\"";}?> value="Single">Single</option>
                <option <?php if($row["gender"]=="Married"){echo "selected=\"selected\"";}?>   value="Married">Married</option>
            </select>
            </div>
           </div>
          </div>
             <div class="form-group">
            <label>Religion</label>
            <select name="religion" class="form-control" >
                <option <?php if($row["religion"]=="Buddhism"){echo "selected=\"selected\"";}?> value="Buddhism">Buddhism</option>
                <option <?php if($row["religion"]=="Christianity"){echo "selected=\"selected\"";}?> value="Christianity">Christianity</option>
                <option <?php if($row["religion"]=="Daoism"){echo "selected=\"selected\"";}?> value="Daoism">Daoism</option>
                <option <?php if($row["religion"]=="Hinduism"){echo "selected=\"selected\"";}?> value="Hinduism">Hinduism</option>
                <option <?php if($row["religion"]=="Islam"){echo "selected=\"selected\"";}?> value="Islam">Islam</option>
            </select>
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?=$row["email"]?>" >
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
            <input type="text" class="form-control" name="hp_contact" value="<?=$row['s_contact']?>" pattern="^\d{3}-\d{7,8}$" readonly>e.g 012-3456789<br>*Please change the student contact in Visitor list, or change in student list after register the new student.
            </div>
            <div class="form-group">
            <label>Contact(Guardian)</label>
            <input type="text" class="form-control" name="guardian" value="<?=$row['p_contact']?>" pattern="^\d{3}-\d{7,8}$">e.g 012-3456789
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
<?php }?>
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