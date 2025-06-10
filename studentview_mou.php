<?php 
include("include/sinclude.php");
include("header_student.php");


if(isset($_GET["c_id"]) && $_GET["c_id"]!==""){
    $where="WHERE c_id='$_GET[c_id]'";
    $cid=$_GET["c_id"];
    if($cid==1){
        $colorh="purple";
        $colorb="#F78DFB";
        $img="accounting.png";
    }elseif($cid==2){
        $colorh="green";
        $colorb="#95F98D";
        $img="electronic.png";
    }elseif($cid==3){
        $colorh="yellow";
        $colorb="#F8FC80";
        $img="multimedia.png";
    }elseif($cid==4){
        $colorh="blue";
        $colorb="#84F6F6";
        $img="networking.png";
    }elseif($cid==5){
        $colorh="red";
        $colorb="#FFCEBE";
        $img="programming.png";
    }else{
        $colorh="white";
        $colorb="white";
    }

}else{
    $where="";
}

$qry="select * from mou ".$where." order by c_name";
$result = mysqli_query($conn,$qry);
$num=mysqli_num_rows($result);

?>


<style>
.picon{
    width: 80px;
    height: 80px;
    display: block;
    background-color: white;
    border-radius: 40px;
    transform: scale(1.5);
    border: 1px solid gray;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
img{
    width: 80%;
    width: 80%;

}
.table-head, .table-list{
    
    border-top-left-radius:20px;
    border-top-right-radius:20px;
}
.table-list{
    margin-top: 20px;
    border: 1px solid black;  
    background-color: #FFCEBE;
}

.table-res{
    padding: 10px;
    background-color: <?=$colorb?>;
}
.table-head{
    background-color: <?=$colorh?>;
    padding-bottom: 10px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h1 class="page-header">Company Information List</h1>
        </div>
       

        <div class="col-md-12 col-sm-12">
            <form action="" method="get">
            <div class="rows">
                <button type="submit" style='width:20px;height:20px;background-color:red' name="c_id" value="5"></button>
                    PROGRAMMING
                <button type="submit" style='width:20px;height:20px;background-color:yellow' name="c_id" value="3"></button>
                    MULTIMEDIA
                <button type="submit" style='width:20px;height:20px;background-color:green' name="c_id" value="2"></button>
                    ELECTRONIC 
                <button type="submit" style='width:20px;height:20px;background-color:blue' name="c_id" value="4"></button>
                    NETWORKING  
                <button type="submit" style='width:20px;height:20px;background-color:purple' name="c_id" value="1"></button>
                    ACCOUNTING
            </div>
            </form>
        </div>

        <div class="col-md-12 col-sm-12">
            <div id="moulist">
                <div class="table-list">
                    <div class="table-head">
                        <span class="picon" ><img src="images/<?=$img?>"  /></span>
                    </div>
                    
                    <div class="table-res">
                        <table id="example1" class="table table-bordred table-striped" >
                            <thead>
                                <th>Company Name</th>
                                <th>Company Address</th>
                                <th>Company Tel</th>
                                
                                <th>Name</th>
                                <th>Position</th>
                                <th>Tel</th>
                                <th>Email</th>
                                <th>Company website</th> 
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_array($result)){?>
                                <tr>
                                    <td><?=$row['c_name']?></td>
                                    <td><?=$row['c_address']?></td>
                                    <td><?=$row['c_tel']?></td>
                                    <td><?=$row['name']?></td>     
                                    <td><?=$row['position']?></td>
                                    <td><?=$row['tel']?></td>
                                    <td><?=$row['email']?></td>
                                    <td><a href="<?=$row["link"]?>" target="_blank" class="btn btn-primary"><i class="glyphicon glyphicon-link" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>