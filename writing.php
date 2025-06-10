<?php 
include("header.php");

$conn=new mysqli("localhost","root","","online_class");
$qry="select * from namelist";
$sttr=mysqli_query($conn,$qry);
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <input type="text" name="search" id="search" onkeyup="loaduser(this.value)"  />
        </div>
        <div class="col-md-12">
            <table class="table table-condensed" style="border-collapse:collapse;">
                <thead>
                    <th>Name</th>
                    <th>Gender</th> 
                    <th>Age</th> 
                    <th>Date Join</th> 
                <thead>
                <tbody id="tbody">
                    <?php 
                    while($result=mysqli_fetch_array($sttr)){
                    ?>
                    <tr>
                        <td><?=$result["s_name"]?></td>
                        <td><?=$result["gender"]?></td>
                        <td><?=$result["age"]?></td>
                        <td><?=$result["date_join"]?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function loaduser(str){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tbody").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "ajax_function.php?value="+str, true);
        xhttp.send();
    }

</script>

<?php 
include("footer.php");
?>