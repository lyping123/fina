<?php 
require('include/include.php');
require("header.php");

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Submit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete Group.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete Group.');
}


            $qry="select * from visitor_tem as st order by st.s_date desc";
            $sttr=mysqli_query($conn,$qry);
      
?>


<div class="container">
<?php if(isset($system_msg)){echo $system_msg;} ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Visitor check in list
            <!--<small>Secondary Text</small>-->
            <!-- <a class="btn btn-primary pull-right" href="print_alert.php?action=course" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a> -->
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Visitor Name</th>
                        <th>Phone Number</th>
                        <th>Temperature</th>
                        <th>Time check in</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php while($result=mysqli_fetch_array($sttr)){ ?>
                            <tr>
                                <td><?=$result["s_id"]?></td>
                                <td><?=$result["phone_number"]?></td>
                                <td><?=$result["tem"]?></td>
                                <td><?=$result["s_date"]?></td>
                                <td><a class="btn btn-danger" href='add_tem.php?action=delete&&id=<?=$result[0]?>&&table=visitor_tem'>DELETE</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>

<?php include("footer.php"); ?>