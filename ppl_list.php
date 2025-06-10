<?php
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new PPL.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit PPL.');	
}

$s_name = '';
if(isset($_GET['search']) && $_GET['search'] == 'search'){
	$s_name .= " AND s_name LIKE '%".$_GET['name']."%'";
}else{
	$s_name = '';
}
?>
<!-- Page Content -->

<div class="container-fluid">
  <?php 
	if(isset($system_msg)){echo $system_msg;}
	
mysqli_set_charset($conn, 'utf8');	


$qry="select * from lawatan_ppl as l inner join course as c on c.id=l.c_id where p_status='ACTIVE'";
$sql_page = mysqli_query($conn, $qry);
$num_page = mysqli_num_rows($sql_page);
$page_records = $num_page;

$page = new Page();
$links = new Pagination ($page_records,'20');
$limit = $links->limit();

$result=mysqli_query($conn,$qry.$limit);




?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">PPL List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
    <!--<div class="col-md-12">	
        <div class="form-group">
            <form action="student_list.php" method="get">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Search Student</label>
                        <div id="basic-example">
                            <input id="my-input1" class="form-control typeahead" name="name" type="text" value="" style="width:262.5px;" onfocusout="showHint(this.value);">
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
            </form>
        </div>
    </div>-->
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                    <span>Search:<input type="text" name="search" id="sec"  /></span>
                    <span><select id="sel">
                        <option value="name">Name</option>
                        <option value="c_id">Course</option>
                        <option value="s_date">start date</option>
                        <option value="e_date">End date</option>
                    </select></span>
                    <br>
                    <br>
                    <div>
                        <span>Programming=5 Networking=4 Multimedia=3 Electrinic=2 Accounting=1</span>
                    </div>
                    <table id="" class="table table-bordred table-striped" style="width:100%">
                        <thead>
                            <th>Name</th>
                            <th>IC</th>
                            <th>Contact number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Course</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Verification date</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="tb">
							<?php while($row = mysqli_fetch_array($result)){
								
							?>
                            <tr>
                                <td><?=$row['name']?></td>
                                <td><?=$row['ic']?></td>
                                <td><?=$row['c_num']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['address']?></td>
                                <td><?=$row['course']?></td>
                                <td><?=$row['s_date']?></td>
                                <td><?=$row['e_date']?></td>
                                <td><?=$row['v_date']?></td>
                                <td><div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action <span class="caret"></span>
                        </button>
                            <ul class="dropdown-menu  dropdown-menu-right">
                                <li><a href="edit_ppl.php?id=<?=$row[0]?>"> Edit </a></li>
                                <li><a href="add_ppl.php?id=<?=$row[0]?>&action=delete" onclick="return confirm('Confirm to Delete this Record?')"> Delete </a></li>
                                
                                
                            </ul>
                        </div></td>
                            </tr>
                            <tr><td colspan="10">Comment : <span style="color:#3c763d;"><?php echo $row['comment']; ?></span></td></tr>
                            <tr><td colspan="10">PPL Information : <span style="color:#3c763d;"><?php echo $row['ppl_infor']; ?></span></td></tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <?php require('addon/pagination/pagination_footer.php');?>
                <!--</div>-->
            </div>
</div>
       

  
  <!-- /.row -->
  <?php require('footer.php');?>

  <script>
$(document).ready(function () {
    //alert(123);
    $("#sec").on("keyup", function(){
        //alert("ads");
        var sec=$(this).val();
        var c_id=$("#sel").val();
        $.post("ppl.php",{search:sec,course:c_id},
        function(result){
            $("#tb").html(result);
        });
    });
});
</script>
 