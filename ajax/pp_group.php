<?php
require('../include/db.php');
$q=$_REQUEST["q"]; 
/*$qry = "SELECT * FROM student_group WHERE p_id='".$q."' AND g_status='ACTIVE'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);
$c_row = mysqli_num_rows($result);
if($c_row >= 1){
?>
                <div class="form-group">
                    <label>NRIC</label>
                    <input type="text" class="form-control" name="ic" value="<?=$row['ic']?>" required>
                </div>
<?php }*/?>  

			<div class="form-group">
            <label>Group</label>
            <select name="group" class="form-control" >
                <option value="">Choose</option>
                <?php
					$c_qry = "SELECT * FROM student_group WHERE p_id='".$q."' AND g_status='ACTIVE'";
					$c_result = mysqli_query($conn,$c_qry);
					while($c_row = mysqli_fetch_array($c_result)){
				?>
                <option value="<?=$c_row['id']?>"><?=$c_row['g_name']?></option>
                <?php }?>
            </select>
            </div>