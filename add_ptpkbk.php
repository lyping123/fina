<?php 
include("include/db.php");
if(isset($_POST['submit'])&& $_POST['submit']=="save"){
    $target_dir = "ptpk_attachment/";
    $array[]=$_FILES['file']['name'];
    $sqlfile="";

    foreach($array as $fname){
        $fname; break;
        $target_file = $target_dir . $fname;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file;
        $path_parts=pathinfo($target_file);
        if($_FILES['file']['name']!=""){
            $newfilename=$path_parts["filename"].date("ymdhis").".".$path_parts['extension'];
        }else{
            $newfilename="";
        }
        
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($newfilename!=""){
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$newfilename)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            } 
        }else{
            
        }
        
        if($sqlfile==""){
            $sqlfile=$newfilename;
        }else{
            $sqlfile+=','.$newfilename;
        }
        

    }

    break;
    $qry="Insert into ptpk_information(s_id,date,incomplete,complete,attachment,level,c_id,status)values('".$_POST['name']."','".$_POST['sd']."','".$_POST['d_icom']."','".$_POST['d_com']."','".$newfilename."','".$_POST['level']."','".$_POST['course']."','ACTIVE')";
    
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
            window.location.href='ptpk_list.php?action=msg_success_add'
        </script>";
    }else{
        echo "<script>
            window.location.href='ptpk_list.php?action=msg_fail_add'
        </script>";
    }
    
}
if(isset($_POST['edit']) && $_POST['edit']=='Edit'){
    $target_dir = "ptpk_attachment/";
    $array[]=basename($_FILES['file']['name']);
    foreach($array as $fname){
        echo $fname;
        $target_file = $target_dir . $fname;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file;
        $path_parts=pathinfo($target_file);
        if($_FILES['file']['name']!=""){
            $newfilename=$path_parts["filename"].date("ymdhis").".".$path_parts['extension'];
        }else{
            $newfilename="";
        }
        
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($newfilename!=""){
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$newfilename)) {
                echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            } 
        }else{
            
        }
    }
    

    
    $qry_update="update ptpk_information set attachment='".$newfilename."' ,s_id='".$_POST['name']."',date='".$_POST['sd']."',incomplete='".$_POST['d_icom']."',complete='".$_POST['d_com']."',level='".$_POST['level']."',c_id='".$_POST['course']."'where id='".$_GET['id']."'";
    if($sttr_update=mysqli_query($conn,$qry_update)){
        echo "<script>
            window.location.href='edit_ptpk.php?action=msg_success_edit&&id=".$_GET['id']."'
        </script>";
    }else{
        echo "<script>
            window.location.href='edit_ptpk.php?action=msg_fail_edit&&id=".$_GET['id']."'
        </script>";
    }
}

if(isset($_GET['action']) && $_GET['action']=='delete'){
    $qry_update="update ptpk_information set status='DELETE' where id='".$_GET['id']."'";
    if($sttr_update=mysqli_query($conn,$qry_update)){
        echo "<script>
            window.location.href='ptpk_list.php?action=msg_success_edit&&id=".$_GET['id']."'
        </script>";
    }else{
        echo "<script>
            window.location.href='ptpk_list.php?action=msg_fail_edit&&id=".$_GET['id']."'
        </script>";
    }
}

?>