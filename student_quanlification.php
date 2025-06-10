<?php 
include("include/include.php");
include("header.php");

if(isset($_POST["s_selector"])){
    $names=implode(",",$_POST["student"]);
    $insert="INSERT INTO selector_name(selector_name,selector_id) VALUES('$_POST[selected_name]','$names')";
    if($sttr=mysqli_query($conn,$insert)){
        echo "<script>
        alert('selector saveing success');
        </script>";
    }else{
        echo "<script>
        alert('selector saveing fail');
        </script>";
    }
}
$selector="";
$qt_selector="";
if(isset($_GET["selector"]) && $_GET["selector"]!==""){
    $qry="SELECT * FROM selector_name WHERE id='$_GET[selector]'";
    $sttr=mysqli_query($conn,$qry);
    $row=mysqli_fetch_array($sttr);
    $selector=" AND s.id IN ($row[selector_id])";
    $qt_selector=" WHERE s.id IN ($row[selector_id])";
}

$qry="SELECT 
    s.id AS student_id,
    IF(syllabus IN ('BAHASA MELAYU', 'SEJARAH/HISTORY') AND result ='G',0,1) as gradestatus,

    SUM(
        CASE 
            WHEN  
                result IN ('A','A+','A-') 
            THEN 1 ELSE 0 
        END
    ) AS total_a_grades,
    SUM(
        CASE 
            WHEN  
                result = 'G' 
            THEN 1 ELSE 0 
        END
    ) AS total_G_grades,
    IF(
     SUM(
        CASE 
            WHEN  
                result IN ('A','A-','A+','B+','B','C','C+') 
            THEN 1 ELSE 0 
        END
    )>2,1,0)AS total_two_credit_grades,
    IF(
     SUM(
        CASE 
            WHEN  
                result IN ('A','A-','A+','B+','B','C','C+') 
            THEN 1 ELSE 0 
        END
    )>3,1,0)AS total_threes_credit_grades,
    IF(
        COUNT(r.s_id) = 0, 
        1, 
        0
    ) AS did_not_take_exam
    
FROM 
    student s
LEFT JOIN 
    result r ON r.s_id = s.id
WHERE 
    s.s_status = 'ACTIVE' $selector
GROUP BY 
    s.id
";

$sttr=mysqli_query($conn,$qry);
$seactionA=0;
$seactionB=0;
$seactionC=0;
$seactionD=0;
$seactionE=0;
$seactionF=0;
$total=0;
while($result=mysqli_fetch_array($sttr)){
    $seactionA+=($result["gradestatus"]==1 && $result["total_a_grades"]>=1)? 1:0;
    $seactionB+=($result["gradestatus"]==1 && $result["total_G_grades"]>=3)? 1:0; 
    $seactionC+=($result["gradestatus"]==1 && $result["total_two_credit_grades"]==1)? 1:0; 
    $seactionD+=($result["gradestatus"]==1 && $result["total_threes_credit_grades"]>=3)? 1:0; 
    $seactionE+=$result["gradestatus"]==0? 1:0;
    $seactionF+=$result["did_not_take_exam"];
    $total++;
}

?>

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
<div class="container">
    <div class="row">
        <form action="student_quanlification.php" method="post">
        <div class="col-md-3">
            <label for="">Select student</label>
            <select onchange="addstudent()" class="selectpicker form-control" name="name" id="name" data-live-search="true" required>
                <option value="">Choose</option>
                <?php 
                $select="SELECT * FROM student where s_status='ACTIVE' ORDER BY s_name";
                $sttr=mysqli_query($conn,$select);
                while($result=mysqli_fetch_array($sttr)){
                    echo "<option value='$result[id]' >$result[s_name]</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" name="selected_name" require ><button name="s_selector">save selector</button>
            <div class="form-group">
                <br>
                <label>Student include</label>
                    <ul class="styled-list" id="studentul">

                </ul>
                </div>
            </div>
        </div>
        </form>
    
    
    <div class="row">
        <div class="heading">
            <h1>Student quanlification summary</h1>
        </div>
    </div>
    <div class="row">
        <form action="" method="get">

        
        <div class="col-md-3">
            <select name="selector" class="form-control" >
                <option value="">Choose</option>
                <?php 
                $select="SELECT * FROM selector_name";
                $sttr=mysqli_query($conn,$select);
                while($row=mysqli_fetch_array($sttr)){
                ?>
                <option value="<?=$row["id"]?>"><?=$row["selector_name"]?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="filter">filter</button>
        </form>
    </div>            
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordred table-striped">
                <thead>
                    <th>Passesd and how many A</th>
                    <th>Passesd only then many fail</th>
                    <th>Passesd only with 2 credit</th>
                    <th>Passesd only with 3 credit</th>
                    <th>Fail</th>
                    <th>did not take spm</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$seactionA?></td>
                        <td><?=$seactionB?></td>
                        <td><?=$seactionC?></td>
                        <td><?=$seactionD?></td>
                        <td><?=$seactionE?></td>
                        <td><?=$seactionF?></td>
                    </tr>
                    <tr>
                        <td>TOTAL STUDENT:</td>
                        <td colspan="5"><?=$total?></td>
                    </tr>
                </tbody>
            </table>
        </div>	
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordred table-striped">
                <thead>
                    <th>Student Name</th>
                    <th>Grade A(A+,A,A-)</th>
                    <th>Grade B(B+,B)</th>
                    <th>Grade C(C+,C)</th>
                    <th>Grade D</th>
                    <th>Grade E</th>
                    <th>Grade G</th>
                </thead>
                <tbody>
                    <?php 
                    $query="SELECT 
                    s.s_name,
                    SUM(CASE WHEN result IN ('A','A-','A+') THEN 1 ELSE 0 END) AS gradeA, 
                    SUM(CASE WHEN result IN ('B','B+') THEN 1 ELSE 0 END) AS gradeB, 
                    SUM(CASE WHEN result IN ('C','C+') THEN 1 ELSE 0 END) AS gradeC, 
                    SUM(CASE WHEN result = 'D' THEN 1 ELSE 0 END) AS gradeD, 
                    SUM(CASE WHEN result = 'E' THEN 1 ELSE 0 END) AS gradeE, 
                    SUM(CASE WHEN result = 'G' THEN 1 ELSE 0 END) AS gradeG 
                    FROM student s
                    LEFT JOIN result r on r.s_id=s.id
                    $qt_selector 
                    GROUP BY s.id, s.s_name";
                    $sttr=mysqli_query($conn,$query);
                    while($row=mysqli_fetch_array($sttr)){
                    ?>
                    <tr>
                        <td><?=$row["s_name"]?></td>
                        <td><?=$row["gradeA"]?></td>
                        <td><?=$row["gradeB"]?></td>
                        <td><?=$row["gradeC"]?></td>
                        <td><?=$row["gradeD"]?></td>
                        <td><?=$row["gradeE"]?></td>
                        <td><?=$row["gradeG"]?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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
                document.getElementById("studentul").innerHTML+="<li onclick='deleterow(this)' class='fas fa-envelope'>"+name+"<input type='hidden' value='"+id+"' name='student[]' /></li>";
            
            
        }
        xhttp.open("GET", "checkstudent.php?q="+id, true);
        xhttp.send(); 
         
    }
</script>
