<style>
.dataTables_filter {
  float: left;
}
</style>
<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Visitor Log.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_unactive'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully unactive Visitor Log.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_unactive'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to unactive Visitor Log.');
}

$status = " v_status = 'ACTIVE' OR v_status = 'UNACTIVE'";
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['status']) && $_GET['status'] == '1'){
		$status = " v_register_date != '' AND v_status = 'ACTIVE'";
	}elseif(isset($_GET['status']) && $_GET['status'] == '2'){
		$status = " v_status = 'ACTIVE' OR v_status = 'UNACTIVE' AND v_register_date = ''";
	}elseif(isset($_GET['status']) && $_GET['status'] == '3'){
		$status = " v_status = 'UNACTIVE'";
	}else{
		$status = '';
	}
}
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	


$qry = "SELECT * FROM visitor WHERE".$status." ORDER BY id DESC";
$result = mysqli_query($conn,$qry);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Visitor Log List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <div class="col-md-12">	
        <div class="form-group">
            <form action="visitor_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search By Status</label>
                        <div class="form-group">
                            <select class="form-control" name="status">
                            	<option value="">Choose</option>
                            	<option value="1">Registered</option>
                            	<option value="2">Not yet registered</option>
                            	<option value="3">Unactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br />
            
            <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
              <div class="row">
                    <div class="col-lg-6">
                    <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>
                    </div>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
               <th>Visit Date</th>
               <th>Name</th>
               <th>Middle School</th>
               <th>Student Contact</th>
               <th>Parent Contact</th>
               <th>Age</th>
               <th>Address / Location</th>
               <th>Status</th>
               <th>Registered Date</th>
               <th>Edit</th>
               <th>Delete</th>
               <th>Unactive</th>
               <th>Register</th>
            </tr>
        </thead>
        <tbody>
<?php 
	while($row = mysqli_fetch_array($result)){
	
		$date = $row['v_date'];
		$alert_date = date('Y-m-d',strtotime($date . "+5 days"));
		if($alert_date < date('Y-m-d') && empty($row['v_register_date'])){
			if(empty($row['v_desc'])){
				$alert = "background-color: red;";
			}else{
				$alert = "background-color: yellow;";
			}
		}
?>
            <tr style="<?=$alert?>">
                <td style="width: 85px;"><?=$row['v_date']?></td>
                <td><?=$row['s_name']?></td>
                <td><?=$row['school_name']?></td>
                <td><?=$row['s_contact']?></td>
                <td><?=$row['p_contact']?></td>
                <td><?=$row['s_age']?></td>
                <td><?=$row['v_location']?></td>
                <td><?=$row['v_desc']?></td>
                <td><?=$row['v_register_date']?></td>
                <td><button class="btn btn-primary" onclick="location.href = 'visitor_edit.php?id=<?=$row['id']?>';">Edit</button></td>
                <form method="post" action="visitor.php?action=delete&id=<?=$row['id']?>">
                <td><button class="btn btn-danger" onclick="return confirm('Confirm to Delete this Record?')">Delete</button></td>
				</form>
                <form method="post" action="visitor.php?action=unactive&id=<?=$row['id']?>">
                <td><button class="btn btn-default" onclick="location.href = 'new_student.php?id=<?=$row['id']?>';">Unactive</button></td>
				</form>
                <td><button class="btn btn-success" onclick="location.href = 'new_student.php?id=<?=$row['id']?>';">Register</button></td>
            </tr>

<?php }?>
        </tbody>
    </table>
                <!--</div>-->
            </div>
</div>
  <!-- /.row -->
  <?php require('footer.php');?>
