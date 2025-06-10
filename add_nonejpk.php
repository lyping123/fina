<?php 
include("include/include.php");
include("header.php");

if(isset($_POST["submit"])){
    $insert="insert into none_jpk(`s_name`,`s_ic`,`course`,`s_status`) values('$_POST[name]','$_POST[s_ic]','$_POST[course]','ACTIVE')";
    if(mysqli_query($conn,$insert)){
        echo "<script>
            alert('add success');
            //window.location.href='add_nonejpk.php';
        </script>
        ";
    }else{
        echo "<script>
            alert('add fail');
            //window.location.href='add_nonejpk.php';
        </script>
        ";
    }
}

?>

<div class="container">
<form action="add_nonejpk.php" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>None jpk</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                    <div class="form-group">
                        <select class="selectpicker" name="name" id="name" data-live-search="true" required>
							<option value="">Choose</option>
							<?php
							$s_qty = "SELECT * FROM student";	
							$s_result = mysqli_query($conn, $s_qty);
							while($s_row = mysqli_fetch_array($s_result)){
							?>
							<option value="<?=$s_row['id']?>"><?=$s_row['s_name']?></option>
							<?php
							}
							?>
						</select>
                    </div>
                    <div class="form-group">
                        <label>IC</label>
                        <input type="text" name="s_ic" class="form-control" value="" id="s_ic" />
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <input type="text" name="course" class="form-control" value="" id="course" />
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary" value="" >submit</button>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</form>
<?php 
require("footer.php");
?>

<script>
$('#name').on('change', function(){
		var selected = $(this).find("option:selected").val();
		//alert(selected);
			//use ajax to run the check  
		$.post("student_detail.php", { id: selected },  
			function(result){ 
                const obj = JSON.parse(result);
				$("#s_ic").val(obj.ic);
                $("#course").val(obj.course);
			});  
});
</script>