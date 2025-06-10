<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new school.');
}
?>
<?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT name_school FROM school_list WHERE status = 'ACTIVE' AND id = '".$_GET['id']."' ";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);


		
//$result = mysqli_query($conn,$qry.$limit);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Schools List
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Edit Schools</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_school.php?action=edit_school&id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">
          
            <div class="form-group ">
            <label>Name of School</label>
            <input type="text" class="form-control" name="school" value="<?=$row['name_school']?>" required>
            </div>
           
           
        <div class="col-md-12 col-md-offset-4">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="edit_school" style="width:320px;"><i class=""></i> EDIT </button>
            </div>
        </div>	
        
        
            
        	
        
       </form>
    </div>  
</div>
</div>


        </div>
     </div>
        <!-- /.row -->
<?php require('footer.php');?>