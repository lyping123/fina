<?php
include("include/include.php"); 
include("header.php");

$qry="select * from saksi";
$sttr=mysqli_query($conn,$qry);



?>
<div class="container">
<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> saksi List
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div style="overflow-x:auto;"> 
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead>
                        <th>Nama</th>
                        <th>Jawatan</th>
                        <th>School Name</th>
                        <th>Area</th>
                        <th>Telefon</th>
                        <th>No K/P</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php while($result=mysqli_fetch_array($sttr)){ ?>
                            <tr>
                                <td><?=$result["p_name"]?></td>
                                <td><?=$result["position"]?></td>
                                <td><?=$result["school_name"]?></td>
                                <td><?=$result["area"]?></td>
                                <td><?=$result["phone"]?></td>
                                <td><?=$result["ic"]?></td>
                                <td><a class="btn btn-primary" href="edit_saksi.php?id=<?=$result["id"]?>" >Edit</a></td>
                                <td><button type="button" class="btn btn-danger" onclick="window.location.href='add_saksi.php?action=del&id=<?=$result['id']?>'" name="delete" >Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php include("footer.php"); ?>