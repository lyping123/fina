<?php 
require('include/include.php');
require('header.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_fail_add'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to add new student.');
}

if(isset($_POST["submit"])){
    $qry="insert into student_ptpk(`s_id`, `no_fail`, `c_from`, `c_to`, `m_user`, `m_pass`)
    value('$_GET[id]','$_POST[no_fail]','$_POST[f_date]','$_POST[t_date]','$_POST[m_user]','$_POST[m_pass]')";
    if(mysqli_query($conn,$qry)){
        echo "<script>
            alert('add success');
        </script>";
    }else{
        echo "<script>
        alert('add fail');
    </script>";
    }
}
if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $del="delete from student_ptpk where id='$_GET[sid]'";
    mysqli_query($conn,$del);
}

$qry="select * from student where id='$_GET[id]'";
$sttr=mysqli_query($conn,$qry);
$row=mysqli_fetch_array($sttr);


$qry1="select * from student_ptpk where s_id='$_GET[id]'";
$result=mysqli_query($conn,$qry1);
?>
<div class="container">
<?php if(isset($system_msg)){echo $system_msg;}?>
    <div class="row">
            <div class="col-md-12">
                <?php 
                include("switch_list.php");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">PTPK Form
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <header class="panel-heading">
                    <h3 class="panel-title">PTPK DETAILS</h3>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="student_ptpk.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label>Student Name</label>
                                <input type="text" class="form-control" readonly name="s_name" value="<?=$row["s_name"]?>" />
                            </div>
                            <div class="form-group">
                                <label>No Fail</label>
                                <input type="text" class="form-control"  name="no_fail" value="" />
                            </div>
                            <div class="form-group">
                                <label>Course Duration from</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="f_date" id="dtp_input1" value="" />
                                
                            </div>
                            <div class="form-group">
                                <label>Course Duration to</label>
                                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input class="form-control" size="16" type="text" value="" >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <input type="hidden" name="t_date" id="dtp_input2" value="" />
                                
                            </div>
                            <div class="form-group">
                                <label>MPT login id</label>
                                <input type="text" class="form-control" name="m_user" value="" />
                            </div>
                            <div class="form-group">
                                <label>MPT login password</label>
                                <input type="text" class="form-control" name="m_pass" value="" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
                            </div>
                            
                        </div>
                    </form>
                    
                    <div class="form-group">
                        
                    <table id="mytable" class="table table-bordred table-striped" style="width:100%">
                        <thead>
                            <th>No Fail</th>
                            <th>course start date</th>
                            <th>course end date</th>
                            <th>MPT Login Id</th>
                            <th>MPT Password</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        <?php while($row1 = mysqli_fetch_array($result)){?>
                        
                            <tr>
                                <td><?=$row1['no_fail']?></td>
                                <td><?=$row1['c_from']?></td>
                                <td><?=$row1['c_to']?></td>
                                <td><?=$row1['m_user']?></td>
                                <td><?=$row1['m_pass']?></td>
                                <td><div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="student_ptpk.php?action=delete&id=<?=$_GET['id']?>&sid=<?=$row1['id']?>">Delete</a></li>
                        </ul>
                        </div></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    
                    </table>
                    </div>
                        
                    
                    </div>
            </div>
        </div>
        <?php include("footer.php"); ?>
</div>

