<?php 
include("header.php");

?>
<style>
td.details-control {
    background: url('img/icon/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('img/icon/details_close.png') no-repeat center center;
}
</style>

<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Referral List
            <!--<small>Secondary Text</small>-->
            
        </h1>
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <table id="pre_register" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Submited date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php 
include("footer.php");
?>



<script>
function format ( d ) {
return new Promise((resolve, reject) => {
    $.ajax({
        url: "ajax/load_referee.php",
        type: "POST",
        data: {id:d.id},
        success: function(data){
            try {
                    var obj = JSON.parse(data); 

                    let table = "<table width='100%'>";
                    table+="<tr><td colspan='5'><span style='font-weight:bold;'>Referee list</span></td></tr>";
                    obj.forEach(function (item) {
                        table += "<tr><td conspan=2>"+item.id+"</td><td>" + item.s_name + "</td><td>" + item.phone_number + "</td><td>" + item.date_submit + "</td></tr>";
                    });
                    table += "</table>";
                    resolve(table); // Resolve with the formatted table
                } catch (e) {
                    reject("Error parsing JSON data: " + e.message);
                }
        },
        error: function (xhr, status, error) {
            reject("Error loading data: " + error);
        }
    });
});

// `d` is the original data object for the row

}
    $(document).ready(function() {
        var table = $('#pre_register').DataTable( {
            "ajax": "ajax/load_referral.php",
            "columns": [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { "data": "id" },
                { "data": "s_name" },
                { "data": "phone_number" },
                { "data": "date_submit" },

            ],
            "order": [[1, 'desc']]
        });
        $('#pre_register tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {

            // Open this row
            format(row.data()).then(function (table) {
            // Replace the loading message with the actual table content
                row.child(table).show();
                tr.addClass('shown');
            }).catch(function (error) {
                // Handle error, show error message
                row.child('<div>Error loading data: ' + error + '</div>').show();
            });
        }
    } );
    $('#pre_register tbody').on('click', 'button', function () {
        var data = table.row($(this).parents('tr')).data();
        //alert(data[5]);
    } );
    });
</script>


