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
$qry = "SELECT * FROM family WHERE f_id = '".$_GET['id']."'";
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
        <form class="form-horizontal" method="post" action="add_family.php?action=edit&id=<?=$row['f_id']?>&s_id=<?=$_GET['s_id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">
            <div class="form-group ">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?=$row['Name']?>" required>
            </div>
            <div class="form-group">
            <label>Age</label>
            <input type="text" class="form-control" name="age" value="<?=$row['Age']?>" required>
            </div>
            <div class="form-group">
            <label>Occupation</label>
            <input type="text" class="form-control" name="Occupation" value="<?=$row['Occupation']?>" required>
            </div>
            <div class="form-group">
            <label>Qualification</label>
            <input type="text" class="form-control" name="qualification" value="<?=$row['Qualification']?>" required>
            </div>
            <div class="form-group">
            <label>Mobile No</label>
            <input type="text" class="form-control" name="mobile_no" value="<?=$row['Mobile_No']?>" required>
            </div>
            <div class="form-group">
            <label>Relationship</label>
            <select name="relationship" class="form-control" required>
                <option value="-">-</option>
                <option <?php if($row['relationship'] == 'Father'){echo "selected=\"selected\"";}?>>Father</option>
                <option <?php if($row['relationship'] == 'Mother'){echo "selected=\"selected\"";}?>>Mother</option>
                <option <?php if($row['relationship'] == 'Brother'){echo "selected=\"selected\"";}?>>Brother</option>
                <option <?php if($row['relationship'] == 'Sister'){echo "selected=\"selected\"";}?>>Sister</option>
                <option <?php if($row['relationship'] == 'Other Relationship'){echo "selected=\"selected\"";}?>>Other Relationship</option>
            </select>
            </div>
          
               
        </div>
        
        <div class="col-md-12">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit"><i class=""></i> Save </button>
        		<button type="button" class="btn btn-warning" onclick="window.location.href='family.php?&id=<?=$row['f_id']?>'"> Cancel </button>
            </div>
        </div>
        </form>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>