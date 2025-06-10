<?php 
include("include/db.php");
if(isset($_GET["id"])){
    $qry="select * from f_b_c where rs_id='".$_GET["id"]."'";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);

    $qry1="select * from f_receipt_student where id='$_GET[id]'";
    $sttr1=mysqli_query($conn,$qry1);
    $result1=mysqli_fetch_array($sttr1);

 ?>   

<div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                            <object data="<?=$result["account"]?>" type="application/pdf" width="900" height="500">
                                alt : <a href="<?=$result["account"]?>">test.pdf</a>
                            </object>
                        </div>
                        </div>
                        <br />
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Bank type</label>
                            <input type="text" name="b_type" id="b_type" class="form-control" value="<?=$result["banker"]?>" readonly />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>receipt submit date</label>
                            <input type="text" name="r_date" id="payment_date" class="form-control" value="<?=$result1["r_date"]?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Bank in date</label>
                            <input type="text" name="payment_date" id="payment_date" class="form-control" value="<?=$result["in_date"]?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Payment Reference</label>
                            <input type="text" name="payment_date" id="payment_date" class="form-control" value="<?=$result["payment_reference"]?>"  readonly />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <div style="padding: 19px 20px 20px;margin-top: 20px;   margin-bottom: 20px;background-color: #f5f5f5;border-top: 1px solid #e5e5e5;" class="form-group">
                      <div class="row">
                            <div class="col-lg-6">
                            <button type="submit" name="approve" value="<?=$result["rs_id"]?>" class="btn btn-success" name="submit">Approve</button>
                            </div>
                            <div class="col-lg-6">
                            <button type="submit" name="reject" value="<?=$result["rs_id"]?>" class="btn btn-danger" name="submit">reject</button>
                            </div>
                      </div>
                    </div>
                </div>



<?php 
}
?>