<?php
include("include/sinclude.php");
require('header_student.php');
$system_msg='';
if(isset($_GET['action']) && $_GET['action'] == 'msg_success_add'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully add new student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_login_success'){
	$system_msg .= systemMsg('alert-success','Welcome',$_SESSION['name']);	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_edit'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully edit student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_q'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as quit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_g'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as graduate.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_q'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set student status as quit.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_g'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set student status as graduate.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_reg'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_reg'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set this student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_success_req'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully set student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_fail_req'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to set this student status as current student.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_del_success'){
	$system_msg .= systemMsg('alert-success','Success!','Successfully delete current record.');	
}elseif(isset($_GET['action']) && $_GET['action'] == 'msg_del_fail'){
	$system_msg .= systemMsg('alert-danger','Fail!','Fail to delete current record.');	
}
?>

    <!-- Page Content -->
    <div class="container">
<?php 
	if(isset($system_msg)){echo $system_msg;}
	//$qry_rcp = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE'".$s_name." AND receipt_type = '1' ORDER BY id DESC";

	$qry_rcp = "SELECT 
                    f.cash_bill_option as new_option,
                    s.tuition_fee,
                    f.id,
                    s.id,
                    f.receipt_type,
                    l.l_name,
                    DATE(f.r_date) AS r_date,
                    IF(f.s_name <> '', f.s_name, s.s_name) AS s_name,
                    IF(f.s_ic <> '', f.s_ic, s.ic) AS s_ic,
                    GROUP_CONCAT(fr.rp_desc, '(RM ', fr.rp_amount, ')'
                        SEPARATOR '<hr>') AS descriptionn,
                    SUM(fr.rp_amount) AS total_amount,
                    IF(f.r_no <> '',
                        f.r_no,
                        IF(f.receipt_type = 1,
                            (SELECT 
                                    LPAD(COUNT(frr.id) + 10000, 6, 'D') AS r_no
                                FROM
                                    f_receipt AS frr
                                WHERE
                                    frr.r_status = 'ACTIVE'
                                        AND frr.receipt_type = f.receipt_type
                                        AND frr.id BETWEEN 1 AND f.id),
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
                    f.r_status = 'ACTIVE' AND s.id = '".$_SESSION['id']."'
                GROUP BY f.id
                ORDER BY f.id DESC
                ";
	$result_rcp = mysqli_query($conn,$qry_rcp);

    $select="SELECT * FROM f_cn as f
    INNER JOIN f_cn_detail as fd on fd.cn_id=f.id
    LEFT JOIN student as s on s.id=f.s_id
    INNER JOIN login AS l ON l.id = f.createby
    WHERE f.s_id=$_SESSION[id] AND f.cn_status='ACTIVE'";
    $sttr_se=mysqli_query($conn,$select);

    $total = '';

?>
<style>
.cal{
    background-color:#00FA9A;

}

body {
            background-color: #f8f9fa;
        }

        .announcement-card {
            border: none;
            padding:10px 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .announcement-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease-in-out;
        }
        .card-title{
            font-weight: bold;
        }
       
</style>
<div class="container">
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                <p>Account Statement</p>
                </h1>
            </div>
        </div>

        <div class="row">
            
            <!--<div style="overflow-x:auto;"> -->
            <table id="example1" class="table table-bordred table-striped" style="width:100%">
            	<thead>
                	<th>Receipt No.</th>
                	<th style="width: 90px;">Date</th>
                	<th>Name</th>
                	<th>IC</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Create By</th>
                </thead>
                <tbody>
                <?php 
                    $tuition=0;
                    $hostel=0;
                    $hostel_de=0;
                    $int=0;
                    $enc=0;
                ?>
                <?php 
                $enc="";

                $qry2="SELECT SUM(CASE WHEN fd.cn_desc ='REFUND TUITION FEE' THEN fd.cn_amount ELSE 0 END) as tuitionfee,
                              SUM(CASE WHEN fd.cn_desc ='REFUND HOSTEL FEE' THEN fd.cn_amount ELSE 0 END) as hostelfee,
                              SUM(CASE WHEN fd.cn_desc ='REFUND INTERNAL EXAM FEE' THEN fd.cn_amount ELSE 0 END) as intfee,
                              SUM(CASE WHEN fd.cn_desc ='REFUND ENROLLMENT FEE' THEN fd.cn_amount ELSE 0 END) as enrfee,
                              SUM(CASE WHEN fd.cn_desc ='REFUND HOSTEL DEPOSIT' THEN fd.cn_amount ELSE 0 END) as hdepositfee
                 FROM f_cn as cn 
                        INNER JOIN f_cn_detail as fd on fd.cn_id=cn.id
                        WHERE cn.s_id='$_SESSION[id]' AND cn_status='ACTIVE'";
                $sttr2=mysqli_query($conn,$qry2);
                $cn_price=mysqli_fetch_array($sttr2);
                $cn_row=mysqli_num_rows($sttr2);

                while($row_rcp = mysqli_fetch_array($result_rcp)){
                   //$parts=preg_split('/(,?\s+)|[a-z](?=\\d)|\\d(?=[a-z])/i',$row_rcp["r_no"]);
                    
                    //$row_rcp['r_no'];
                    //print_r($parts);
                    
                    //echo $parts[1]."aa";
                    //print_r($parts);
                    $parts=$row_rcp["new_option"];
                    
                   

                    if($parts=="Debtor" || $parts=="Tuition Fee" || $parts=="Tuition PTPK"||$parts=="Debtor PTPK"){


                        $mystring = $row_rcp["descriptionn"];
                        $findme   = "ENROLLMENT FEE";
                        $findme1   = "ENROLLMENT FEES";
                        $find=strpos($mystring,$findme);
                        $find1=strpos($mystring,$findme1);
                        
                        if($find===0 || $find1===0 ){
                            $enc=$row_rcp['total_amount'];
                            
                        }else{
                            $tuition+=$row_rcp["total_amount"];
                        }

                        
                        
                    }elseif($parts=="Hostel Fee"){
                        $hostel+=$row_rcp["total_amount"];
                    }elseif($parts=="Internal Exam Fee"){
                       
                        $int+=$row_rcp["total_amount"];
                    }elseif($parts=="Hostel Deposit"){
                       
                        $hostel_de+=$row_rcp["total_amount"];
                    }elseif($parts=="Enrollment Fee"){
                        $enc+=$row_rcp["total_amount"];
                    }
                    $total=$row_rcp["tuition_fee"];
                    
                    
                    
                ?>
                	<tr>
                    	<td><?=$row_rcp['r_no']?></td>
                    	<td><?=$row_rcp['r_date']?></td>
                    	<td><?=$row_rcp['s_name']?></td>
                    	<td><?=$row_rcp['s_ic']?></td>
                        <td><?=$row_rcp['descriptionn']?></td>
                        <td>RM <?=$row_rcp['total_amount']?></td>
                        <td><?=$row_rcp['l_name']?></td>
                    </tr>
                    
                <?php }?>
                   ><?=$row_rcp['l_name']?></td>
                    </tr>
                
                <?php while($result_se=mysqli_fetch_array($sttr_se)){ 
                if($result_se['cn_no'] == ''){
                    $rno_qry = "SELECT count(fr.id) AS r_no FROM f_cn AS fr WHERE fr.cn_status = 'ACTIVE' AND fr.receipt_type = '".$result_se['receipt_type']."' AND fr.id BETWEEN 1 AND ".$result_se[0];
                    $rno_result = mysqli_query($conn, $rno_qry);
                    $rno_row = mysqli_fetch_array($rno_result);
                    
                    if($result_se['receipt_type'] == 1){
                        $r_no = 10000 + $rno_row['r_no'];
                        $r_no = 'CNP'.$r_no;
                    }else{
                        $r_no = 10000 + $rno_row['r_no'];
                        $r_no = 'CN'.$r_no;
                    }
                }else{
                    $r_no = $result_se['cn_no'];
                }    
                ?>
                    <tr>
                    	<td><?=$r_no?></td>
                    	<td><?=$result_se['cn_date']?></td>
                    	<td><?=$result_se['s_name']?></td>
                    	<td><?=$result_se['ic']?></td>
                        <td><?=$result_se['cn_desc']?></td>
                        <td>RM <?=$result_se['cn_amount']?></td>
                        <td><?=$result_se['l_name']?></td>
                    </tr>

                <?php } ?>
                <?php if($cn_row!=0){ ?>
                <tr>
                    <td colspan="5" style="text-align:left;">credit amonth:</td>
                    <td colspan="2" style="text-align:left;">RM:<?=$cn_price[0]?></td>
                </tr>
                <?php } ?>
                <tr >
                    <td colspan="5" style="text-align:left;">Enrollment Fee:</td>
                    <td colspan="2" style="color:green" >RM <?=$enc?> <span style="color: red;"><?php echo $result=($cn_price["enrfee"]!=0) ? "(-".$cn_price["enrfee"].")" : "" ;?></span></td>
                </tr>
                <tr >
                    <td colspan="5" style="text-align:left;">Hotel deposit pay:</td>
                    <td colspan="2" style="color:red" >RM <?=$hostel_de?></td>
                </tr>
                <?php 
                if($cn_price["hdepositfee"]!=0){ ?>
                <tr>
                    <td colspan="5"  style="text-align:left;">Credit note Hostel deposit</td>
                    <td style="color:blue" colspan="2">RM -<?=$cn_price["hosteldeposit"]?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" style="text-align:left;">Hostel Fee pay:</td>
                    <td colspan="2" style="color:red" >RM <?=$hostel?></td>
                </tr>
                <tr>
                    <td colspan="5"  style="text-align:left;">TuiTion Fee pay</td>
                    <td style="color:blue" colspan="2">RM <?=$tuition?><span style="color: red;"></td>
                </tr>
                <?php 
                if($cn_price["tuitionfee"]!=0){ ?>
                <tr>
                    <td colspan="5"  style="text-align:left;">Credit note Tuition fee</td>
                    <td style="color:blue" colspan="2">RM -<?=$cn_price["tuitionfee"]?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="5"  style="text-align:left;">Internel Exam been pay:</td>
                    <td colspan="2" style="color:purple" >RM <?=$int?></td>
                </tr>
                </td>
                </tbody>
            
            </table>
            <!--</div>-->
            
        </div>
                <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 announcement-card">
                <div class="card-body">
                    <?php 
                    $select="SELECT * FROM memo_fee WHERE student='$_SESSION[id]'";
                    $sttr_se=mysqli_query($conn,$select);
                    $result=mysqli_fetch_array($sttr_se);
                    
                    ?>
                    <h5 class="card-title">Total fee of each payment</h5>
                    
                    <p class="card-text">Endrollment Fee: <span style="color:green">RM <?=$result["e_fee"]?></span></p>
                    <p class="card-text" >Hostel Deposit:  <span style="color:red">RM <?=$result["hostel_deposit"]?></span></p>
                    <p class="card-text" >Hostel fee:  <span style="color:orange">RM <?=$result["hostel_fee"]?></span></p>
                    <p class="card-text">Tuition Fee: <span style="color:blue">RM <?=$result["tuition_fee"]?></span></p>
                    <p class="card-text">internal exam fee: <span style="color:purple"> RM <?=$result["internal_fee"]?></span></p>
                </div>
            </div>
        </div>
    </div>
    
  <?php require('footer.php');?>
  </div>
<script>
    
$(document).on('click', '#edit_button', function() {
	var id = $(this).data('id');
	
	$('#editform').attr('action', "add_student.php?action=quit&id="+id).submit();
});
</script>
