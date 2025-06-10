<?php 
require('include/include.php');
require("header.php");


?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="add_saksi.php" method="POST">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Add Saksi-saksi</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" name="name" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label>School Name :</label>
                            <input type="text" name="s_name" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label>Area :</label>
                            <input type="text" name="area" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label>Jawatan :</label>
                            <input type="text" name="jawatan" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label>Telefon :</label>
                            <input type="text" name="phone" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label>No K/P:</label>
                            <input type="text" name="ic" class="form-control"  />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" name="btn_sub" >Submit</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<?php include("footer.php"); ?>
