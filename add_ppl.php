<?php 
include("include/db.php");
if(isset($_POST['submit'])&& $_POST['submit']=="save"){
    $qry="insert into lawatan_ppl(name,ic,c_num,email,address,c_id,s_date,e_date,comment,p_status,v_date,ppl_infor)values('".$_POST['pname']."','".$_POST['ic']."','".$_POST['cnum']."','".$_POST['email']."','".$_POST['address']."','".$_POST['course']."','".$_POST['sd']."','".$_POST['ed']."','".$_POST['comment']."','ACTIVE','$_POST[daterange]','$_POST[ppl_info]')";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        window.location.href='lawatan_ppl.php?action=msg_success_add'
        </script>";
    }else{
        echo "<script>
        window.location.href='lawatan_ppl.php?action=msg_fail_add'
        </script>";
        
    }
}

if(isset($_POST['edit'])&& $_POST['edit']=="edit"){
      $qry="update lawatan_ppl set name='".$_POST['pname']."',name='".$_POST['pname']."',ic='".$_POST['ic']."',c_num='".$_POST['cnum']."',email='".$_POST['email']."',address='".$_POST['address']."',c_id='".$_POST['course']."',s_date='".$_POST['sd']."',e_date='".$_POST['ed']."',comment='".$_POST['comment']."' ,v_date='".$_POST['daterange']."' ,ppl_infor='$_POST[ppl_info]'  where id='".$_GET['id']."'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        window.location.href='ppl_list.php?action=msg_success_edit'
        </script>";
    }else{
        echo "<script>
        window.location.href='ppl_list.php?action=msg_fail_addedit'
        </script>";
        
    }
}
if(isset($_GET['action'])&&$_GET['action']=="delete"){
    $qry="update lawatan_ppl set p_status='DELETE' where id='".$_GET['id']."'";
    if($sttr=mysqli_query($conn,$qry)){
        echo "<script>
        window.location.href='ppl_list.php?action=msg_success_del'
        </script>";
    }else{
        echo "<script>
        window.location.href='ppl_list.php?action=msg_fail_del'
        </script>";
        
    }
    
        
}
    

?>