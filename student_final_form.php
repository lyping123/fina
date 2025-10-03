<?php 
include("include/include.php");
include("header.php");

if(isset($_POST['submit'])){
    $s_name = $_POST['s_name'];
    $group= json_encode($s_name);

    $p_title = $_POST['p_title'];
    
    $qry = "INSERT INTO student_final_form (s_name, p_title) VALUES ('$group', '$p_title')";
    if(mysqli_query($conn, $qry)){
        echo "<script>alert('Data inserted successfully');</script>";
    } else {
        echo "<script>alert('Error inserting data');</script>";
    }
    
}
$select = "SELECT * FROM student_final_form";
$sttr = mysqli_query($conn, $select);
$num = mysqli_num_rows($sttr);

?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Student Final Form</h3>
                </div>
                <div class="panel-body">
                    <form action="student_final_form.php" method="post">
                        <div class="form-group">
                           <label for="name">Student name</label>
                           <select class="selectpicker form-control" name="name" onchange="insertStudentGroup(this)" id="name" data-live-search="true">
                                 <?php 
                                 $qry="SELECT * FROM student WHERE s_status='ACTIVE'";
                                 $sttr=mysqli_query($conn,$qry);
                                 while($row=mysqli_fetch_array($sttr)){
                                      echo "<option value='".$row['s_name']."'>".$row['s_name']."</option>";
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="s_group">Student group</label>
                            <div id="s_group">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="p_title">Project title</label>
                            <input type="text" name="p_title" class="form-control" placeholder="Enter project title" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table id="example1" class="table table-bordred table-striped" style="width:100%">
            <thead>
                <th>Project title</th>
                <th>Student name</th>
                <th>action</th>
            </thead>
            <tbody>
                <?php 
                    while($row=mysqli_fetch_array($sttr)){
                        $s_name = json_decode($row['s_name']);
                        $s_name_str = implode(", ", $s_name);
                        echo "<tr>
                                <td>".$row['p_title']."</td>
                                <td>".$s_name_str."</td>
                                <td><button type='button' window.location.href='student_final_documentation.php?id=".$row['id']."' >view documentation </button></td>
                              </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function insertStudentGroup(selectbox) {
        let id=selectbox.value;
        let name=selectbox.querySelector(`option[value="${id}"]`);
        var s_group = document.getElementById("s_group");
        if(name){
            s_group.innerHTML+=`
                <ul>
                    <li><input type='hidden' name='s_name[]' value='${name.value}' />${name.innerHTML} <button type='button'>remove</button></li>
                </ul>
            `;
        }
        
    }
</script>

<?php 
include("footer.php");
?>