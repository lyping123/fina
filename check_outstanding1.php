<?php 
include("include/db.php");

$status="";
if(isset($_GET["bill_type"]) && $_GET["bill_type"]=="tuitionfee"){
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date,
    if(CURDATE()<DATE(t_end),TIMESTAMPDIFF(MONTH,DATE(t_start),CURDATE()),TIMESTAMPDIFF(MONTH,DATE(t_start),DATE(t_end))) as month_difference,s.month_pay,`month` FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='ptpk' AND s.s_status='ACTIVE' AND (cash_bill_option='Tuition Fee' OR cash_bill_option='Tuition PTPK Self Pay')
    GROUP BY s.id,s.s_name";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_num_rows($sttr);
    $status="selected";
   
}else{
    $qry="SELECT s.id,s.s_name,s.s_email,s.tuition_fee,DATE_FORMAT(f.r_date, '%Y-%m') as ym,SUM(fd.rp_amount) as total_amount,fd.rp_desc,DATE_FORMAT(MAX(f.r_date), '%Y-%m-%d') as r_date FROM student s 
    INNER JOIN f_receipt f ON f.s_id=s.id
    INNER JOIN f_receipt_detail fd ON fd.r_id=f.id
    WHERE s.p_method='semester' AND s.s_status='ACTIVE' AND (cash_bill_option='Tuition Fee' OR cash_bill_option='Tuition PTPK')
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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Synergy portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <h2>Outstanding </h2>
            <div class="col-md-6">
                <form action="" method="get">
                    <button type="submit" class="btn btn-primary <?php if($status=="selected"){echo "selected"; } ?>"  value="tuitionfee" name="bill_type">Tuition Fee</button>
                    <button type="submit" class="btn btn-primary <?php if($status=="ptpkselected"){echo "selected";} ?>" value="tuitionptpk" name="bill_type">Tuition PTPK</button>
                </form>
            </div>
            <div class="col-md-2">
                    <a href="print_tuitionoutstanding.php?bill_type=<?=$status?>" target="_blank" class="btn btn-success"  name="bill_type">Print</a>   
            </div>
            <table id="example1" class="table table-bordered">
                <thead>
                    <th>Student Name</th>
                    <th>Total pay</th>
                    <th>Last Payment date</th>
                    <th>Outstanding</th>
                    <th>remind date</th>
                </thead>
                <tbody>
                    <?php 
                    
                    if($status=="selected"){
                        while($result=mysqli_fetch_array($sttr)){
                            $datereceipt=new DateTime($result['r_date']);
                            $dateafteronemonth=$datereceipt->modify('+1 month')->format("Y-m");
                            $last_receiptdate=date_format($datereceipt,"Y-m");
                            $month=$result["month_difference"]+1;

                            
                            $total_outstanding=$result["month_pay"]*$month-$result["total_amount"];
                            $datenow=new DateTime(date("Y-m-d"));
                            $tuitionptpk_qry="SELECT SUM(fd.rp_amount) as ptpk FROM f_receipt f 
                            INNER JOIN f_receipt_detail fd ON f.id=fd.r_id 
                            WHERE s_id=$result[id] AND f.cash_bill_option='Tuition PTPK' AND f.r_date  BETWEEN date('2024-07-01') AND date('2024-07-31')
                            GROUP BY s_id
                            HAVING ptpk<1000";
                            $tuitionptpk_sttr=mysqli_query($conn,$tuitionptpk_qry);
                            $tuitionptpk_result=mysqli_num_rows($tuitionptpk_sttr);
                            if($tuitionptpk_result>0){
                                $row=mysqli_fetch_array($tuitionptpk_sttr);

                                $ptpk=$row[0];
                            }else{
                                $ptpk=0;
                            }
                            if($result["month"]>0){
                                $total_outstanding-=$result["month"]*$result["month_pay"];
                            }

                            $total_outstanding-=$ptpk;
                            
                            if($total_outstanding>0){ ?>
                                <tr>
                                    <td><?=$result["s_name"]?></td>
                                    <td><?=$result["total_amount"]?></td>
                                    <td><?=$result["r_date"]?></td>
                                    <td><?=$total_outstanding?></td>
                                    <td><?=$dateafteronemonth?></td>
                                </tr>

                            <?php }
                        }
                    }else{

                    
                    while($result=mysqli_fetch_array($sttr)){ 
                     $datereceipt=new DateTime($result['r_date']);
                     $datereceipt->modify('+6 month');
                     $last_receiptdate=date_format($datereceipt,"Y-m-d");
                     $dateaftersixmonth=$datereceipt->format("Y-m-d");
                     $datenow=new DateTime(date("Y-m-d"));
                     
                     if($datenow>=$datereceipt){
                    ?>
                        <tr>
                            <td><?=$result["s_name"]?></td>
                            <td><?=$result["total_amount"]?></td>
                            <td><?=$result["r_date"]?></td>
                            <td><?=$dateaftersixmonth?></td>
                        </tr>
                    <?php } } }?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include("footer.php") ?>
</div>
</body>
</html>
