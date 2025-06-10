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

?>

<div class="container">
<?php if(isset($system_msg)){echo $system_msg;} ?>
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title">MY Synergy Visitor Check In </h3>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="add_tem.php" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Visitor name</label><br>
                                <input type="text"  name="s_name" class="form-control" value="" />
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="p_num" id="p_num"  />
                            </div>
                            <div class="form-group">
                                <label>Temperature</label>
                                <input type="text" class="form-control" name="tem" id="tem"  />
                            </div>

                        </div>
                        <div class="panel-footer">
                            <div class="col-md-12">
                                <button type="submit" name="addvisitor" value="add" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
       
    </div>
   
</div>
   
</div>



<?php require("footer.php"); ?>