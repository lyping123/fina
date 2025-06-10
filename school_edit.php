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
$qry = "SELECT * FROM school WHERE id = '".$_GET['sid']."'";
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
        <form class="form-horizontal" method="post" action="add_qualification.php?action=edit_school&id=<?=$_GET['id']?>&sid=<?=$_GET['sid']?>" enctype="multipart/form-data">    
        <div class="col-md-4">
            <div class="form-group">
            <label>Former School</label>
            <select name="former" class="form-control" required>
            <option value="SECONDARY" <?php if($row['former'] == 'SECONDARY'){echo "selected=\"selected\"";}?>>SECONDARY</option>
                <option value="COLLEGE" <?php if($row['former'] == 'COLLEGE'){echo "selected=\"selected\"";}?>>COLLEGE</option>
                <option value="OTHERS" <?php if($row['former'] == 'OTHERS'){echo "selected=\"selected\"";}?>>OTHERS</option>
            </select>
             </div>           
           <div class="form-group">
             
           <label>Name of school</label>
             <select name="schoolList" class="form-control" id="schoolList" required>
                <option value="">Choose</option>
                <?php
					$qry1 = "SELECT * FROM school_list WHERE status = 'ACTIVE'";
					$result1 = mysqli_query($conn,$qry1);
					while($row1 = mysqli_fetch_array($result1)){
				?>
                <option <?php if($row['name_school'] == $row1['name_school']){ echo 'selected';}?>><?=$row1['name_school']?></option>
                <?php }?>
            </select>          
            </div>
            <div class="form-group">
             
            <label>Location</label>
            <input type="text" class="form-control" name="location" value="<?=$row['location']?>" required>
            </div>
            <div class="form-group">
            <label>Qualification</label>
            <input type="text" class="form-control" name="qualification" value="<?=$row['qualification']?>" required>
            </div>
            <div class="form-group">
            <label>Year	</label>
            <input type="text" class="form-control" name="year" value="<?=$row['year']?>" required>
            </div>
            
        </div>
        
        <div class="col-md-1">
        
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit_school"><i class=""></i> Save </button>
        		<button type="button" class="btn btn-warning" onclick="window.location.href='student_list.php'"> Cancel </button>
            </div>
        </div>
        </form>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>