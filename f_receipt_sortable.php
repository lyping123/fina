<?php

require('include/include.php');

require('header.php');





$c_type = '';

$searchdate="";

if(isset($_GET['search']) && $_GET['search'] == 'search'){

    if(isset($_GET['c_type']) && !empty($_GET['c_type'])){

		$c_type = " AND f.receipt_type = '".$_GET['c_type']."'";

	}

    if(isset($_GET["s_date"]) && !empty($_GET["s_date"])){

        $searchdate.=" AND DATE(f.r_date)>=DATE('$_GET[s_date]') AND DATE(f.r_date)<=DATE('$_GET[e_date]')";

    }

    if(isset($_GET["cash_bill_option"]) && !empty($_GET["cash_bill_option"])){
        $searchdate.=" AND f.cash_bill_option = '".$_GET['cash_bill_option']."'";
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

                        SEPARATOR '<hr>') AS descriptionn,

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
                                                    
                                                    WHEN f.cash_bill_option = 'Tuition PTPK Auto debit' THEN 'TPA'

                                                    WHEN f.cash_bill_option = 'Tuition PTPK Seft pay' THEN 'TPS'

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

                (f.r_status = 'ACTIVE' OR f.r_status='SPECIAL')".$c_type.$searchdate."

                GROUP BY f.id

                ORDER BY f.id DESC

                ";

	$result_rcp = mysqli_query($conn,$qry_rcp);
    

    $receipt_no=array();
    $receipt_detail=array();
    while($row_rcp=mysqli_fetch_array($result_rcp)){
        $receipt_no[]=[$row_rcp['id'],$row_rcp["r_no"]];
        $receipt_detail[]=[$row_rcp["r_date"],$row_rcp["s_name"],$row_rcp["descriptionn"]];
    }

}else{

    $qry_rcp = "SELECT 

                    f.id,

                    f.pay_mtd,

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

                                                    WHEN f.cash_bill_option = 'Tuition PTPK Auto debit' THEN 'TPA'

                                                    WHEN f.cash_bill_option = 'Tuition PTPK Seft pay' THEN 'TPS'

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

                f.id=0

                GROUP BY f.id

                ORDER BY f.id DESC

                ";

    

}





?>

    <!-- Page Content -->

    <div class="container">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/smoothness/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<?php 

	

	//$qry_rcp = "SELECT * FROM f_receipt WHERE r_status = 'ACTIVE'".$s_name." AND receipt_type = '1' ORDER BY id DESC";
	$total = '';

?>



		<div class="row">

            <div class="col-lg-12">

                <h1 class="page-header">

                <p>Receipt List</p>

                </h1>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">	

                <div class="form-group">

                    <form action="f_receipt_sortable.php" method="get">

                        <div class="row">

                            <div class="col-lg-3">

                                <label>Search By Cash Bill Type</label>

                                <div id="basic-example">

									<select name="c_type" class="form-control" id="c_type" required>

										<option value="">Choose</option>

										<option value="1">Pusat Kemahiran</option>

										<option value="2">Synergy Central</option>

									</select>

                                </div>

                            </div>

                            

                            <div class="col-lg-3">

                                <div class="form-group">

                                    <label>Start Date</label>

                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">

                                        <input class="form-control" size="16" type="text" value="" required>

                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                                    </div>

                                    <input type="hidden" name="s_date" id="dtp_input2" value="" />

							    </div>

                                <div class="form-group">

                                    <label>End Date</label>

                                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">

                                        <input class="form-control" size="16" type="text" value="" required>

                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                                    </div>

                                    <input type="hidden" name="e_date" id="dtp_input3" value="" />

							    </div>

                            </div>

                            <div class="col-lg-3">
                                <?php 
                                $select="SELECT cash_bill_option FROM f_receipt GROUP BY cash_bill_option";
                                $sttr=mysqli_query($conn,$select);
                               
                                ?>
                                <label>Cash Bill Option</label>
                                <select class="form-control" name="cash_bill_option">
                                    <option value="">Choose</option>
                                    <?php  while($row_select=mysqli_fetch_array($sttr)){ ?>
                                        <option value="<?=$row_select[0]?>"><?=$row_select[0]?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>

                        </div>

                        <br />

                    

                    <div style="padding: 19px 20px 20px;margin-top: 20px;    margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">

                      <div class="row">

                            <div class="col-lg-6">

                            <button type="submit" name="search" value="search" class="btn btn-primary" name="submit">Search</button>

                            </div>

                      </div>

                    </div>

                    </form>

                </div>

            </div>

            

            <!--<div style="overflow-x:auto;"> -->
            <div class="col-lg-3">
                <?php foreach($receipt_no as $key=>$value){ ?>
                <div href="#" class="list-group-item list-group-item-action" style="height: 105px;" aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                    </div>
                        <p class="mb-1"><?=$receipt_no[$key][1]?></p>
                </div>
                <?php } ?>
            </div>
            <div class="col-lg-9" id="sortable">
                <?php foreach($receipt_detail as $key => $value){  ?>
                    <div href="#" class="list-group-item list-group-item-action" style="height: 105px;" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?=$receipt_detail[$key][0]?></h5>
                        
                        <!-- <small>3 days ago</small> -->
                        </div>
                        <p class="mb-1"><?=$receipt_detail[$key][1]?></p>
                        <small><?=$receipt_detail[$key][2]?></small>
                </div>
                    
               <?php }?>
            </div>
            
        </div>

<script>
    $("#sortable").sortable();

</script>

<?php require('footer.php');?>




