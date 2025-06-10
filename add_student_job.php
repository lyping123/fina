<?php 
include('include/db.php');
if(isset($_GET['action']) && $_GET['action'] == 'graduate'){
	$qry = "UPDATE student SET s_status = 'GRADUATE' ,graduated_date='".date('d-m-Y H:i')."',set_by=(select l_name from login where id='".$_SESSION['id']."') WHERE id = '".$_GET['id']."'";
    $select_qry="select * from student where id='".$_GET['id']."'";
    $sttr=mysqli_query($conn,$select_qry);
    $select_result=mysqli_fetch_array($sttr);
    $cid=0;
    if($select_result['course']=="Programming"){
        $cid=5;
    }elseif($select_result['course']=="Accounting"){
        $cid=1;
    }
    elseif($select_result['course']=="Networking"){
        $cid=4;
    }
    elseif($select_result['course']=="Electronic"){
        $cid=2;
    }
    elseif($select_result['course']=="Multimedia"){
        $cid=3;
    }
    $insert_qry="insert into job_tracer(c_id,s_name,s_contact,s_ic,j_status)values('".$cid."','".$select_result['s_name']."','".$select_result['hp_contact']."','".$select_result['ic']."','ACTIVE')";
    
		if($qry=mysqli_query($conn,$qry)){
            $result_sttr=mysqli_query($conn,$insert_qry);
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_del';
			</script>";
		}
}
if(isset($_GET['action']) && $_GET['action'] == 'graduatejob'){
	$qry = "UPDATE student SET s_status = 'GRADUATE' ,graduated_date='".date('d-m-Y H:i')."',set_by=(select l_name from login where id='".$_SESSION['id']."') WHERE id = '".$_GET['id']."'";
		if($result=mysqli_query($conn, $qry)){
            $result_sttr=mysqli_query($conn,$insert_qry);
			echo "<script>
			window.location.href = 'student_list.php?action=msg_success_del';
			</script>";
		}else{
			echo "<script>
			window.location.href = 'student_list.php?action=msg_fail_del';
			</script>";
		}
}


// select * from student where id in(766,769,770,765,777,748,775,762,771,767,764,778,785,780,781,779,784)

?>