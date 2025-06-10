<?php 
include("include/db.php");
if(isset($_POST['submit'])&& $_POST['submit']=="save"){
    $target_dir = "ptpk_attachment/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $target_file;
    $path_parts=pathinfo($target_file);
    
    //echo $_FILES["file"]["tmp_name"];break;
    if($_FILES['file']['name']<>""){
        $newfilename=$path_parts["filename"].date("ymdhis").".".$path_parts['extension'];
    }else{
        $newfilename="";
    }
    
    if (file_exists($newfilename)) {
        echo "<script>alert('Sorry, file already exists.');window.location.href='ptpk_list.php'</script>";
        $uploadOk = 0;break;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');window.location.href='ptpk_list.php'</script>";
        $uploadOk = 0;break;
    }
    if($newfilename!=""){
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$newfilename)) {
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        } 
    }else{
        
    }

    
    $qry="Insert into ptpk_information(s_id,date,incomplete,complete,attachment,level,c_id,status)values('".$_POST['name']."','".$_POST['sd']."','".$_POST['d_icom']."','".$_POST['d_com']."','".$newfilename."','".$_POST['level']."','".$_POST['course']."','ACTIVE')";
    
    if($sttr=mysqli_query($conn,$qry)){
        echo $lastid=mysqli_insert_id($conn);
        $insert=mysqli_query($conn,"insert into ptpk_document(document,date,d_id) values('$newfilename','".$_POST["sd"]."','$lastid')");
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
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
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