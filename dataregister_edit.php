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
<?php
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM date_register WHERE id = '".$_GET['sid']."'";
$result = mysqli_query($conn,$qry);
$row = mysqli_fetch_array($result);
?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Date Register
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Date Register</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_dateregister.php?action=edit_school&id=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>" enctype="multipart/form-data">    
        <div class="col-md-5">
           <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="2" <?php if($row['level'] == '2'){ echo 'selected';}?>>Level 2</option>
                <option value="3" <?php if($row['level'] == '3'){ echo 'selected';}?>>Level 3</option>
                <option value="4" <?php if($row['level'] == '4'){ echo 'selected';}?>>Level 4</option>
                <option value="Single Tier" <?php if($row['level'] == 'Single Tier'){ echo 'selected';}?>>Single Tier</option>
            </select>
            </div>
            <div class="form-group ">
            <label>Register Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['register_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="r_date" id="dtp_input1" value="" /><br/>
            </div>
            
            <div class="form-group">
            <label>Exam Date</label>
            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
            <input class="form-control" size="16" type="text" value="<?=$row['exam_date']?>" >
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            <input type="hidden" name="exam_date" id="dtp_input2" value="" /><br/>
            </div>
            
        </div>
        
        <div class="col-md-1"></div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit_date"><i class=""></i> Save </button>
        		<button type="button" class="btn btn-warning" onclick="window.location.href='student_list.php'"> Cancel </button>
            </div>
        </div>
        </form>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>