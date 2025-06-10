<?php 
require ('include/db.php');
$course;
$desc;

$desc=$_POST['asd'];



?>


<div class="form-group remove" style="margin-top:10px;">
	
<a class="remove_project btn btn-danger" >Remove</a>
<div class="col-md-4">
    
        <?php 
            if($desc=="Tuition Fee"){
               echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            elseif($desc=="Hostel Fee"){
                echo "<select id='desc' class='form-control' name='desc[]' required>";
                echo "<option value='HOSTEL FEE'>HOSTEL FEE</option>";
                echo "<option value='HOSTEL UPGRADE'>HOSTEL UPGRADE</option>";
                echo "</select>";
            }
            elseif($desc=="Hostel Deposit"){
                echo "<select id='desc' class='form-control' name='desc[]' required>";
                echo "<option value='HOSTEL DEPOSIT'>HOSTEL DEPOSIT</option>";
                echo "</select>";
            }
            elseif($desc=="Debtor PTPK"){
                echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            elseif($desc=="Internal Exam Fee"){
                echo "<select id='desc' class='form-control' name='desc[]' required>";
                echo "<option value='INTERNAL EXAMINATION FEE'>INTERNAL EXAM FEE</option>";
                echo "</select>";
            }
            elseif($desc=="Tuition PTPK"){
                echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            elseif($desc=="Debtor"){
                echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            elseif($desc=="Locker"){
                echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            elseif($desc=="Personal Bond"){
                echo "<input type='text' placeholder='Desc' class='form-control' value='' name='desc[]' required/>";
            }
            
        ?>
    
	
</div>
<div class="col-md-2">
	<input type="text" class="form-control" placeholder="Price" name="price[]" required/>
    
</div>
<div class="col-md-2">
<select name="level[]" id="level" class="form-control">
        <option value="LEVEL 2">LEVEL 2</option>
        <option value="LEVEL 3">LEVEL 3</option>
        <option value="LEVEL 4">LEVEL 4</option>
        <option value="Singer Tier">Singer Tier</option>
    </select>
</div>
</div>

