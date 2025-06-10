<?php 
include("include/db.php");
if(isset($_POST['submit'])){
    $pro="no";
    $acc="no";
    $mul="no";
    $elc="no";
    $net="no";
    if(isset($_POST['pro'])){
        $pro="yes";
    }
     if(isset($_POST['mul'])){
        $mul="yes";
    }
     if(isset($_POST['acc'])){
        $acc="yes";
    }
     if(isset($_POST['net'])){
        $net="yes";
    }
     if(isset($_POST['elc'])){
        $elc="yes";
    }
     if(isset($_POST['all'])){
        $pro="yes";
        $acc="yes";
        $mul="yes";
        $elc="yes";
        $net="yes";
    }
    $qry="insert into mou(c_name,c_address,c_tel,name,position,tel,email,link,pro,mul,acc,elc,net,c_id,s_date,e_date) 
    values('".$_POST['c_name']."','".$_POST['c_address']."','".$_POST['c_tel']."','".$_POST['name']."','".$_POST['position']."','".$_POST['tel']."','".$_POST['email']."','".$_POST['c_link']."','".$pro."','".$mul."','".$acc."','".$elc."','".$net."','".$_POST['course']."','$_POST[register_in]','$_POST[register_out]')";
    if($insert=mysqli_query($conn,$qry)){
        echo "<script>
            window.location.href='mou.php?action=msg_success_add&&btn_0=ALL'
        </script>";
    }
    else{
        echo "<script>
            window.location.href='mou.php?action=msg_fail_add&&btn_0=ALL'
        </script>";
    }
    
}
if(isset($_POST['edit'])){
    $pro="no";
    $acc="no";
    $mul="no";
    $elc="no";
    $net="no";
    if(isset($_POST['pro'])){
        $pro="yes";
    }
     if(isset($_POST['mul'])){
        $mul="yes";
    }
     if(isset($_POST['acc'])){
        $acc="yes";
    }
     if(isset($_POST['net'])){
        $net="yes";
    }
     if(isset($_POST['elc'])){
        $elc="yes";
    }
    echo $qry_edit="update mou set c_name='".$_POST['c_name']."',link='".$_POST['c_link']."',c_address='".$_POST['c_address']."',c_tel='".$_POST['c_tel']."',name='".$_POST['name']."',position='".$_POST['position']."',tel='".$_POST['tel']."',email='".$_POST['email']."',pro='".$pro."',mul='".$mul."',acc='".$acc."',elc='".$elc."',net='".$net."',c_id='".$_POST['course']."',s_date='$_POST[register_in]',e_date='$_POST[register_out]' where ID='".$_GET['id']."'";
    if($sttr_edit=mysqli_query($conn,$qry_edit)){
        echo "<script>
            window.location.href='mou.php?action=msg_success_edit&&btn_0=ALL'
        </script>";
    }
    else{
        echo "<script>
            window.location.href='mou.php?action=msg_fail_edit&&btn_0=ALL'
        </script>";
    }
}
if(isset($_GET['action']) && $_GET['action']=="delete"){
    $qry_delete="delete from mou where id='".$_GET['id']."'";
    if($result=mysqli_query($conn,$qry_delete)){
         echo "<script>
            window.location.href='mou.php?action=msg_success_del&&btn_0=ALL'
        </script>";
        
    }
    else{
       echo "<script>
            window.location.href='mou.php?action=msg_fail_del&&btn_0=ALL'
        </script>"; 
    }
}
?>