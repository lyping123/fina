<?php 
require('include/include.php');
require("header.php");

$con=new mysqli("aster.arvixe.com","emirco1","emirco1","staff_leave");
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

?>
<div class="container">
<div class="row">
<?php if(isset($system_msg)){echo $system_msg;} ?>
    <div class="col-lg-12">
        <h1 class="page-header">lecturer check in list
            <!--<small>Secondary Text</small>-->
            <!-- <a class="btn btn-primary pull-right" href="print_alert.php?action=course" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a> -->
        </h1>
    </div>
</div>

<?php 
            $qry="select * from staff_tem as st
            inner join user as s on s.id=st.s_id
            where s.u_status='ACTIVE' order by st.s_date desc";
            $sttr=mysqli_query($con,$qry);
        ?>
    <div class="row">
    <div class="col-md-12">
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    <th>lecturer Name</th>
                    <th>Phone Number</th>
                    <th>Temperature</th>
                    <th>Time check in</th>
                </thead>
                <tbody>
                    <?php while($result=mysqli_fetch_array($sttr)){ ?>
                        <tr>
                            <td><?=$result["u_name"]?></td>
                            <td><?=$result["phone_number"]?></td>
                            <td><?=$result["tem"]?></td>
                            <td><?=$result["s_date"]?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>