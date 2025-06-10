<?php 
include("include/include.php");
include("header.php");

if(isset($_POST['submit'])){
    $query="insert into public_holiday(date,days,holidays)value('".$_POST['holiday_date']."','".$_POST['day']."','".$_POST['holiday']."')";
    if($sttr=mysqli_query($conn,$query)){
        echo "<script>alert('Add Holiday success')</script>";
    }
    else{
        echo "<script>alert('Please try againt')</script?";
    }
    
}

?>
<div class="container">
   <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Public Holiday
                    <!--<small>Secondary Text</small>-->
                </h1>
            </div>
        </div>
    <div class="panel panel-info">
        <header class="panel-heading">
            <h2 class="panel-title">Add Holiday</h2>
        </header>
        <div class="panel-body">
            <form action="add_holiday.php" method="post">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Holiday</label>
                        <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
<input class="form-control" size="16" onchange="showday(this.value)" type="text" value="" >
<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
</div>
<input type="hidden" name="holiday_date" id="dtp_input4" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Day</label>
                        <input readonly class="form-control" id="day" name="day" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>holiday</label>
                        <input class="form-control" name="holiday" value="" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-danger" name="submit" value="Add holiday" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    
   <?php 
include("footer.php");
?> 
</div>
<script>
    function showday(fulldate){
        var d=new Date(fulldate);
        
        var weekday = new Array(7);
        weekday[0] =  "Sun";
        weekday[1] = "Mon";
        weekday[2] = "Tues";
        weekday[3] = "Wed";
        weekday[4] = "Thur";
        weekday[5] = "Fri";
        weekday[6] = "Sat";
        
        var n = weekday[d.getDay()];
        
        //alert(fulldate);
        if(showday!==""){
            document.getElementById("day").value=n;
        }else{
            
        }
    }
</script>
