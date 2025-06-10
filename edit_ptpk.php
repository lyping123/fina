<?php 
require('include/include.php');
require('header.php');
$system_msg='';

if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_edit'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to edit, please check your detail is correct or not.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit.');	
}
$qry="select pi.* from ptpk_information as pi where pi.id='".$_GET['id']."'";
$sttr=mysqli_query($conn,$qry);
$result_sttr=mysqli_fetch_array($sttr);

//echo "<script>alert('".$result['incomplete']."')</script>";

?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit PTPK Information
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">PTPK Information</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_ptpk.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?=$result_sttr['s_id']?>" class="form-control" />
            <!--<br>
            <label>If need change student name</label>
            <input type="checkbox" id="ck" name="ck" />click here
            <input type="text" class="form-control" readonly value="<?=$result_sttr['s_id']?>" />
            <input type="hidden" class="form-control" name="name" readonly value="<?=$result_sttr['s_name']?>" />-->
            
            </div>
			<div class="form-group">
            <label>Document Incomplete</label>
            <input type="text" class="form-control" name="d_icom" value="<?=$result_sttr['incomplete']?>" />
            </div>
            <div class="form-group">
            <label>Document complete</label>
            <input type="text" class="form-control" name="d_com" value="<?=$result_sttr['complete']?>" />
            </div>
			<div class="form-group">
            <label>Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="sd" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$result_sttr['date']?>" required >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="sd" id="sd" value="<?=$result_sttr['date']?>" />
            </div>
			
            
           
		</div>
		<div class="col-md-2"></div>
        <div class="col-md-5">
        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="">Choose</option>
                <option <?php if($result_sttr['level']=='2'){echo "selected='selected'";} ?> value="2">2</option>
                <option <?php if($result_sttr['level']=='3'){echo "selected='selected'";} ?> value="3">3</option>
                <option <?php if($result_sttr['level']=='4'){echo "selected='selected'";} ?> value="4">4</option>
                <option <?php if($result_sttr['level']=='Single Tier'){echo "selected='selected'";} ?> value="Single Tier">Single Tier</option>
            </select>
            </div>
            
            <div class="form-group">
            <label>Course</label>
            <select name="course" class="form-control" id="course" required>
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM course WHERE status = 'ACTIVE'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option <?php if($result_sttr['c_id']==$c_row['id']){echo "selected='selected'";} ?> value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
            </select>
            </div>
            <div class="form-group">
                <label>Attachment</label>
                <input type="file" name="file"  class="form-control" id="file" require  />
            </div>
			
		</div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<input type="submit" class="btn btn-primary" name="edit" value="Edit" />
                <input type="button" class="btn btn-primary" onclick="window.location.href='ptpk_list.php'" value="Back" />
            </div>
        </div>
        </form>
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
$("#ck").on("check",function(){
    
});
</script>
