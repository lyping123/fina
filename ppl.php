<?php
require('include/db.php');

if(isset($_GET['value'])){
    
    $c_qry = "SELECT distinct `name`,`ic`,`c_num`,`email`,`address`,c_id,comment FROM lawatan_ppl WHERE `name` = '$_GET[value]'";
    $c_result = mysqli_query($conn,$c_qry);
    
    //$myobj=array();
    while($c_row=mysqli_fetch_array($c_result)){
        // $myobj->ic=$c_row["ic"];
        // $myobj->cnum=$c_row["c_num"];
        // $myobj->email=$c_row["email"];
        // $myobj->address=$c_row["address"];
        // $myobj[]=$c_row["ic"];
        // $myobj[]=$c_row["c_num"];
        // $myobj[]=$c_row["email"];
        // $myobj[]=$c_row["address"];
        //$myobj->pname=$c_row["name"];
        $course="";
        if($c_row["c_id"]=="1"){
            $course="Accounting";
        }elseif($c_row["c_id"]=="2"){
            $course="Electronic";
        }elseif($c_row["c_id"]=="3"){
            $course="Multimedia";
        }elseif($c_row["c_id"]=="4"){
            $course="Networking";
        }elseif($c_row["c_id"]=="5"){
            $course="Programming";
        }
         $data = array(
            "ic"     => $c_row["ic"],
            "cnum"  => $c_row["c_num"],
            "email"   => $c_row["email"],
            "address"      => $c_row["address"],
            "course"      => $c_row["c_id"],
            "comment"     =>$c_row["comment"]
        );
    }
    echo $myJSON = json_encode($data);
    
}

if(isset($_POST["search"])){
    
    $course=$_POST["course"];
    if(!empty($_POST["search"])){
        $search="where l.$course like'%".$_POST['search']."%'";
    }else{
        $search="";
    }

    $c_qry = "select * from lawatan_ppl as l inner join course as c on c.id=l.c_id ".$search." order by e_date DESC";
    $c_result = mysqli_query($conn,$c_qry);
    //$myobj=array();
    $td="";
    
    while($row=mysqli_fetch_array($c_result)){
        $button1="<td><div class='btn-group'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> Action <span class='caret'></span>
        </button>";
        $button2="<ul class='dropdown-menu  dropdown-menu-right'>
        <li><a href='edit_ppl.php?id=$row[0]'> Edit </a></li>
        <li><a href='add_ppl.php?id=$row[0]&action=delete' onclick='return confirm('Confirm to Delete this Record?')'> Delete </a></li>
    </ul>
</div></td>";
       $td.="<tr>
        <td>$row[name]</td>
        <td>$row[ic]</td>
        <td>$row[c_num]</td>
        <td>$row[email]</td>
        <td>$row[address]</td>
        <td>$row[course]</td>
        <td>$row[s_date]</td>
        <td>$row[e_date]</td>
        <td>$row[v_date]</td>
        ".$button1.$button2."
        </tr>
        </tr>
        <tr><td colspan='10'>Comment : <span style='color:#3c763d;'>$row[comment]</span></td></tr>
        <tr><td colspan='10'>PPL Information:  <span style='color:#3c763d;'>$row[ppl_infor]</span></td></tr>
        ";

    }
    echo $td;
    
}


?>