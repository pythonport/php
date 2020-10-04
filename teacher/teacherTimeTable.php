<?php
$content = '<div class="row">
                <!-- Drop down for teachers -->
                <div class="col-xs-12">
                     <label for="sel1">Select Teacher :</label>
                      <select class="form-control" id="teacherDrop">
                        <option>-- Select Teacher --</option>
                      </select>
                </div>
                
                <div class="col-xs-12">
                <!-- code to get Error Message -->
                <div class="text-danger text-bold"><lable id="errorlbl">Error Section : </lable></div>
                <!-- Teacher Time table -->
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title text-bold" id="timeTableHeader">Teachers Time Table</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="timetable" class="table table-bordered table-hover">
                      <thead>
                      <tr class="text-maroon">
                        <!--<th>TID</th>
                        <th>Name</th>
                        <th>Designation</th>-->
                        <th>DayNum</th>
                        <th>Day</th>
                        <th>POne</th>
                        <th>PTwo</th>
                        <th>PThree</th>
                        <th>PFour</th>
                        <th>PFive</th>
                        <th>PSix</th>
                        <th>PSeven</th>
                        <th>PEight</th>
                        <th>PNine</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr class="text-maroon">
                        <!--<th>TID</th>
                        <th>Name</th>
                        <th>Designation</th>-->
                        <th>DayNum</th>
                        <th>Day</th>
                        <th>POne</th>
                        <th>PTwo</th>
                        <th>PThree</th>
                        <th>PFour</th>
                        <th>PFive</th>
                        <th>PSix</th>
                        <th>PSeven</th>
                        <th>PEight</th>
                        <th>PNine</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';
include('../master.php');
?>
<!-- page script -->
<script>
    $(document).ready(function () {
        $.ajax({
            type: "GET",
            url: "../api/teacher/readTeacher.php",
            dataType: 'json',
            success: function (data) {
                var response = "";
                for (var user in data) {
                    response += "<option value=" + data[user].tid + ">" + data[user].tname + " - " +
                        data[user].designation + "</option>";
                }
                $(response).appendTo($("#teacherDrop"));
            }
        });
    });

    $("#teacherDrop").change(function () {
        var tid = $(this).val();
        $("#errorlbl").text(tid);
        $.ajax({
            type: "GET",
            url: "../api/timetable/readtimetable.php",
            dataType: 'json',
            data : {'tid':tid},
            success: function (data) {
                $('#timetable tbody').empty();
                if(data.toString().includes("Sorry No data", 0)){
                    $("#errorlbl").text(data.toString());
                    return false;
                }
                var response = "";
                for (var user in data) {
                    var lblValue = data[user].tname.concat(" - ").concat(data[user].designation);
                    $("#timeTableHeader").text("Teachers Time Table - ".concat(lblValue));
                    response += "<tr class='text-bold'>" +
                        "<td>" + data[user].daynum + "</td>" +
                        "<td>" + data[user].day + "</td>" +
                        "<td>" + data[user].pone + "</td>" +
                        "<td>" + data[user].ptwo + "</td>" +
                        "<td>" + data[user].pthree + "</td>" +
                        "<td>" + data[user].pfour + "</td>" +
                        "<td>" + data[user].pfive + "</td>" +
                        "<td>" + data[user].psix + "</td>" +
                        "<td>" + data[user].pseven + "</td>" +
                        "<td>" + data[user].peight + "</td>" +
                        "<td>" + data[user].pnine + "</td>" +
                        "</tr>";
                }
                $(response).appendTo($("#timetable"));
            }
        });
    });
</script>