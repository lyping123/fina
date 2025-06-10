
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
<!--<script src="typeahead.js/bloodhound.min.js" type="text/javascript"></script>
<script src="typeahead.js/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="typeahead.js/typeahead.jquery.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" charset="UTF-8"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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
</body>

</html>
