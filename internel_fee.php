<?php 
include("include/db.php");
$qry="SELECT *, stu.course as new_course FROM student AS stu
      LEFT JOIN (SELECT sg1.g_level, tt.s_id, sg1.g_name , sg1.start_date as s_date, sg1.end_date as e_date , sg1.c_id as c_id
                FROM student_group_list AS tt
                INNER JOIN student_group AS sg1 on sg1.id = tt.g_id
                INNER JOIN
                    (SELECT MAX(sg.g_level) AS g_level, sgl.id, sgl.s_id FROM student_group_list AS sgl
                    INNER JOIN student_group AS sg on sg.id = sgl.g_id
                    WHERE sgl.status = 'ACTIVE'  GROUP BY sgl.s_id) groupedtt ON tt.s_id = groupedtt.s_id 
                WHERE sg1.g_level = groupedtt.g_level AND tt.status = 'ACTIVE') AS sgll ON sgll.s_id = stu.id
	  WHERE stu.s_status = 'ACTIVE'
	  ORDER BY stu.s_name ASC";
$sttr=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($sttr)){

    $newDate = date("d-m-Y", strtotime($row["s_date"]));
    $endDate = date("d-m-Y", strtotime($row["e_date"]));
    $sec_t=date('d-m-Y');
    
    $split1=explode("-",$newDate);
    $split2=explode("-",$sec_t);


     $total_d=$split1[0]-$split2[0];
     $total_m=$split1[1]-$split2[1];
     $total_y=$split1[2]-$split2[2];
    
    $course=$row['c_id'];
    
    $level=$row['g_level'];
    
    /*echo $sec_t."=";
    echo $endDate."<br>";*/
    
    if($course==1 || $course==4){
        $intout=150;
    }
    else{
        $intout=100;
    }
    
    if($level=="Single Tier"){
        if($total_d==0 && $total_m==0 && $total_y<0){
            $insert="update student set int_outstanding=int_outstanding+".$intout." where id='".$row[0]."'";
            $result=mysqli_query($conn,$insert);
        
        }
    }
    
    else{
        
        if($sec_t==$endDate){
            
            $insert="update student set int_outstanding=int_outstanding+".$intout." where id='".$row[0]."'";
            $result=mysqli_query($conn,$insert);
        }
    }
    
    
}


?>