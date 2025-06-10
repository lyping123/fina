<?php 
require('include/include.php');
require("header.php");

$qry="select * from pre_registration where status='REJECT'";
$sttr=mysqli_query($conn,$qry);

?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    <th>Student Name</th>
                    <th>Ic</th>
                    <th>email</th>
                    <th>phone number</th>
                    <th>state</th>
                    <th>address</th>
                    <th>school</th>
                    <th>Pre register date</th>
                    <th>Reject date</th>
                    <th>Reject comment</th>
                    <th>Attachment</th>
                </thead>
                <tbody>
                <?php 
                  while($result=mysqli_fetch_array($sttr)){   
                    $i=1;
                    $attach=array();
                    for($i;$i<=6;$i++){
                        if($result["attachment".$i]!==""){
                            $attach[]="<a target='_BLANK' href='https://synergycollege.edu.my/".$result["attachment".$i]."'>Attachment$i</a>";
                        }
                    }
                    $new_attach=implode(",",$attach);            
                ?>
                    <tr>
                        <td><?=$result["s_name"]?></td>
                        <td><?=$result["ic"]?></td>
                        <td><?=$result["s_email"]?></td>
                        <td><?=$result["hp_contact"]?></td>
                        <td><?=$result["r_state"]?></td>
                        <td><?=$result["r_address"]?></td>
                        <td><?=$result["secondary_school"]?></td>
                        <td><?=$result["createdate"]?></td>
                        <td><?=$result["rej_date"]?></td>
                        <td><?=$result["comment"]?></td>
                        <td><?=$new_attach?></td>
                        
                    </tr>
                <?php } ?>
                </tbody>

            </table>
       </div>
    </div>
</div>
<?php include("footer.php"); ?>