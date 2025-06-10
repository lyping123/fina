<?php 
include('include/include.php');
include('header.php');


if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $qry="DELETE FROM complain where id='$_GET[id]'";
    if(mysqli_query($conn,$qry)){
        echo "<script>alert('complain delete success')</script>";
    }else{
        echo "<script>alert('complain delete fail')</script>";
    }
}



$qry="SELECT * FROM complain_list as cl 
INNER JOIN student as s on s.id=cl.s_id";
$sttr=mysqli_query($conn,$qry);

?>
<div class="container">


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Complain List
            <!--<small>Secondary Text</small>-->
        </h1>
    </div>
   
    
            
</div>
<div class="row">
        	<div class="col-md-12">
                <!--<div class="table-responsive">-->
                
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    
                        <thead>
                            <th>Student Name</th>
                            <th>Ic</th>
                            <th>Gender</th>
                            <th>Main Issue</th>
                            <th>Complain</th>
                            <th>Date Complain</th>
                            <th>Action</th>  
                        </thead>
                        <tbody>
                          <style>
                            .bg-danger {
                                background-color: #dc3545 !important;
                            }	  
                          </style>
							<?php while($row = mysqli_fetch_array($sttr)){?>
                            <tr>
                              
                              <td><?=$row['s_name']?></td>
                              <td><?=$row['ic']?></td>
                              <td><?=$row['gender']?></td>
                              <td><?=$row['main_issue']?></td>
                              <td><?=$row['issue_problem']?></td>     
                              <td><?=$row['i_date']?></td>     
                              <td><button type="delete" onclick="window.location.href='complain_list.php?action=delete&id=<?=$row['id']?>'" class="btn btn-danger">Delete</button></td>       
                                  
                                  
                            </tr>

                            <?php }?>
                        </tbody>
                    </table>
                <!--</div>-->
            </div>
        

</div>
</div>
<script>
   

</script>

<?php include("footer.php"); ?>