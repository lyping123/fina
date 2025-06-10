<?php 
require('include/include.php');
require("header.php");

$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully Submit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_del'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete record.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_del'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete record.');
}

$section="";
$searchby="";
if(isset($_GET["morning"]) && $_GET["morning"]!==""){
    $section="AND TIME(st.s_date) BETWEEN '07:00:00' AND '12:00:00'";
}

if(isset($_GET["afternoon"]) && $_GET["afternoon"]!==""){
    $section="AND TIME(st.s_date) BETWEEN TIME '12:01:00' AND TIME'17:00:00'";
}

if(isset($_GET["f_date"]) && $_GET["f_date"]!==""){
    $searchby="AND date(st.s_date)='".$_GET['f_date']."'";
}




            $qry="select * from student_tem as st
            inner join student as s on s.id=st.s_id
            where s.s_status='ACTIVE' ".$section.$searchby." order by st.s_date desc";
            $sttr=mysqli_query($conn,$qry);

?>


<div class="container">
<?php if(isset($system_msg)){echo $system_msg;} ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Student check in list
            <!--<small>Secondary Text</small>-->
            <!-- <a class="btn btn-primary pull-right" href="print_alert.php?action=course" target="_blank"><span class="glyphicon glyphicon-plus"></span> Print </a> -->
        </h1>
    </div>
    <form action="" method="get">
    <div class="row">
        <div class="col-md-3">
        		<label>Date</label>
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" id="from" size="16" type="text" value="">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" name="f_date" id="dtp_input" value="" /><br/>
            
        </div>
        <div class="col-md-3">
        <br>
        
        <button type="submit" class="btn btn-success" value="search" name="search">Search</button>
        </div>
        <div class="col-md-6">
        <br>
            <button type="submit" class="btn btn-primary" value="morning" name="morning">morning Section</button>
            <button type="submit" class="btn btn-primary" value="afternoon" name="afternoon">afternoon Section</button>
        </div>
    </div>
    </form>
    <div class="row">
        <div class="col-md-12">
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Course</th>
                        <th>Temperature</th>
                        <th>Time check in</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php while($result=mysqli_fetch_array($sttr)){ ?>
                            <tr>
                                <td><?=$result["s_name"]?></td>
                                <td><?=$result["phone_number"]?></td>
                                <td><?=$result["course"]?></td>
                                <td><?=$result["tem"]?></td>
                                <td><?=$result["s_date"]?></td>
                                <td><a class="btn btn-danger" onclick="return confirm('Are You sure you wan to delete?')" href='add_tem.php?action=delete&&id=<?=$result[0]?>&&table=student_tem'>DELETE</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>

<?php include("footer.php"); ?>