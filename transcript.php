<?php 
require('include/include.php');
include("header.php");

if(isset($_GET["id"]) && $_GET["id"]!==""){
    $id=$_GET["id"];
}else{
    $id="";
}

$qry="select t.*, s.s_name from transcript as t inner join student as s on s.id=t.s_id where t.s_id='$id'";
$sttr=mysqli_query($conn,$qry);


?>


<div class="container">

    <div class="row">
    <div class="col-md-12">
                <?php 
                include("switch_list.php");
                ?>
    </div>
        <div class="heading">
            <h3>transcript List</h3>
        </div>
        <br>
       <div class="col-lg-12">
            <div class="col-md-6">
                <form action="upload_transcript.php?id=<?=$_GET["id"]?>" method="post" enctype="multipart/form-data">
                
                <fieldset>
                    <legend>Upload transcript at here</legend>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" class="form-control"  name="file" require />
                    </div>
                    <div class="form-group">
                        <label>CGPA</label>
                        <input type="text" name="cgpa" class="form-control"  />
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="upload" >submit</button>
                    </div>

                </fieldset>
                </form>
            </div>
       </div>
</br>
</br>
       <div class="col-lg-12">
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    <th>Student Name</th>
                    <th>Attachment</th>
                    <th>cgpa</th>
                    <?php if($_SESSION["level"]=="superadmin" ){ ?>
                    <th>view</th>
                    <th>delete</th>
                    <?php  } ?>
                </thead>
                <tbody>
                    <?php while($row=mysqli_fetch_array($sttr)){ ?>
                        <tr>
                            <td><?=$row["s_name"]?></td>
                            <td><?=$row["attachment"]?></td>
                            <td><?=$row["cgpa"]?></td>

                            <?php if($_SESSION["level"]=="superadmin" ){ ?>
                            <td><a class="btn btn-primary" target="_blank" href="./transcript/<?=$row["attachment"]?>">view</a></td>
                            <td><a href="upload_transcript.php?action=delete&id=<?=$row["id"]?>&sid=<?=$_GET["id"]?>" class="btn btn-danger">delete</a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
       </div>
    </div>

<?php include("footer.php"); ?>
</div>


