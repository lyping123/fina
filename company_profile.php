<?php 
include("include/include.php");
include("header.php");

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Company Profile</h1>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company['company_name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="company_address">Company Address:</label>
                    <input type="text" class="form-control" id="company_address" name="company_address" value="<?php echo $company['company_address']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="company_phone">Company Phone:</label>
                    <input type="text" class="form-control" id="company_phone" name="company_phone" value="<?php echo $company['company_phone']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="company_email">Company Tin:</label>
                    <input type="email" class="form-control" id="company_tin" name="company_tin" value="<?php echo $company['company_tin']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>MSIC Code</label>
                    <input type="text" class="form-control" id="company_msic" name="company_msic" value="<?php echo $company['company_msic']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>business Account number</label>
                    <input type="text" class="form-control" id="company_brn" name="company_brn" value="<?php echo $company['company_brn']; ?>" readonly>
                </div>

            </div>
            
        </div>
    </div>
</div>