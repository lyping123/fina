<?php 
$servername = "sv94.ifastnet.com";
$username = "synergyc";
$password = "synergy@central";
$database = "synergyc_synergyedu";
$con = new mysqli($servername, $username, $password, $database);

if(isset($_GET["q"])){
    $qry="select * from students where id='$_GET[q]'";
    $sttr=mysqli_query($con,$qry);
    $result=mysqli_fetch_array($sttr);
    // '$result[s_name]','$result[s_email]','$result[ic]','$result[nationality]','$result[race]','$result[r_address]','$result[r_postcode]','$result[r_state]','$result[chinese_name]','$result[h_contact]','$result[hp_contact]','$result[guardian]','$result[birthday]','$result[gender]','$result[m_status]','$result[religion]','ACTIVE','".date('d-m-Y')."','$_SESSION[id]'
    $select="select * from student where ic='".$result['ic_no']."'";
    $sttr_select=mysqli_query($conn,$select);
    $num=mysqli_num_rows($sttr_select);

    if($num>0){
        $del="update students set status='REGISTER' where id='$_GET[q]'";
        mysqli_query($conn,$del);
        echo "remove";
    }else{
        $insert="insert into student(s_name,s_email,ic,nationality,race,r_address,r_postcode,r_state,chinese_name,h_contact,hp_contact,guardian,birthday,gender,m_status,religion,s_status,createdate,createby) values('$result[full_name]','$result[email]','$result[ic]','$result[nationality]','$result[race]','$result[r_address]','$result[r_postcode]','$result[r_state]','$result[chinese_name]','$result[h_contact]','$result[hp_contact]','$result[guardian]','$result[birthday]','$result[gender]','$result[m_status]','$result[religion]','ACTIVE','".date('d-m-Y')."','$_SESSION[id]')";
        if(mysqli_query($conn,$insert)){
            echo "success";
            $del="update students set status='REGISTER' where id='$_GET[q]'";
            mysqli_query($con,$del);
        }else{
            echo "fail";
        }
    }
}

if(isset($_GET["d"])){
    $del="update students set status='PAYMENT' where id='$_GET[d]'";
    // '$result[s_name]','$result[s_email]','$result[ic]','$result[nationality]','$result[race]','$result[r_address]','$result[r_postcode]','$result[r_state]','$result[chinese_name]','$result[h_contact]','$result[hp_contact]','$result[guardian]','$result[birthday]','$result[gender]','$result[m_status]','$result[religion]','ACTIVE','".date('d-m-Y')."','$_SESSION[id]'
    if(mysqli_query($con,$del)){
        echo "success";
    }else{
        echo "fail";
    }
}

?>