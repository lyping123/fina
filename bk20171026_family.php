<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}
?>
<?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	
$qry = "SELECT * FROM family WHERE s_id='". $_GET['id'] ."' AND status='ACTIVE' ";
$result = mysqli_query($conn, $qry);
  

	
//$result = mysqli_query($conn,$qry.$limit);
?>
    <!-- Page Content -->
    <div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">FAMILY
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Projects Row -->
        <div class="row">
        
<div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Family</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="add_family.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">    
        <div class="col-md-12 ">
            <div class="form-group ">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="" required>
            </div>
            <div class="form-group">
            <label>Age</label>
            <input type="text" class="form-control" name="age" value="" required>
            </div>
            <div class="form-group">
            <label>Occupation</label>
            <input type="text" class="form-control" name="Occupation" value="" required>
            </div>
            <div class="form-group">
            <label>Qualification</label>
            <input type="text" class="form-control" name="qualification" value="" required>
            </div>
            <div class="form-group">
            <label>Mobile No</label>
            <input type="text" class="form-control" name="mobile_no" value="" required>
            </div>
            <div class="form-group">
            <label>Relationship</label>
            <select name="relationship" class="form-control" required>
                <option value="-">-</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Brother">Brother</option>
                <option value="Sister">Sister</option>
                <option value="Other">Other Relationship</option>
            </select>
            </div>
            <div class="form-group">
            <label>Salary</label>
            <input type="text" class="form-control" id="salary" name="salary" value="" required>
            </div>
          
               
        </div>
        <div class="col-md-12 col-md-offset-4">
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="submit" value="save" style="width:320px;"><i class=""></i> Add </button>
            </div>
        </div>	
        
        <div class="col-md-12">
            <div class="row">
            <div class="col-lg-12">
                <div style="overflow-x:auto;"> 
                <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Relationship</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Occupation</th>
                        <th>Qualification</th>
                        <th>Mobile No</th>
                        <th>Salary</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_array($result)){?>
                        <tr>
                            <td><?=$row['relationship']?></td>
                            <td><?=$row['Name']?></td>
                            <td><?=$row['Age']?></td>
                            <td><?=$row['Occupation']?></td>
                            <td><?=$row['Qualification']?></td>
                            <td><?=$row['Mobile_No']?></td>
                            <td><?=$row['salary']?></td>
                            <td><button class="btn btn-primary btn-xs" type="button" onclick="window.location.href='family_edit.php?id=<?=$row['f_id']?>&s_id=<?=$row['s_id']?>'">Edit</button></td>
                            <td><button class="btn btn-danger btn-xs" type="button" onclick="window.location.href='add_family.php?action=delete&id=<?=$row['f_id']?>&s_id=<?=$row['s_id']?>'">Delete</button></td>
                        </tr>
                    <?php }?>
                    </tbody>
                
                </table>
                </div>
            </div>
        </div>
        </div>
        
        
        </form>
    </div>  
</div>
        </div>
        <!-- /.row -->
<?php require('footer.php');?>
<script>
$("#salary").keypress(function (e){
  var charCode = (e.which) ? e.which : e.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
    return false;
  }
});

$("#salary").change(function (e){
	var salary =  $('#salary').val();
	if(salary > 2000){
		var r = prompt("Salary high than RM2000! Please call admin key in password to continue.", "");
		if (r == 'master123') {
		}else if(r === null){	
			$('#salary').val('')
			alert('Password is empty!');
		}else{
			$('#salary').val('')
			alert('Password is wrong!');
		}
	}	
});
</script>