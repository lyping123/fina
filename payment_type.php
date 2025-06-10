<?php
require ('include/db.php');
  
//get the username  
$value = $_POST['value']; 
if(isset($type)){
    $type=$_POST['type']; 
}else{
    $type="";
}

if(isset($_GET['id'])){
    
    $qry2 = "SELECT * FROM f_b_c WHERE r_id = '".$_GET['id']."'";
    $result2 = mysqli_query($conn, $qry2);
    $row2 = mysqli_fetch_array($result2);
    $rows2 = mysqli_num_rows($result2);
}

if($value == 'b'){
?>
                <div class="form-group">
                <label>Banker</label>
                <select name="bankin_banker" class="form-control" id="bankin_banker" required>
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Affin Bank Berhad'){ echo "selected"; }?>>Affin Bank Berhad</option>
                    <option value="Alliance Bank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Alliance Bank'){ echo "selected"; }?>>Alliance Bank</option>
                    <option value="AmBank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'AmBank Berhad'){ echo "selected"; }?>>AmBank Berhad</option>
                    <option value="CIMB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'CIMB Bank Berhad'){ echo "selected"; }?>>CIMB Bank Berhad</option>
                    <option value="Citibank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Citibank Berhad'){ echo "selected"; }?>>Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Hong Leong Bank Berhad'){ echo "selected"; }?>>Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'HSBC Bank Malaysia Berhad'){ echo "selected"; }?>>HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Maybank'){ echo "selected"; }?>>Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'OCBC Bank Malaysia Berhad'){ echo "selected"; }?>>OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Public Bank Berhad'){ echo "selected"; }?>>Public Bank Berhad</option>
                    <option value="RHB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'RHB Bank Berhad'){ echo "selected"; }?>>RHB Bank Berhad</option>
                    <option value="Standard Chartered" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'Standard Chartered'){ echo "selected"; }?>>Standard Chartered</option>
                    <option value="UOB" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] == 'BANKIN' && $_POST['banker'] == 'UOB'){ echo "selected"; }?>>UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Upload</label>
                    <input type="file" name="receipt" id="receipt" />
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php if(isset($_POST['in_date'])){ echo $_POST['in_date'];}?>" id="bank_in_date" required>
                    <span class="input-group-addon" style="pointer-events: none;" id="r_bankin_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_bankin_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bankin_date" id="dtp_input1" value="" />
                </div>
                <div class="form-group">
                    <label>Payment Reference</label>
                    <input type="text" name="pr" class="form-control" value="<?php if(isset($_POST['payment_reference'])){ echo $_POST['payment_reference'];}?>"> 
                </div>
<?php }elseif($value == 'c'){?>
                <div class="form-group">
                <label>Cheque No</label>
                <input type="text" class="form-control" name="c_no" id="c_no" value="<?php if(isset($_POST['cheque_no'])){ echo $_POST['cheque_no'];}?>" required>
                </div>
                <div class="form-group">
                <label>Banker</label>
                <select name="banker" class="form-control" id="banker" required>
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Affin Bank Berhad'){ echo "selected"; }?>>Affin Bank Berhad</option>
                    <option value="Alliance Bank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Alliance Bank'){ echo "selected"; }?>>Alliance Bank</option>
                    <option value="AmBank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'AmBank Berhad'){ echo "selected"; }?>>AmBank Berhad</option>
                    <option value="CIMB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'CIMB Bank Berhad'){ echo "selected"; }?>>CIMB Bank Berhad</option>
                    <option value="Citibank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Citibank Berhad'){ echo "selected"; }?>>Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Hong Leong Bank Berhad'){ echo "selected"; }?>>Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'HSBC Bank Malaysia Berhad'){ echo "selected"; }?>>HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Maybank'){ echo "selected"; }?>>Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'OCBC Bank Malaysia Berhad'){ echo "selected"; }?>>OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Public Bank Berhad'){ echo "selected"; }?>>Public Bank Berhad</option>
                    <option value="RHB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'RHB Bank Berhad'){ echo "selected"; }?>>RHB Bank Berhad</option>
                    <option value="Standard Chartered" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Standard Chartered'){ echo "selected"; }?>>Standard Chartered</option>
                    <option value="UOB" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'UOB'){ echo "selected"; }?>>UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php if(isset($_POST['in_date'])){ echo $_POST['in_date'];}?>" id="b_date" required>
                    <span class="input-group-addon" style="pointer-events: none;" id="r_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="dated" id="dtp_input" value="" />
                </div>
<?php 
    if($type == 1){
?>
                <div class="form-group">
                <label>Select Account</label>
                <select name="account" class="form-control" id="account">
                    <option value="">Select The Account</option>
                    <option value="Hong Leong Bank(15801007719)" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['account'] == 'Hong Leong Bank(15801007719)'){ echo "selected"; }?>>Hong Leong Bank(15801007719)</option>
                </select>
                </div>

                <div class="form-group">
                    <label>Date Receive</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtpb_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php if(isset($_POST['r_date'])){ echo $_POST['r_date'];}?>" id="bb_date">
                    <span class="input-group-addon" style="pointer-events: none;"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bb_date" id="dtpb_input" value="" />
                </div>
<?php
        
    }elseif($type == 2){
?>
                <div class="form-group">
                <label>Select Account</label>
                <select name="account" class="form-control" id="account">
                    <option value="">Select The Account</option>
                    <option value="Hong Leong Bank(15801006473)" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['account'] == 'Hong Leong Bank(15801006473)'){ echo "selected"; }?>>Hong Leong Bank(15801006473)</option>
                    <option value="CIMB Bank(8004179820)" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['account'] == 'CIMB Bank(8004179820)'){ echo "selected"; }?>>CIMB Bank(8004179820)</option>
                </select>
                </div>

                <div class="form-group">
                    <label>Date Receive</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtpb_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php if(isset($_POST['r_date'])){ echo $_POST['r_date'];}?>" id="bb_date">
                    <span class="input-group-addon" style="pointer-events: none;"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bb_date" id="dtpb_input" value="" />
                </div>
<?php
        
    }else{
        
    }
?>
<?php }elseif($value=="cd" || $value=="db"){?>
    <div class="form-group">
                <label>card No</label>
                <input type="number" class="form-control" name="c_no" id="c_no" value="<?php if(isset($_POST['cheque_no'])){ echo $_POST['cheque_no'];}?>" required>
                </div>
                <div class="form-group">
                <label>Banker</label>
                <select name="banker" class="form-control" id="banker" required>
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Affin Bank Berhad'){ echo "selected"; }?>>Affin Bank Berhad</option>
                    <option value="Alliance Bank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Alliance Bank'){ echo "selected"; }?>>Alliance Bank</option>
                    <option value="AmBank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'AmBank Berhad'){ echo "selected"; }?>>AmBank Berhad</option>
                    <option value="CIMB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'CIMB Bank Berhad'){ echo "selected"; }?>>CIMB Bank Berhad</option>
                    <option value="Citibank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Citibank Berhad'){ echo "selected"; }?>>Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Hong Leong Bank Berhad'){ echo "selected"; }?>>Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'HSBC Bank Malaysia Berhad'){ echo "selected"; }?>>HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Maybank'){ echo "selected"; }?>>Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'OCBC Bank Malaysia Berhad'){ echo "selected"; }?>>OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Public Bank Berhad'){ echo "selected"; }?>>Public Bank Berhad</option>
                    <option value="RHB Bank Berhad" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'RHB Bank Berhad'){ echo "selected"; }?>>RHB Bank Berhad</option>
                    <option value="Standard Chartered" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'Standard Chartered'){ echo "selected"; }?>>Standard Chartered</option>
                    <option value="UOB" <?php if(isset($_POST['cheque_no']) && $_POST['cheque_no'] != 'BANKIN' && $_POST['banker'] == 'UOB'){ echo "selected"; }?>>UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php if(isset($_POST['in_date'])){ echo $_POST['in_date'];}?>" id="b_date" required>
                    <span class="input-group-addon" style="pointer-events: none;" id="r_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="dated" id="dtp_input" value="" />
                </div>

<?php }?>