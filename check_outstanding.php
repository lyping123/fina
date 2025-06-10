<?php 
include("include/include.php");
include("header.php");

$status="";
if(isset($_GET["bill_type"]) && $_GET["bill_type"]=="tuitionfee"){
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,MAX(f.r_date) as r_date FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='ptpk' AND s.s_status='ACTIVE' AND cash_bill_option='Tuition Fee' 
    GROUP BY s.id,s.s_name
    HAVING total_amount<2400";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_num_rows($sttr);

    $status="selected";
   
}else{
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,MAX(f.r_date) as r_date FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='semester' AND s.s_status='ACTIVE' AND cash_bill_option='Tuition Fee' 
    GROUP BY s.id,s.s_name
    HAVING total_amount<s.tuition_fee";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_num_rows($sttr);
    $status="ptpkselected";
}

?>

<style>
    .selected{
        background-color: white;
        color: black;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <h2>Outstanding Tuition Fee</h2>
            <div class="col-md-6">
                <form action="" method="get">
                    <button type="submit" class="btn btn-primary <?php if($status=="selected"){echo "selected"; } ?>"  value="tuitionfee" name="bill_type">Tuition Fee</button>
                    <button type="submit" class="btn btn-primary <?php if($status=="ptpkselected"){echo "selected";} ?>" value="tuitionptpk" name="bill_type">Tuition PTPK</button>
                </form>
            </div>
            <table id="example1" class="table table-bordered">
                <thead>
                    <th>Student Name</th>
                    <th>Total pay</th>
                    <th>Last Payment date</th>
                    <th>remind date</th>
                </thead>
                <tbody>
                    <?php 
                    
                    if($status=="selected"){
                        while($result=mysqli_fetch_array($sttr)){ 
                            $datereceipt=new DateTime($result['r_date']);
                            $datereceipt->modify('+1 month');
                            $dateafteronemonth=date_format($datereceipt,"Y-m-d");
                            $last_receiptdate=date_format($datereceipt,"Y-m-d");
                            $datenow=new DateTime(date("Y-m-d"));
                            if($datenow>=$datereceipt){ ?>
                                <tr>
                                    <td><?=$result["s_name"]?></td>
                                    <td><?=$result["total_amount"]?></td>
                                    <td><?=$last_receiptdate?></td>
                                    <td><?=$dateafteronemonth?></td>
                                </tr>

                            <?php }
                        }
                    }else{

                    
                    while($result=mysqli_fetch_array($sttr)){ 
                     $datereceipt=new DateTime($result['r_date']);
                     $datereceipt->modify('+6 month');
                     $last_receiptdate=date_format($datereceipt,"Y-m-d");
                     $dateaftersixmonth=date_format($datereceipt,"Y-m-d");
                     $datenow=new DateTime(date("Y-m-d"));
                     
                     if($datenow>=$datereceipt){
                    ?>
                        <tr>
                            <td><?=$result["s_name"]?></td>
                            <td><?=$result["total_amount"]?></td>
                            <td><?=$last_receiptdate?></td>
                            <td><?=$dateaftersixmonth?></td>
                        </tr>
                    <?php } } }?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include("footer.php") ?>
</div>
