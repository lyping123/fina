<?php 
include('include/include.php');
include('header_student.php');

$query="select * from student as s inner join student_group as sg on sg.id=s.g_id where s.id='".$_SESSION['id']."'";
$sttr=mysqli_query($conn,$query);
$result=mysqli_fetch_array($sttr);
if($result['c_id']==1){
    $mou="where acc='yes'";
}elseif($result['c_id']==2){
    $mou="where elc='yes'";
}elseif($result['c_id']==3){
    $mou="where mul='yes'";
}elseif($result['c_id']==4){
    $mou="where net='yes'";
}elseif($result['c_id']==5){
    $mou="where pro='yes'";
}else{
    $mou="";
}

$qry="select * from mou ".$mou;
$sttr_qry=mysqli_query($conn,$qry);

?>
<style>
    .cus{
            cursor: pointer;
        }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">Programming Company List
            <!--<small>Secondary Text</small>-->
        </h1>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                            <th>Company Name</th>
                            <th>Company Address</th>
                            <th>Company Tel</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Tel</th>
                            <th>Email</th>
                            <th>Company Link</th>
                    </thead>
                    <tbody>
                        <?php while($row=mysqli_fetch_array($sttr_qry)){ ?>
                            <tr>
                              <td><?=$row['c_name']?></td>
                              <td><?=$row['c_address']?></td>
                              <td><?=$row['c_tel']?></td>
                              <td><?=$row['name']?></td>     
                              <td><?=$row['position']?></td>     
                              <td><?=$row['tel']?></td>     
                              <td><?=$row['email']?></td>
                            <td><a class="cus" onclick="window.open('<?=$row['link']?>', '_blank')" ><?=$row['link']?></a></td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php require('footer.php');?>
    </div>
    

