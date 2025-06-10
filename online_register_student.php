<?php 
require('include/include.php');
require("header.php");

$qry="select *, s.id as newid,p.createdate as cdate, p.course as cour from pre_registration as p 
inner join student as s on REPLACE(s.ic,'\t','')=REPLACE(p.ic,'\t','') where s.ic!='' and date(p.createdate)>date('2020-11-01')
";
$sttr=mysqli_query($conn,$qry);

?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
                <thead>
                    <th>Student Name</th>
                    <th>Ic</th>
                    <th>Pre register date</th>
                    <th>Pre register course</th>
                    <th>Payment date</th>
                    <th>receipt descrition</th>
                    <th>First Payment</th>
                    <th>Enrollment Fee</th>
                    <th>Attachment</th>
                </thead>
                <tbody>
                <?php 
                
                while($result=mysqli_fetch_array($sttr)){ 
                $select="select * from f_receipt as fr inner join f_receipt_detail as frd on frd.r_id=fr.id where fr.cash_bill_option=('Tuition Fee' || 'Enrollment Fee') and fr.s_id='$result[newid]'";  
                $slc=mysqli_query($conn,$select);
                $fee="";
                $pdate="";
                $dec="";
                $env=0;
                $i=1;
                $attach=array();
                for($i;$i<=6;$i++){
                    if($result["attachment".$i]!==""){
                        $attach[]="<a target='_BLANK' href='https://synergycollege.edu.my/".$result["attachment".$i]."'>Attachment$i</a>";
                    }
                }

                $new_attach=implode(",",$attach);

                while($row=mysqli_fetch_array($slc)){
                    if($row["cash_bill_option"]=="Enrollment Fee"){
                        $env+=$row["rp_amount"];
                    }elseif($row["cash_bill_option"]=="Tuition Fee"){
                        $fee=$row["rp_amount"];
                        $dec=$row["rp_desc"];
                        $pdate=$row["createdate"];
                    }
                }
                  
                ?>
                    <tr>
                        <td><?=$result["s_name"]?></td>
                        <td><?=$result["ic"]?></td>
                        <td><?=$result["cdate"]?></td>
                        <td><?=$result["cour"]?></td>
                        <td><?=$pdate?></td>
                        <td><?=$dec?></td>
                        <td><?=$fee?></td>
                        <td><?=$env?></td>
                        <td><?=$new_attach?></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
       </div>
    </div>
</div>
<?php include("footer.php"); ?>