<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_limit'){
	$system_msg .= systemMsg('alert-warning','Warning!','1 PP cannot have more than 25 student');
}
?>
    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	$qry = "SELECT * FROM course WHERE status = 'ACTIVE'";
	$result = mysqli_query($conn,$qry);
	while($row = mysqli_fetch_array($result)){
?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Course: <?=$row['course']?>
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->
	<?php 
        $qry1 = "SELECT *, replace(ic , '-','') AS new_ic FROM student WHERE s_status = 'ACTIVE' AND course = '".$row['course']."'";
        $result1 = mysqli_query($conn,$qry1);
    ?>

        <!-- Projects Row -->
        <div class="row">
    <?php
        while($row1 = mysqli_fetch_array($result1)){
	?>
        	<div class="col-lg-2">
            	<div class="thumbnail" style="height: 100px;">
                <p><?=$row1['s_name']?></p>
            	<img src="barcode.php?codetype=Code128&size=45&text=<?=$row1['new_ic']?>"  />  
            	<!--<img src="barcode.php?codetype=Code128&size=40&text=123213123&print=true"  /> --> 
                </div>
            </div>
	<?php }?>  
        </div>
<?php }?>  
        <div class="row">
        

        <!-- /.row -->
<?php require('footer.php');?>