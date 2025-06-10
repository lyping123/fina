<?php 
require('header.php');

// $qry="select * from agreement as a 
// inner join student as s on s.id=a.s_id 
// order by s.s_name
// ";
// $qry="select *,s.id as newid from student_detail as a 
// inner join student as s on s.id=a.s_id
// where a.s_status='ACTIVE' order by s.s_name";
$qry="SELECT * FROM student WHERE s_status='ACTIVE'";
$sttr=mysqli_query($conn,$qry);
?>
<div class="container">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Agreement
                <!--<small>Secondary Text</small>-->
                <button class="btn btn-success pull-right" data-title="Add" data-toggle="modal" data-target="#add"
                        type="button"><span class="glyphicon glyphicon-plus"></span> Add
                </button>
            </h1>


            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog" style="width:1000px">
                    <div class="modal-content">
                        <form method="post" action="add_agreement.php?action=add">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                            class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Add Checkout</h4>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label>Student</label><br>
                                           <select class="selectpicker" name="name" id="name" data-live-search="true" required>
						                    <option value="">Choose</option>
                                            <?php
                                            $s_qty = "SELECT s.id,s.s_name,st.s_id FROM student as s WHERE s.s_status <> 'DELETE'";
                                            $s_result = mysqli_query($conn, $s_qty);
                                            
                                            while($s_row = mysqli_fetch_array($s_result)){
                                                
                                            ?>
                                            <option value="<?=$s_row['id']?>"><?php echo $s_row['s_name'];?></option>
                                            <?php
                                            }
                                            ?>
						                    </select>
                                        </div>

                                        <div class="form-group">
                                            <label>College Handbook Agreement: </label>
                                            <a href="agrm_image.php?id=hostel_rulesenglish_version_.pdf" target="_blank" class="btn btn-primary">English Version </a>
                                            <a href="agrm_image.php?id=hostel_ruleschinese_version_.pdf" target="_blank" class="btn btn-primary">Chinese Version </a>
                                            <label>I confirm that I have read the contents of this handbook and acknowledge that I agree to abide with the College Rules and Regulations. I fully understand and agree that disciplinary action can be taken against me if I fail to observe the rules and regulations both expressed and implied. </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="ck" id="ck" value="1" />Agree
                                            <input type="radio" name="ck" id="ck" value="2" />Disagree
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" name="submit" style="width: 100%;"><span
                                            class="glyphicon glyphicon-ok-sign"></span>Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="example1" class="table table-bordered" style="width:100%">
                <thead>
                    <th>Student name</th>
                    <th>IC</th>
                    <th>Sign agreement</th>
                </thead>
                <tbody>
                    <?php while($result=mysqli_fetch_array($sttr)){ 
                        $select=mysqli_query($conn,"select read_status from agreement where s_id='".$result["newid"]."' AND a_type='handbook'");
                        $read=mysqli_fetch_array($select);
                        ?>
                        <tr>
                            <td><?=$result["s_name"]?></td>
                            <td><?=$result["ic"]?></td>
                            <td><? if($read[0]==1){echo "Agree";}elseif($read[0]==2){echo "Disagree";}else{echo "Not sign yet";} ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include("footer.php"); ?>
    
</div>

