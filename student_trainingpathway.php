<?php
include("include/include.php");
include("header.php");

if(isset($_POST["submit"])){
    $target_dir = "trainingpathway/";
    $target_file = $target_dir."P".date("YmdHis").basename($_FILES["file"]["name"]);
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
        $reason="Sorry, only PDF files are allowed.";
        $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "<script>
           alert('Sorry, your file was not uploaded beacuese $reason');
        </script>";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
          //echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
          $array=array();
          foreach($_POST["student"] as $student){
            $array[]="('$student','$target_file')";
          }
          $new_sql=implode(",",$array);
    
          $qry="INSERT INTO `student_trainingpathway`(`s_id`, `attachment`) VALUES".$new_sql;
          if($str=mysqli_query($conn,$qry)){
            echo "<script>
                alert('add class schedules success');
              </script>";
          }else{
            echo "<script>
                alert('fail to add');
              </script>";
          }
        } else {
          //echo "Sorry, there was an error uploading your file.";
        }
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
    <div class="row">
        <div class="col-md-12">
            <form action="student_schedulesform.php" method="post" enctype="multipart/form-data">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Add Training pathway</h3>
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
                            <label>Training pathway document</label>
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
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>

<script>
    function addstudent(){
        let sel=document.getElementById("name").value;
        let name=$("option[value="+sel+"]").html();
        checkstudent(sel,name);
        
        
        //document.getElementById("studentul").innerHTML+="<li onclick='deleterow(this)' class='fas fa-envelope'>"+name+"<input type='hidden' value='"+sel+"' name='student[]' /></li>";
    }

    

    function deleterow(e){
        e.remove(e);
    }

    
    function checkstudent(id,name){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            //$this->sttr=this.responseTextl
            if(this.responseText=="true"){
                document.getElementById("studentul").innerHTML+="<li onclick='deleterow(this)' style='background-color:red;' class='fas fa-envelope'>"+name+"<input type='hidden' value='"+id+"' name='student[]' /></li>";
            }else{
                document.getElementById("studentul").innerHTML+="<li onclick='deleterow(this)' class='fas fa-envelope'>"+name+"<input type='hidden' value='"+id+"' name='student[]' /></li>";
            }
            
        }
        xhttp.open("GET", "checkstudent.php?q="+id, true);
        xhttp.send(); 
         
    }

    



</script>

