<?php
require('include/db.php');
define('DATE_TODAY1', date('Y-m-d'));

if(!empty($_POST['v3']) && $_POST['v3'] == 1){
    $s_qty = "SELECT s.id,s_name FROM student AS s WHERE s.s_status = 'ACTIVE' AND s.course = '".$_POST['v1']."'";	
    $s_result = mysqli_query($conn, $s_qty);
    while($s_row = mysqli_fetch_array($s_result)){
    ?>
    <option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
    <?php
    }
}else{
    $level = " AND s.course = '".$_POST['v1']."' AND s.id NOT IN (SELECT sgl.s_id FROM student_group_list AS sgl INNER JOIN student_group AS sg ON sg.id = sgl.g_id WHERE sg.g_level = '".$_POST['v2']."' AND status = 'ACTIVE')";
    $s_qty = "SELECT s.id,s_name FROM student AS s WHERE s.s_status = 'ACTIVE'".$level;	
    $s_result = mysqli_query($conn, $s_qty);
    while($s_row = mysqli_fetch_array($s_result)){
        $s_qty1 = "SELECT * FROM student AS s
                    LEFT JOIN (SELECT sg.start_date, sg.end_date, sgl.s_id, sg.g_level FROM student_group AS sg
                                INNER JOIN student_group_list AS sgl ON sgl.g_id = sg.id
                                WHERE sgl.s_id = '".$s_row['id']."' AND sg.g_status = 'ACTIVE' AND sgl.status = 'ACTIVE' 
                                ORDER BY sg.g_level DESC LIMIT 1) AS ss ON ss.s_id = s.id
                                WHERE s.id = '".$s_row['id']."'";
        $s_result1 = mysqli_query($conn, $s_qty1);
        $s_row1 = mysqli_fetch_array($s_result1);
        if($s_row1['end_date'] < DATE_TODAY1 && ($s_row1['g_level'] != '4' && $s_row1['g_level'] != 'Single Tier')){
    ?>
    <option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
    <?php
        }
    }
    
}
?>