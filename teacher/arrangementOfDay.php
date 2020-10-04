<?php
$content = '<div class="row">
                <!-- Drop down for teachers -->
                <div class="col-xs-12">
                     <table class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th><h3 class="box-title text-bold">Teachers List</h3></th>
                        <th>Select Data : <i class="fa fa-star text-danger"></i> 
                            <input type="text" class="text-bold" placeholder="dd-mm-yyyy" id="txtLeaveDate" data-date-format="dd-mm-yyyy"/></th>
                        <th>Select day : <i class="fa fa-star text-danger"></i>
                        <select class="input-small" id="leaveDaySelect">
                            <option value="">--Select Day--</option>
                            <option value="1">MONDAY</option>
                            <option value="2">TUESDAY</option>
                            <option value="3">WEDNESDAY</option>
                            <option value="4">THURSDAY</option>
                            <option value="5">FRIDAY</option>
                            <option value="6">SATURDAY</option>
                        </select>
                        </th>
                        <th><a href="#"  class="btn btn-primary" id="getTeacher" onClick="getTeachersTimeTable()">Submit</a></th>
                      </tr>
                      </thead>
                     </table>
                </div>
                
                <div class="col-xs-12">
                <!-- Teacher Time table -->
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title text-bold" id="timeTableHeader">Teachers On Leave</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="timetable" class="table table-bordered table-hover">
                      <thead>
                      <tr class="text-maroon">
                        <!--<th>TID</th>
                        <th>Name</th>
                        <th>Designation</th>-->
                        <th>TName</th>
                        <th>Designation</th>
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
                        <th>TName</th>
                        <th>Designation</th>
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

    });

    function getTeachersTimeTable(){
        var leaveDate = $('#txtLeaveDate').val();
        var leaveDay = $('#leaveDaySelect').val();
        $.ajax({
            type: "POST",
            url: "../api/timetable/getTeacherOnLeave.php",
            dataType: 'json',
            data: {
                leaveDate : leaveDate,
                leaveDay : leaveDay
            },
            success: function (data) {
                $('#timetable tbody').empty();
                if(data.toString().includes("Sorry No data", 0)){
                    $("#errorlbl").text(data.toString());
                    return false;
                }
                var response = "";
                for (var user in data) {
                    response += "<tr class='text-bold'>" +
                        "<td>" + data[user].tname + "</td>" +
                        "<td>" + data[user].designation + "</td>" +
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
    }

    //datetime picker from jquery ui
    $( function() {
        $( "#txtLeaveDate" ).datepicker();
    } );
</script>