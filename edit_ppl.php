<?php 
require('include/include.php');
require('header.php');
$system_msg='';
$course = '';
$course1 = '';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add Lawatan PPL.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Lawatan PPL .');	
}

if(isset($_SESSION['dp']) && $_SESSION['dp'] == 'Department Head'){
	$course .= " AND c_id = '".$_SESSION['course']."'";
	$course1 .= " AND id = '".$_SESSION['course']."'";
}else{
	$course = '';
	$course1 = '';
}
$qry="select * from lawatan_ppl where id='".$_GET['id']."'";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Lawatan PPL
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PPL Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_ppl.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>PPL name:</label>
            <input type="text" class="form-control" name="pname" value="<?php echo $result['name']; ?>" required>
            </div>
			
			<div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="cnum" class="form-control"  value="<?php echo $result['c_num']; ?>" />
            </div>
			
			<div class="form-group">
            <label>IC:</label>
            <input type="text" name="ic" class="form-control" id="" value="<?php echo $result['ic']; ?>" />
            </div>
            <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" id="" value="<?php echo $result['email']; ?>" />
            </div>
            <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" type="text" rows="3"><?php echo $result['address']; ?></textarea>
            </div>
            
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'".$course1;
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>" <?php if($result['c_id']==$c_row['id']){echo "selected='selected'";} ?> ><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
			
            <div class="form-group">
            <label>Start Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?php echo $result['s_date']; ?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd"value="<?php echo $result['s_date']; ?>"  />
            </div>
			
            <div class="form-group">
            <label>End date</label><br>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="ed" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?php echo $result['e_date']; ?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="ed" id="ed" value="<?php echo $result['e_date']; ?>" />
            </div>
            <div class="form-group">
                <label>Verification date</label>
                <input type="text" name="daterange" value="" class="form-control" required/>
            </div>
            <div class="form-group">
                <label>Comment:</label>
                <textarea class="form-control" name="comment" type="text" rows="5"><?php echo $result['comment']; ?></textarea>
            </div>
            <div class="form-group">
                <label>PPL Information:</label>
                <textarea class="form-control" name="ppl_info" type="text" rows="5"><?=$result['ppl_infor']?></textarea>
            </div>
     
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="edit" value="edit"><i class=""></i> edit </button>
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
$(document).ready(function () {
    $("#course").change(function () {
		$("#jpkpp").empty();
		$("#pp").empty();
		$("#jpkpp").append('<option value="">Choose</option>');
		$("#pp").append('<option value="">Choose</option>');
        var val = $(this).val();
        $.post("pp.php", { value: val },  
            function(result){  
        		$("#jpkpp").append(result);
        		$("#pp").append(result);
				$('.selectpicker').selectpicker('refresh');
            }); 
    });
        $(function() {
			$('input[name="daterange"]').daterangepicker({
				opens: 'left'
			}, function(start, end, label) {
				console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
			});
});
</script>