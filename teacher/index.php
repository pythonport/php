<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
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
                      </tr>
                      </thead>
                     </table>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="teachers" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Select teacher</th>
                        <th>TID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Leave Type</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Select teacher</th>
                        <th>TID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Leave Type</th>
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
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/teacher/readTeacher.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                    "<td><input type='checkbox' name='teacherCheck' value='"+data[user].tid+"' id='teacherCheck' onchange='enableButton($(this).val())'/></td>"+
                "<td>"+data[user].tid+"</td>"+
                "<td>"+data[user].tname+"</td>"+
                "<td>"+data[user].designation+"</td>"+
                "<td><i class=\"fa fa-star text-danger\"></i><INPUT type='text' id='txt"+data[user].tid+"'/></td>"+
                "<td><a href='#' class='btn btn-primary disabled' id='btn"+data[user].tid+"' onClick=addLeave('"+data[user].tid+"')>Submit</a></td>"+
                //"<td>"+((data[user].gender == 0)? "Male": "Female")+"</td>"+
               // "<td>"+data[user].specialist+"</td>"+
                //"<td><a href='update.php?id="+data[user].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#teachers"));
        }
    });
  });
  function addLeave(tid){
      var leaveType = $('#txt' + tid).val();
      var leaveDate = $('#txtLeaveDate').val();
      var leaveDay = $('#leaveDaySelect').val();
      if(leaveType== "" || leaveDate == "" || leaveDay==""){
          alert("Leave type, Arrangement date and Leave Day are Mandatory!!");
          return false;
      } else {
          var result = confirm("Are you sure you want to add Leave Record?");
          if (result == true) {
              $.ajax(
                  {
                      type: "POST",
                      url: '../api/timetable/addLeaveRecord.php',
                      dataType: 'json',
                      data: {
                          tid: tid,
                          leaveDate : leaveDate,
                          leaveDay : leaveDay,
                          leaveType : leaveType
                      },
                      error: function (result) {
                          alert(result.responseText);
                      },
                      success: function (result) {
                          if (result['status'] == true) {
                              var btnName = "btn".concat(tid);
                              $('#' + btnName).text('Saved!');
                              $('#' + btnName).addClass("btn-success");
                              $('#' + btnName).removeClass("btn-danger");
                              $('#' + btnName).addClass("disabled");
                          }
                          else {
                              alert(result['message']);
                          }
                      }
                  });
          }
      }
  }

  function enableButton(checkid) {
      var btnName = "btn".concat(checkid);
      $('#' + btnName).removeClass("disabled");
      $('#' + btnName).addClass("btn-danger");
  }

  //datetime picker from jquery ui
  $( function() {
      $( "#txtLeaveDate" ).datepicker();
  } );
</script>