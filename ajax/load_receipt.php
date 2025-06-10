<?php 
include("../include/db.php");

$c_type = '';
if(isset($_GET["c_type"]) && $_GET["c_type"]!==""){
    $c_type = " AND f.receipt_type = '".$_GET['c_type']."'";
}


$qry_rcp = "SELECT 
                    f.id,
                    f.pay_mtd,
                    f.receipt_type,
                    l.l_name,
                    DATE(f.r_date) AS r_date,
                    IF(f.s_name <> '', f.s_name, s.s_name) AS s_name,
                    IF(f.s_ic <> '', f.s_ic, s.ic) AS s_ic,
                    GROUP_CONCAT(fr.rp_desc, '(RM ', fr.rp_amount, ')'
                    SEPARATOR ',' ) AS descriptionn,
                    SUM(fr.rp_amount) AS total_amount,
                    IF(f.r_no <> '',
                        f.r_no,
                        IF(f.receipt_type = 1,
                            (SELECT 
                                    LPAD(COUNT(frrr.id) + 10000,
                                                7,
                                                CASE
                                                    WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                                    WHEN f.cash_bill_option = 'Locker' THEN ' L'
                                                END) AS r_no
                                FROM
                                    f_receipt AS frrr
                                WHERE
                                    frrr.r_status = 'ACTIVE'
                                        AND frrr.receipt_type = f.receipt_type
                                        AND frrr.cash_bill_option = f.cash_bill_option
                                        AND frrr.id BETWEEN 1 AND f.id),
                            (SELECT 
                                    LPAD(COUNT(frrr.id) + 10000,
                                                7,
                                                CASE
                                                    WHEN f.cash_bill_option = 'Debtor PTPK' THEN 'DP'
                                                    WHEN f.cash_bill_option = 'Debtor' THEN ' D'
                                                    WHEN f.cash_bill_option = 'Internal Exam Fee' THEN ' I'
                                                    WHEN f.cash_bill_option = 'Hostel Fee' THEN ' H'
                                                    WHEN f.cash_bill_option = 'Tuition PTPK' THEN 'TP'
                                                    WHEN f.cash_bill_option = 'Tuition Fee' THEN ' T'
                                                    WHEN f.cash_bill_option = 'Personal Bond' THEN ' P'
                                                    WHEN f.cash_bill_option = 'Enrollment Fee' THEN ' E'
                                                    WHEN f.cash_bill_option = 'Hostel Deposit' THEN 'HP'
                                                    WHEN f.cash_bill_option = 'laptop deposit' THEN 'LD'
                                                END) AS r_no
                                FROM
                                    f_receipt AS frrr
                                WHERE
                                    frrr.r_status = 'ACTIVE'
                                        AND frrr.receipt_type = f.receipt_type
                                        AND frrr.cash_bill_option = f.cash_bill_option
                                        AND frrr.id BETWEEN 1 AND f.id))) AS r_no
                FROM
                    f_receipt AS f
                        LEFT JOIN
                    student AS s ON s.id = f.s_id
                        INNER JOIN
                    f_receipt_detail AS fr ON fr.r_id = f.id
                        INNER JOIN
                    login AS l ON l.id = f.createby
                WHERE
                f.r_status = 'ACTIVE'".$c_type."
                GROUP BY f.id
                ORDER BY f.id DESC
                limit 100
                ";
$result_rcp = mysqli_query($conn,$qry_rcp);
$array = array();

$i=1;
while($r = mysqli_fetch_assoc($result_rcp)) {
    $array[] = array("r_no"=>$r["r_no"],"r_date"=>$r["r_date"],"s_name"=>$r["s_name"],"s_ic"=>$r["s_ic"],"desc"=>$r["descriptionn"],"total_amount"=>$r["total_amount"],"pay_mtd"=>$r["pay_mtd"],"l_name"=>$r["l_name"]);
    
    //$array[] = array("desc"=>$r["descriptionn"]);
    //echo $i.")".$r["id"].")".$r["descriptionn"]."<br>";
    $i++;
}

//print_r($array);


$json=json_encode($array);

echo '{"data"'.':'.$json.'}';
?>