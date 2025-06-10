<?php 
require('include/include.php');
require("header.php");

$qry="select * from saksi where id='$_GET[id]'";
$sttr=mysqli_query($conn,$qry);
$result=mysqli_fetch_array($sttr);

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="add_saksi.php?id=<?=$_GET["id"]?>" method="POST">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Add Saksi-saksi</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" name="name" class="form-control" value="<?=$result["p_name"]?>" />
                        </div>
                        <div class="form-group">
                            <label>School Name :</label>
                            <input type="text" name="s_name" class="form-control" value="<?=$result["school_name"]?>"  />
                        </div>
                        <div class="form-group">
                            <label>Area :</label>
                            <input type="text" name="area" class="form-control" value="<?=$result["area"]?>"  />
                        </div>
                        <div class="form-group">
                            <label>Jawatan :</label>
                            <input type="text" name="jawatan" class="form-control" value="<?=$result["position"]?>"  />
                        </div>
                        <div class="form-group">
                            <label>Telefon :</label>
                            <input type="text" name="phone" class="form-control" value="<?=$result["phone"]?>"  />
                        </div>
                        <div class="form-group">
                            <label>No K/P:</label>
                            <input type="text" name="ic" class="form-control" value="<?=$result["ic"]?>"  />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="btn_edit" >Submit</button>

                        <a class="btn btn-secondary" href="saksi_list.php" >Back</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<?php include("footer.php"); ?>
