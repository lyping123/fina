<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_success_clear'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully clear all receipt.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_receipt_fail_clear'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to clear all receipt.');	
}
$no=0;
$s_name = '';

?>
    <!-- Page Content -->
    <div class="container">
<?php 
    if(isset($system_msg)){echo $system_msg;}
    

	$qry_rcp = "SELECT pi.*,c.course,p.issue FROM ptpk_information as pi inner join course as c on c.id=pi.c_id inner join ptpk_issue as p on p.id=pi.incomplete WHERE pi.status  = 'ACTIVE'  ORDER BY pi.id ";
	$sql_page = mysqli_query($conn,$qry_rcp);
	
?>

		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>PTPK List</p>
                </h1>
            </div>
        </div>

        <div class="row">
            
            
            <!--<div style="overflow-x:auto;"> -->
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
            	<thead>
                	<th>No</th>
                	<th>Name</th>
                	<th>Date</th>
                	<th>Problem</th>
                    <th>Document Complete</th>
                    <th>Attachment</th>
                    <th>Level</th>
                	<th>Course</th>
                	<th>Action</th>
                </thead>
                <tbody>
                <?php while($row_rcp = mysqli_fetch_array($sql_page)){
						
				?>
                	<tr>
                    	<td><?php echo $no+=1; ?></td>
                    	<td><?=$row_rcp['s_id']?></td>
                        <td><?=$row_rcp['date']?></td>
                    	<td><?=$row_rcp['issue']?></td>
                    	<td><?=$row_rcp['complete']?></td>
                        <td><a href="document.php?id=<?=$row_rcp[0]?>" target="_blank" >View/upload attachment</a></td>
                        <td><?=$row_rcp['level']?></td>
                        <td><?=$row_rcp['course']?></td>
                    	
                    	<!--<td>
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Print <span class="caret"></span></button>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="print_receipt.php?&id=<?=$row_rcp['id']?>" target="_blank"><i class="icon-print"></i> Print (Synergy Central Academy)</a></li>
                            <li><a href="print_receipt1.php?&id=<?=$row_rcp['id']?>" target="_blank"><i class="icon-print"></i> Print (Pusat Kemahiran Telekomunikasi Mikro)</a></li>
                          </ul>
                        </div>
                        d
                        </td>-->
                        <td><div class="dropdown">
                  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"> Action <span class="caret"></span></button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="edit_ptpk.php?id=<?=$row_rcp['id']?>">Edit</a></li>
                    <li><a href="add_ptpk.php?action=delete&id=<?=$row_rcp['id']?>">Delete</a></li>
                  </ul>
                </div></td>
                    </tr>
                <?php  }?>
                </tbody>
            
            </table>
            <!--</div>-->
            
        </div>

<?php require('footer.php');?>