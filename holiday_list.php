<?php
include_once('header.php');
require('include/include.php');

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Internship Summary Successfully Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Internship Summary Fail To Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!','Welcome <strong>'.$_SESSION['name'].'</strong>');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Holiday Successfully Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Internship Summary Successfully Update.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Success!','Holiday Fail To Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-danger','Success!','Internship Summary Fail To Update.');	
}


if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $query="DELETE FROM public_holiday WHERE id = '".$_GET['id']."'";
    if($sttr=mysqli_query($conn,$query)){
        echo "<script>
        window.location.href = 'holiday_list.php?action=msg_success_del';</script>";
    }
    else{
        echo "<script>
        window.location.href = 'holiday_list.php?action=msg_success_del';</script>";
    }
    
}
?>


        <div id="page-wrapper">

            <div class="container-fluid">
<?php if(isset($system_msg)){echo $system_msg;}?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Holiday List
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
<?php
$qry="SELECT * FROM public_holiday";
$result=mysqli_query($conn,$qry);
?>

            <div class="col-md-12">
                <div class="table-responsive">
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <!--<th>Course</th>-->
                            <th>Date</th>
                            <th>Holidays</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){
                                if(!empty($row['date1'])){
                                    $date = $row['date'].'('.$row['days'].') - '.$row['date1'].'('.$row['days1'].')';
                                }else{
                                    $date = $row['date'].'('.$row['days'].')';
                                }
                            ?>
                            <tr>
                            <td><?=$date?></td>
                            <td><?=$row['holidays']?></td>
                            <td><a class="btn btn-danger" href="holiday_list.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit<?=$row[0]?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="add_internship.php?action=edit&id=<?=$row[0]?>">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Internship Summary</h4>
      </div>
          <div class="modal-body">

  
          </div>
          <div class="modal-footer ">
			<button type="submit" name="update_internship" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> update </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

  <!-- /.row -->
  <?php require('footer.php');?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
   
    <!-- Bootstrap Core JavaScript -->

</body>

</html>
