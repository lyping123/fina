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
<?php if(isset($system_msg)){echo $system_msg;} ?>
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel panel-info">
                <header class="panel-heading">
                    <h3 class="panel-title">MY Synergy Staff Check In </h3>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="add_tem.php" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Staff Ic</label><br>
								<!-- <select class="selectpicker" onchange="searchphone(this.value);" name="name" id="name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
                                
								$s_qty = "SELECT id,u_name FROM user WHERE u_status ='ACTIVE'";	
								$s_result = mysqli_query($con, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['u_name']?></option>
								<?php
								}
								?>
								</select> -->
                                <input type="text" onchange="searchphone(this.value);" name="s_ic" class="form-control" value="" />
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
                                <button type="submit" name="addstaff" value="add" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
        </div>
        
        
    </div>
   
</div>

<script>
     function searchphone(str){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("p_num").value = this.responseText;
            }
        };
        xhttp.open("GET", "searchphone.php?p="+str, true);
        xhttp.send();
    }

</script>


<?php require("footer.php"); ?>