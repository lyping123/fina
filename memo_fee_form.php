<?php 
require('include/include.php');
require('header.php');

if(isset($_POST["submit"])){
    $insert="INSERT INTO `memo_fee`( `student`, `tuition_fee`, `e_fee`, `hostel_deposit`,`hostel_fee`, `internal_fee`) 
    values('$_POST[name]','$_POST[t_fee]','$_POST[e_fee]','$_POST[hostel_deposit]','$_POST[hostel]','$_POST[i_fee]')";
    if($sttr=mysqli_query($conn,$insert)){
        echo "<script>
            alert('Student Fee added success');
        </script>";
    }else{
        echo "<script>
            alert('Student Fee added fail');
        </script>";
    }
}

if(isset($_POST["edit"])){
    $update="UPDATE `memo_fee` SET `tuition_fee`='$_POST[t_fee]',`e_fee`='$_POST[e_fee]',`hostel_deposit`='$_POST[hostel_deposit]',`hostel_fee`='$_POST[hostel]',`internal_fee`='$_POST[i_fee]' where id='$_POST[edit]'";
    if($sttr=mysqli_query($conn,$update)){
        echo "<script>
            alert('Student Fee update success');
        </script>";
    }else{
        echo "<script>
            alert('Student Fee update fail');
        </script>";
    }
}

if(isset($_GET["action"]) && $_GET["action"]=="delete"){
    $delete="DELETE FROM `memo_fee` WHERE id='$_GET[id]'";
    if($sttr=mysqli_query($conn,$delete)){
        echo "<script>
            alert('Student Fee delete success');
        </script>";
    }else{
        echo "<script>
            alert('Student Fee delete fail');
        </script>";
    }
}
$t_fee="";
$e_fee="";
$h_fee="";
$hd_fee="";
$i_fee="";
$course="";
if(isset($_GET["action"]) && $_GET["action"]=="edit"){
    $qry="SELECT * FROM memo_fee where id='$_GET[id]'";
    $sttr=mysqli_query($conn,$qry);
    $result=mysqli_fetch_array($sttr);
    $t_fee=$result["tuition_fee"];
    $e_fee=$result["e_fee"];
    $h_fee=$result["hostel_fee"];
    $hd_fee=$result["hostel_deposit"];
    $i_fee=$result["internal_fee"];
    echo $course=$result["student"];
}

$select="select mf.*,s.s_name from memo_fee as mf inner join student as s on s.id=mf.student";
$sttr_se=mysqli_query($conn,$select);


?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header"> Student Fee List
            </h1>
        </div>
    </div>
    <div class="panel panel-info">
    <header class="panel-heading">
    <h3 class="panel-title">Add Studenmt Fee</h3>
    </header>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="memo_fee_form.php" >    
        <div class="col-md-12 ">
            <div class="form-group ">
            <label>Course</label>
            
            <select class="selectpicker form-control" name="name" id="name" data-live-search="true" required>
                <?php 
                    $qry="SELECT * FROM student where `s_status`='ACTIVE' ORDER BY s_name ";
                    $sttr=mysqli_query($conn,$qry);
                    while($result=mysqli_fetch_array($sttr)){
                       if($course==$result["id"]){
                        echo "<option selected='seclected' value='$result[id]'>$result[s_name]</option>";
                       }else{
                        echo "<option value='$result[id]'>$result[s_name]</option>";
                       }
                       
                    }
                ?>
                <option></option>
            </select>
            </div>
           <div class="form-group">
                <label>Tuition Fee</label>
                <input type="text" class="form-control" value="<?=$t_fee?>" name="t_fee" />
           </div>
           <div class="form-group">
                <label>ENROLLMENT Fee</label>
                <input type="text" class="form-control" value="<?=$e_fee?>" name="e_fee" />
           </div>
           <div class="form-group">
                <label>Hostel Deposit</label>
                <input type="text" class="form-control" value="<?=$hd_fee?>" name="hostel_deposit" />
           </div>
           <div class="form-group">
                <label>Hostel Fee</label>
                <input type="text" class="form-control" value="<?=$h_fee?>" name="hostel" />
           </div>
           <div class="form-group">
                <label>Internal Exam Fee</label>
                <input type="text" class="form-control" value="<?=$i_fee?>" name="i_fee" />
           </div>
           <div class="form-group">
                <?php 
                if(isset($_GET["action"]) && $_GET["action"]=="edit"){
                    echo "<button type='submit' name='edit' class='btn btn-success' value='$_GET[id]'>Edit</button>";
                    echo "<a href='memo_fee_form.php' style='margin-left:100px;' class='btn btn-primary' >Back to Add</a>";
                }else{
                ?>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <?php } ?>
           </div>
        </div>
        </div>
       </form>
    </div>
    <div class="row">
   
                <table id="example1" class="table table-bordred table-striped" style="width:100%">
                    <thead >
                     
                        <th>Student Name</th>
                        <th>Tuition Fee(RM)</th>
                        <th>Enrollment Fee(RM)</th>
                        <th>Hostel Deposit(RM)</th>
                        <th>Hostel Fee(RM)</th>
                        <th>Internal Fee(RM)</th>
                        <th>Action</th>
                    </thead>
                    <tbody >
                    <?php while($row = mysqli_fetch_array($sttr_se)){ ?>
                        <tr>                         
                            <td><?=$row['s_name']?></td> 
                            <td><?=$row['tuition_fee']?></td> 
                            <td><?=$row['e_fee']?></td> 
                            <td><?=$row['hostel_deposit']?></td> 
                            <td><?=$row['hostel_fee']?></td> 
                            <td><?=$row['internal_fee']?></td>

                            <td><div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown">Action<span class="caret"></span></button>
                      <ul class="dropdown-menu dropdown-menu">
                        <li><a href="memo_fee_form.php?action=edit&id=<?=$row['id']?>">Edit</a></li>
                        <li><a href="memo_fee_form.php?action=delete&id=<?=$row['id']?>">Delete</a></li>
                      </ul>
                    </div></td>
                        </tr>
                    <?php }?>
                    </tbody>
                
                </table>
             
    </div>
</div>
<?php include("footer.php"); ?>
</div>


