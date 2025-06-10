<?php

include_once('header.php');
require('include/include.php');
require_once('addon/pagination/page.php');			# page class
require_once('addon/pagination/pagination.php');	# page class

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Internship Summary Successfully Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Internship Summary Fail To Add.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Success!','Welcome <strong>'.$_SESSION['name'].'</strong>');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Internship Summary Successfully Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Internship Summary Successfully Update.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Success!','Internship Summary Fail To Delete.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-danger','Success!','Internship Summary Fail To Update.');	
}


$name = '';
$date='';

if(isset($_GET['search']) && $_GET['search'] == 'search'){
	if(isset($_GET['searchtype'])&& !empty($_GET['searchtype'])){
		$type=$_GET['searchtype'];
		$searchname=$_GET['name'];
		
		if($type==1){
			$name.= " AND i.s_name LIKE '%".$searchname."%'";
			//$name.= " HAVING new_name LIKE '%".$searchname."%'";
		}
		elseif($type==2){
			$name.="AND i.s_ic='".$searchname."'";
		}
		elseif($type==3){
			$name.= " AND i.s_contact= '".$searchname."'";
		}
		elseif($type==4){
			
			$name.= " AND i.batch = '".$searchname."'";
		}
		elseif($type==5){
			//$name .= " AND jt.secondary_school LIKE '%".$searchname."%'";
			$name.= " AND i.company_name like'%".$searchname."%'";
		}
		
		else{
			$name="";
		}
		
	}
	if((isset($_GET['datefrom']) && !empty($_GET['datefrom']))){
		$datefrom=$_GET['datefrom'];
		$dateto=$_GET['dateto'];
		$date.=" and start_internship>='$datefrom' and end_internship<='$dateto'";
		 
	}
	else{
		$date="";
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
                            Internship Summary List
                        <button class="btn btn-success pull-right" data-title="Add" data-toggle="modal" data-target="#add" type="button"><span class="glyphicon glyphicon-plus"></span> Add </button>
                        </h1>
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog" style="width:1000px">
    <div class="modal-content">
          <form method="post" action="add_internship.php">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Add Internship Summary</h4>
      </div>
          <div class="modal-body">

  <div class="row">
        <div class="col-md-6">
        
            <div class="form-group">
            	 <label>Student Name</label>
            	<!-- <input id="" class="form-control" name="s_name" type="text" placeholder="" required> -->
                <select class="selectpicker form-control" name="s_name" id="s_name" data-live-search="true" required>
								<option value="">Choose</option>
								<?php
								$s_qty = "SELECT id,s_name FROM student WHERE s_status <> 'DELETE'";	
								$s_result = mysqli_query($conn, $s_qty);
								while($s_row = mysqli_fetch_array($s_result)){
								?>
								<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
								<?php
								}
								?>
								</select>
            </div> 
        
            <div class="form-group">
            	<label>Student Contact</label>
            	<input id="s_contact" class="form-control" name="s_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Student IC</label>
            	<input id="s_ic" class="form-control nric" name="s_ic"  type="text" placeholder="e.g. 923052074239" required>
            </div> 
            
            <div class="form-group">
            	<label>Start Internship Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtpp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="si_date" id="dtpp_input" value="" />
            </div>
            
            <div class="form-group">
            	<label>End Internship Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtppp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" placeholder="" required="required">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="ei_date" id="dtppp_input" value="" />
            </div>
        </div>
        
        <div class="col-md-6">
        
            <div class="form-group">
            	<label>Elaun</label>
            	<input id="" class="form-control" name="elaun" type="text" placeholder="" required>
            </div>  
        
            <div class="form-group">
            	<label>Company Name</label>
            	<input id="" class="form-control" name="c_name" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Address</label>
            	<input id="" class="form-control" name="c_address" type="text" placeholder="" required>
            </div> 
        
            <div class="form-group">
            	<label>Company Contact</label>
            	<input id="" class="form-control" name="c_contact" type="text" placeholder="e.g. 0123456789" required>
            </div> 
        
            <div class="form-group">
            	<label>Batch</label>
            	<input id="" class="form-control" name="batch" type="text" placeholder="e.g. 1" required>
            </div> 
            
            <div class="form-group">
            	<label>Course</label>
                <select name="course" id="course" class="form-control" required>
                    <option value="">~ Select Course ~</option>
                    <?php 
                        $c_qry = "SELECT * FROM course";
                        $c_result = mysqli_query($conn, $c_qry);
                        while($c_row = mysqli_fetch_array($c_result)){
                    ?>
                    <option value="<?=$c_row['id']?>"><?=$c_row['course']?></option>
                <?php }?>
                </select>    
            </div>
              
        </div>
  </div>
          </div>
          <div class="modal-footer">
			<button type="submit" name="add_internship" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Add </button>
      </div>
      		</form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
                        
                    </div>
                </div>
                <!-- /.row -->
                
<!--<form action="" method="get">
  <div class="row">
    
    <div class="col-lg-3">
        <label>Search</label>
       	<input class="form-control typeahead" style="width:275px;" name="name" id="my-input4" type="text" >
        
    </div>
    <div class="col-lg-3">
        <label>Search type</label>
       	<select name="searchtype"  class="form-control">
        	<option value="0">~Please choose the Search type~</option>
            <?php 
				$c_qry = "SELECT * FROM course";
                $c_result = mysqli_query($con, $c_qry);
               	$c_rows=mysqli_num_rows($c_result);
				$c_row=mysqli_fetch_array($c_result);
				$isSelected_bat="";
				$isSelected_cm="";
				$isSelected_con="";
				$isSelected_ic="";
				$isSelected_name="";
				$isSelected_sc="";
				if($_GET['searchtype']==1){
					$isSelected_name="selected='selected'";
				}
				elseif($_GET['searchtype']==2){
					$isSelected_ic="selected='selected'";
				}
				elseif($_GET['searchtype']==3){
					$isSelected_con="selected='selected'";
				}
				elseif($_GET['searchtype']==4){
					$isSelected_bat="selected='selected'";
				}
				elseif($_GET['searchtype']==5){
					$isSelected_cm="selected='selected'";
				}
				
				else{
					$isSelected_bat="";
					$isSelected_cm="";
					$isSelected_con="";
					$isSelected_ic="";
					$isSelected_name="";
					$isSelected_sc="";
				}
			
			?>
            	<option value="1" <?php echo $isSelected_name; ?> >Name</option>
                <option value="2" <?php echo $isSelected_ic; ?> >Ic</option>
                <option value="3" <?php echo $isSelected_con; ?>>Contact Number</option>
                <option value="4" <?php echo $isSelected_bat; ?>>Batch</option>
                <option value="5" <?php echo $isSelected_cm; ?>>Company Name</option>
                
        </select>
    </div>
    <div class="col-lg-3">
    	<label>Start date</label>
        <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="datefrom" value="" placeholder="">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
    </div>
    <div class="col-lg-3">
    <label>End date</label>
    <div class="input-group date form_date" data-date="" data-date-format="yyyy/mm/dd" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="dateto" value="" placeholder="" >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>	
    </div>
  </div>
    <br />

<div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
  <div class="row">
    	<div class="col-lg-6">
        <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>
        </div>
  </div>
</div>
</form>-->

                <div class="row">
<?php
/*$qry="SELECT *,replace(i.s_name, ' ', '') AS new_name FROM internship AS i
	  INNER JOIN course AS c ON c.id = i.c_id
	  WHERE i.i_status = 'ACTIVE'".$ic.$name.$contact.$batch.$si_month."
	  ORDER BY i.id DESC";*/
$qry="SELECT *,replace(i.s_name, ' ', '') AS new_name FROM internship AS i
	  INNER JOIN course AS c ON c.id = i.c_id
      INNER JOIN student as s ON s.id=i.s_name
	  WHERE i.i_status = 'ACTIVE'".$name.$date."
	  ORDER BY i.id DESC";
$sql_page = mysqli_query($conn,$qry);
$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'20');
$limit = $links->limit();
	
$result=mysqli_query($conn,$qry.$limit);
?>

            <div class="col-md-12">
                <div class="table-responsive">
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <!--<th>Course</th>-->
                            <th>Name</th>
                            <th>Course</th>
                            <th>IC</th>
                            <th>Contact</th>
                            <th>Start Internship</th>
                            <th>End Internship</th>
                            <th>Allowances</th>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Contact</th>
                            <th>Batch</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
							<?php while($row = mysqli_fetch_array($result)){?>
                            <tr>
                            <!--<td><?=$row['c_name']?></td>-->
                            <td><?=$row['s_name']?></td>
                            <td><?=$row['course']?></td>
                            <td><?=$row['s_ic']?></td>
                            <td><?=$row['s_contact']?></td>
                            <td><?=$row['start_internship']?></td>
                            <td><?=$row['end_internship']?></td>
                            <td><?=$row['elaun']?></td>
                            <td><?=$row['company_name']?></td>
                            <td><?=$row['company_address']?></td>
                            <td><?=$row['company_contact']?></td>
                            <td><?=$row['batch']?></td>
                            <td><a class="btn btn-primary" href="edit_internship.php?id=<?=$row[0]?>">Edit</a></td>
                            <td><a class="btn btn-danger" href="add_internship.php?action=delete&id=<?=$row[0]?>" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></td>
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
  <script>
$('#s_name').on('change', function(){
		var selected = $(this).find("option:selected").val();
		//alert(selected);
			//use ajax to run the check  
		$.post("search_int.php", { id: selected },  
			function(result){ 
                //console.log(result);
                var spl=result.split(",");

				$("#s_ic").val(spl[0]);
                $("#s_contact").val(spl[1]);
                switch(spl[2]) {
                case "Accounting":
                    var a=1;
                    break;
                case "Electronic":
                    var a=2;
                    break;
                case "Multimedia":
                    var a=3;
                    break;
                case "Networking":
                    var a=4;
                    break;
                case "Programming":
                    var a=5;
                    break;
                default:
                    // code block
                    var a=0;
                }
                
                $("#course option[value='"+a+"']").attr("selected","selected");
                //console.log(a);
                
			});  
	});

</script>
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
