<?php
include("include/include.php");
include("header.php");

if(isset($_POST["submit"])){
    $target_dir = "calendar/";
    $target_file = $target_dir ."R".date("YmdHis").basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
    
    $reason="";
    if (file_exists($target_file)) {
        $reason="Sorry, file already exists.";
        $uploadOk = 0;
      }
      
      // Check file size
      if ($_FILES["file"]["size"] > 500000000) {
        $reason="Sorry, your file is too large.";
        $uploadOk = 0;
      }
      
      // Allow certain file formats
      if($imageFileType!="pdf" ) {
        $reason="Sorry, only pdf files are allowed.";
        $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "<script>
        alert('Sorry, your file was not uploaded because $reason');
      </script>";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
          $array=array();
          foreach($_POST["student"] as $student){
            $select="SELECT * FROM student_calendar where s_id='$student'";
            $sttr_select=mysqli_query($conn,$select);
            $num_select=mysqli_num_rows($sttr_select);
            if($num_select>0){
              $qry="UPDATE student_calendar SET `img`= '$target_file' WHERE s_id='$student'";
              if($sttr_up=mysqli_query($conn,$qry)){
                  $updateStatus=true;
              }else{
                  $updateStatus=false;
              }
          }else{
            $array[]="('$student','$target_file')";
            $updateStatus=false;
          }
          }
          $new_sql=implode(",",$array);


          if($updateStatus==true){
            echo "<script>
                alert('calendar is updated success');
              </script>";
          }else{
            $qry="INSERT INTO `student_calendar`(`s_id`, `img`) VALUES".$new_sql;
            if(mysqli_query($conn,$qry)){
              echo "<script>
                  alert('add calendar success');
                </script>";
            }else{
              echo "<script>
                  alert('add calendar fail');
                </script>";
            }
          }
          
        
        } else {
         
        }
      } 
}

if(isset($_POST["delete"])){
    $select="SELECT * FROM student_calendar where id='$_POST[delete]'";
    $select_sttr=mysqli_query($conn,$select);
    $row=mysqli_fetch_array($select_sttr);


    $qry="DELETE FROM student_calendar where id='$_POST[delete]'";
    if($sttr=mysqli_query($conn,$qry)){
      unlink($row["img"]);
      echo "<script>
        alert('canlender deleted success');
      </script>";
      
    }else{
       echo "<script>
        alert('canlender deleted fail');
      </script>";
    }
}


?>
<div class="container">
    <style>
.styled-list {
  list-style: none;
  padding: 0;
 
}

.styled-list li {
    
  padding: 10px;
  display: flex;
  align-items: center;
}

.styled-list li i {
  margin-right: 10px;
}

.styled-list li i:before {
  font-size: 16px;
}

.styled-list li:hover {
  background-color: #f1f1f1;
  cursor: pointer;
}


    </style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="calenderform.php" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Add Calender to student</h3>
                </div>
                <div class="panel-body" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Student Name</label>
                          <select class="selectpicker form-control" onchange="addstudent();" name="name" id="name" data-live-search="true" required>
                              <option value="">Choose</option>
                              <?php
                              $s_qty = "SELECT id,s_name FROM student WHERE s_status ='ACTIVE' order by s_name";	
                              $s_result = mysqli_query($conn, $s_qty);
                              while($s_row = mysqli_fetch_array($s_result)){
                              ?>
                              <option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
                              <?php
                              }
                              ?>
								          </select>
                                </br>

                        </div>
                        <div class="form-group">
                            <label>Student calendar</label>
                            <input type="file" name="file" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Student include</label>
                               <ul class="styled-list" id="studentul">


                               </ul>
                            </div>
                        </div>
                </div>
                <div class="panel-footer">
                    <button type="submit" name="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php 
$qry="SELECT s.s_name,sc.img,course,sc.id FROM student s INNER JOIN student_calendar sc ON s.id=sc.s_id
WHERE s.s_status='ACTIVE' ORDER BY s.s_name";
$sttr=mysqli_query($conn,$qry);


?>

<div class="row">
    <div class="col-md-12">
      <div  class="table-responsive">
            <table id="example1" class="table table-bordered">
                  <thead>
                      <th>Student Name</th>
                      <th>Calendar document</th>
                      <th>Course</th>
                      <th>Action</th>
                  </thead>
                  <tbody>
                      <?php while($result=mysqli_fetch_array($sttr)){ ?>
                          <tr>
                            <td><?=$result["s_name"]?></td>
                            <td><a href="<?=$result["img"]?>" target="_blank"><?=$result["img"]?></a></td>
                            <td><?=$result["course"]?></td>
                            <form action="calenderform.php" method="post">
                            <td><button type="submit" class="btn btn-danger" name="delete" value="<?=$result["id"]?>">delete</button></td>
                            </form>
                          </tr>

                      <?php } ?>
                  </tbody>
            </table>
      </div>
    </div>
</div>
<?php include("footer.php"); ?>
</div>

<script>
    function addstudent(){
        let sel=document.getElementById("name").value;
        let name=$("option[value="+sel+"]").html();
        checkstudent(sel,name);
        
    }
    


    function deleterow(e){
        e.remove(e);
    }

    function checkstudent(id,name){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(this.responseText=="true"){
              document.getElementById("studentul").innerHTML+="<li class='lilist' onclick='deleterow(this)' style='background-color:red;' class='fas fa-envelope'>"+name+"<input class='litext' type='hidden'  value='"+id+"' name='student[]' /></li>";
            }else{
              document.getElementById("studentul").innerHTML+="<li class='lilist' onclick='deleterow(this)' class='fas fa-envelope'>"+name+"<input type='hidden' class='litext' value='"+id+"' name='student[]' /></li>";
            }
        }
        xhttp.open("GET", "checkstudent.php?c="+id, true);
        xhttp.send();
        
    }



</script>

