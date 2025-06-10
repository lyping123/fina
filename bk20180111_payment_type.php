<?php
require ('include/db.php');
  
//get the username  
$value = $_POST['value'];  

if($value == 'b'){
?>
                <div class="form-group">
                <label>Banker</label>
                <select name="bankin_banker" class="form-control" id="bankin_banker" required>
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                    <option value="Alliance Bank">Alliance Bank</option>
                    <option value="AmBank Berhad">AmBank Berhad</option>
                    <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                    <option value="Citibank Berhad">Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad">Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad">HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank">Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad">OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad">Public Bank Berhad</option>
                    <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                    <option value="Standard Chartered">Standard Chartered</option>
                    <option value="UOB">UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" value="" id="bank_in_date" required>
                    <span class="input-group-addon" style="pointer-events: none;" id="r_bankin_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_bankin_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="bankin_date" id="dtp_input1" value="" />
                </div>
<?php }elseif($value == 'c'){?>
                <div class="form-group">
                <label>Cheque No</label>
                <input type="text" class="form-control" name="c_no" id="c_no" value="" required>
                </div>
                <div class="form-group">
                <label>Banker</label>
                <select name="banker" class="form-control" id="banker" required>
                    <option value="">Select The Bank</option>
                    <option value="Affin Bank Berhad">Affin Bank Berhad</option>
                    <option value="Alliance Bank">Alliance Bank</option>
                    <option value="AmBank Berhad">AmBank Berhad</option>
                    <option value="CIMB Bank Berhad">CIMB Bank Berhad</option>
                    <option value="Citibank Berhad">Citibank Berhad</option>
                    <option value="Hong Leong Bank Berhad">Hong Leong Bank Berhad</option>
                    <option value="HSBC Bank Malaysia Berhad">HSBC Bank Malaysia Berhad</option>
                    <option value="Maybank">Maybank</option>
                    <option value="OCBC Bank Malaysia Berhad">OCBC Bank Malaysia Berhad</option>
                    <option value="Public Bank Berhad">Public Bank Berhad</option>
                    <option value="RHB Bank Berhad">RHB Bank Berhad</option>
                    <option value="Standard Chartered">Standard Chartered</option>
                    <option value="UOB">UOB</option>
                </select>
                </div>
                <div class="form-group">
                    <label>Dated</label>
                    <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy hh:ii:ss" data-link-field="dtp_input" data-link-format="yyyy-mm-dd hh:ii:ss">
                    <input class="form-control" size="16" type="text" value="" id="b_date" required>
                    <span class="input-group-addon" style="pointer-events: none;" id="r_date"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon" style="pointer-events: none;" id="s_date"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                    <input type="hidden" name="dated" id="dtp_input" value="" />
                </div>
<?php }else{}?>