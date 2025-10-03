<?php 
include 'include/db.php';
$qry="SELECT * FROM student WHERE s_status='ACTIVE' ORDER BY s_name";
$sttr=mysqli_query($conn,$qry);
$num=mysqli_num_rows($sttr);
$no=1;

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Synergy portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/3-col-portfolio.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/styles.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'> -->
    <link rel='stylesheet' href='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.css'>

    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>
<body>
<div class="container">
    <div class="col-lg-12">
        <h1 class="page-header">Student List</h1>
    </div>
    <div class="row">
        	<div class="col-md-12">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordred table-striped" style="width:100%">
                        <thead>
                          
                          <th>Name</th>
                          <th>Home Address</th> 
                          <th>Contact(home)</th>
                        </thead>
                        <tbody>
                          <?php while($row=mysqli_fetch_array($sttr)){  ?>
                            <tr>
                                <td><?php echo $row['s_name']; ?></td>
                                <td><?php echo $row['r_address']; ?></td>
                                <td><?php echo $row['hp_contact']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>

    
</body>
    <script src="js/jquery.js"></script>
<!--<script src="typeahead.js/bloodhound.min.js" type="text/javascript"></script>
<script src="typeahead.js/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="typeahead.js/typeahead.jquery.min.js" type="text/javascript"></script>-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js'></script>
<script src='https://rawgit.com/adrotec/knockout-file-bindings/master/knockout-file-bindings.js'></script>
    <script  src="js/index.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" charset="UTF-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
$(document).ready(function() {
    $('#example').DataTable( {
		"order": [],
		
        dom: '<"toolbar">frtip',
        fnInitComplete: function(){
           $('div.toolbar').html('<b>For searching contact number the format is 012-xxxxxxx</b><br><b>For searching date the format is 20xx-xx-xx</b>');
         }
    } );
    $('#example1').DataTable( {
		"order": [],
    } );
    $('#example2').DataTable( {
		"order": [],
    } );
    $('#example3').DataTable( {
		"order": [],
    } );
    $('#example4').DataTable( {
		"order": [],
    } );
    $('#example5').DataTable( {
		"order": [],
    } );
    $('#example6').DataTable( {
		"order": [],
    } );
    $('#example7').DataTable( {
		"order": [],
    } );
    $('#example8').DataTable( {
		"order": [],
    } );
} );
</script>
<?php
/*$posts = '';
$sl_posts = '';
 $sql="SELECT s_name FROM student WHERE s_status = 'ACTIVE'"; 
 $sl_sql ="SELECT name_school FROM school_list WHERE status ='ACTIVE'";

$result=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($result)) 
	{ 
	$posts[] = $row['s_name'];
	} 
$sl_result=mysqli_query($conn,$sl_sql);
	while($sl_row=mysqli_fetch_array($sl_result)) 
	{ 
	$sl_posts[] = $sl_row['name_school'];
	} 
$product = json_encode($posts);
$sl_product = json_encode($sl_posts);*/
?>
    <!--<script>
	   jQuery(function () {
            /*** 1.基本示例 ***/
            var provinces = <?=$product?>;

            var substringMatcher = function (strs) {
                return function findMatches(q, cb) {
                    var matches, substrRegex;
                    matches = [];//定义字符串数组
                    substrRegex = new RegExp(q, 'i');
                    //用正则表达式来确定哪些字符串包含子串的'q'
                    $.each(strs, function (i, str) {
                    //遍历字符串池中的任何字符串
                        if (substrRegex.test(str)) {
                            matches.push({ value: str });
                        }
                    //包含子串的'q',将它添加到'match'
                    });
                    cb(matches);
                };
            };

            $('#my-input, #my-input1').typeahead({
                highlight: true,
                minLength: 1
            },
            {
                name: 'provinces',
                displayKey: 'value',
                source: substringMatcher(provinces),
				limit: 10
            });

        });
		</script>
         <script>
	   jQuery(function () {
            /*** 1.基本示例 ***/
            var provinces = <?=$sl_product?>;

            var substringMatcher = function (strs) {
                return function findMatches(ql, cb) {
                    var matches, substrRegex;
                    matches = [];//定义字符串数组
                    substrRegex = new RegExp(ql, 'i');
                    //用正则表达式来确定哪些字符串包含子串的'q'
                    $.each(strs, function (i, str) {
                    //遍历字符串池中的任何字符串
                        if (substrRegex.test(str)) {
                            matches.push({ value: str });
                        }
                    //包含子串的'q',将它添加到'match'
                    });
                    cb(matches);
                };
            };

            $('#my-input, #my-input2').typeahead({
                highlight: true,
                minLength: 1
            },
            {
                name: 'provinces',
                displayKey: 'value',
                source: substringMatcher(provinces),
				limit: 10
            });

        });
		</script>-->
    <!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
    
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
    $('.form_month').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 3,
		minView: 3,
		maxView: 1,
		forceParse: 0,
		pickerPosition: "top-left"
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });

    $(".form_year").datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 4,
		minView: 4,
		maxView: 4,
		forceParse: 0
    });
</script>

<script>
	function showHint(str) {
		if (str.length == 0) { 
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "ajax/result.php?q=" + str, true);
			xmlhttp.send();
		}
	}
</script>
<script>
	function showHint1(str) {
		if (str.length == 0) { 
			document.getElementById("txtHint1").innerHTML = "";
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "ajax/school_result.php?ql=" + str, true);
			xmlhttp.send();
		}
	}
</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('input[name="daterange"]').daterangepicker({
				//minDate: moment().add('days', 7)
						//minDate: moment().add('days', 7)
						maxDate: "31/12/<?=YEAR?>",
						isInvalidDate: function(date) {
							return (date.day() == 0 || date.day() == 6);
						},
						locale: {
							format: 'YYYY/MM/DD'
						}

			});
		});
	</script>

<script>
(function($){
	$(document).ready(function(){
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
/* http://www.bootply.com/nZaxpxfiXz */
</script>
</html>