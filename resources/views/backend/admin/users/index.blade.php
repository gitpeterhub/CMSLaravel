@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Users</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/jquery.dataTables.min.css')}}"> -->
<link rel="stylesheet" type="text/css" href="{{asset('css/customize-datatable.css')}}">
<link rel="stylesheet" href="{{asset('plugins/sweetalert/sweetalert.css')}}">
<style type="text/css">

   /* table.dataTable.select tbody tr,
    table.dataTable thead th:first-child {
    cursor: pointer;
    }*/



    #imagePreview {
        width: 150px;
        height: 150px;
        background-position: center center;
        background-size: cover;
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
        display: inline-block;
        margin-bottom: 10px;
    }
</style>
  
@endsection
@section('contents')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>13 New Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User Management</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
         @if(Session::has('message'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong id="site-message">
                  <p>{{Session::get('message')}}</p>
                </strong>
            </div>
            {{Session::forget('message')}}
          @endif
      <!-- Datatable row starts -->
        <div class="row">
            <div class="col-md-12">
              <a class="btn btn-success sign-up-btn pull-right" href="#" data-toggle="modal" data-target="#at-signup-filling">
            Add User</a>
                <button class="btn btn-warning">Add Role</button>
                <form id="frm-example" action="/path/to/your/script" method="POST">
                <table border="1" cellpadding="1" cellspacing="1" id="users" class="table table-bordered table-hover" width="100%">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1"></th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                    </tfoot>
                </table>
            </form>
            </div>
        </div>
        <!-- Datatable row ends -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./Content Wrapper-->

  <!-- Add User Modal -->
<div class="modal fade" id="at-signup-filling" tabindex="-1" role="dialog" aria-labelledby="at-signup-filling">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <img src="{{url('img/logo.png')}}" alt="newpark- logo">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"
                                                                                               aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Create User Account</h4>
                <div id="signup-error-box" class="hide">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <strong id="signup-error-msg"></strong>
                    </div>
                </div>
                <form class="os-global-form" id="signup-form" action="{{url('admin/users/')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label new-label" for="full_name">Full Name</label>
                        <input class="form-control" id="name" name="name" type="text" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label new-label" for="email">Email</label>
                        <input class="form-control" name="email" id="email" type="email" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label new-label" for="username">Username</label>
                        <input class="form-control" name="username" id="username" type="text" required="required">
                    </div>

                    <div class="form-group">
                        <label class="control-label new-label" for="password">Password</label>
                        <input class="form-control" name="password" type="password" id="password" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label new-label" for="password">Confirm Password</label>
                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>    
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label new-label" for="account-type">Type of Account</label>

                        <div class="radio">
                        <label class="radio-inline">
                          <input type="radio" name='user_type' value="3"> User

                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="user_type" value="4"> Resident
                        </label>
                        </div>
                    </div> -->
                    <div class="form-group" >
                        <div id="imagePreview">
                            
                        </div>
                        <br/>
                        <label class="control-label new-label" for="photo">
                        <input style="display: none" name="photo" type="file" id="photo">
                        <span class="btn btn-primary" id="photo-button">Choose Photo</span>
                        </label>
                        
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submitted" class="btn btn-login">Register
                    </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="ta-l sign-up-center">Already a Member?
                            <button class="btn btn-gst" data-toggle="modal" data-dismiss="modal" data-target="#myModal">
                                Login
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  @endsection

@section('scripts')

<!-- Sweet alert -->
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>


<script>

  $('.users').siblings().removeClass('active');
  $('.users').addClass('active');


  //preview photo before submit
 $("#photo").on("change", function(){
    console.log('hey');
   var files = !!this.files ? this.files : [];
 if (!files.length || !window.FileReader) return; // Check if File is selected, or no FileReader support

   if (/^image/.test( files[0].type)){ //  Allow only image upload
    var ReaderObj = new FileReader(); // Create instance of the FileReader
    ReaderObj.readAsDataURL(files[0]); // read the file uploaded
    ReaderObj.onloadend = function(){ // set uploaded image data as background of div
    $("#imagePreview").css("background-image", "url("+this.result+")");
    $("#photo-button").html("Change Photo");
   }
  }else{
    alert("Upload an image");
  }
 });


         $('#signup-form').on('submit', function(e) {
            event.preventDefault();

            //var $data = $(this).serialize();

            //after submit button clicked hide modal
           // $("#myModal").modal('hide');
            // console.log($data);
            $('#signup-error-box').addClass('hide');
            $.ajax({
                method: "post",
                url: "{{url('admin/users')}}",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,
                //  cache: true,
                success: function(datas) {
                    console.log(datas);
                    //console.log(datas['photo']);
                if(datas) {
                    $('#signup-error-msg').empty();
                    $('#signup-error-box').removeClass('hide');
                        $.each(datas, function(key, data){

                            console.log(data);
                            $('#signup-error-msg').append('<p>'+data+'</p>');

                        });
                        //console.log($(this));
                        
                }else{
                    $("#at-signup-filling").modal('hide');
                    location.reload();
                    }
            }

            

        });

});


//Sweet alert plugin

$('#users').on('click','.del',function (e) {
e.preventDefault();
var link = $(this).attr('href');
swal({
title: "Are you sure?",
text: "You will not be able to recover this user!",
type: "warning",
showCancelButton: true,
confirmButtonColor: '#DD6B55',
confirmButtonText: 'Yes, delete it!',
cancelButtonText: "No, cancel plx!",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm){
swal("Deleted!", "This user has been deleted!", "success");
setTimeout(function () {
window.location = link;
},2000);
return true;
} else {
swal("Cancelled", "This user is safe :)", "error");
return false;
}
});
});
$('#users').on('click','.approved',function (e) {
e.preventDefault();
var link = $(this).attr('href');
swal({
title: "Are you sure?",
text: "Status will Change!",
type: "warning",
showCancelButton: true,
confirmButtonColor: '#DD6B55',
confirmButtonText: 'Yes, change it!',
cancelButtonText: "No, cancel plx!",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm){
if (isConfirm){
swal("Updated!", "This user has been approved!", "success");
setTimeout(function () {
window.location = link;
},2000);
return true;
} else {
swal("Cancelled", "This user is not approved :)", "error");
return false;
}
});
});

  
  </script>
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- script for datatable plugin -->



<script type="text/javascript">
    //copied source: https://jsfiddle.net/gyrocode/abhbs4x8/  or  https://www.gyrocode.com/articles/jquery-datatables-checkboxes/
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
   var $table             = table.table().node();
   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

   // If none of the checkboxes are checked
   if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If all of the checkboxes are checked
   } else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = false;
      }

   // If some of the checkboxes are checked
   } else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
         chkbox_select_all.indeterminate = true;
      }
   }
}

$(document).ready(function (){
   // Array holding selected row IDs
   var rows_selected = [];
   var table = $('#users').DataTable({
      //'ajax': 'https://api.myjson.com/bins/1us28',
      "columns": [              
                                {"data":"select_all"},
                                {"data": "id"},
                                {"data": "name"},
                                {"data": "email"},
                                {"data": "approved"},
                                {"data": "action"}
                            ],

      'columnDefs': [{
         'targets': [0],
         'searchable':false,
         'orderable':false,
         'width':'1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" value="'+data+'">';
         }
      }],

      "processing": true,
      "serverSide": true,
      "ajax":{
                    "url": "{{url('admin/get-users')}}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
            },

      'order': [1, 'asc'],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      }
   });

   // Handle click on checkbox
   $('#users tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#users').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
         $('#users tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#users tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
   });
    
   // Handle form submission event 
   $('#frm-example').on('submit', function(e){
      var form = this;

      // Iterate over all selected checkboxes
      $.each(rows_selected, function(index, rowId){
         // Create a hidden element 
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id[]')
                .val(rowId)
         );
      });

      // FOR DEMONSTRATION ONLY     
      
      // Output form data to a console     
      $('#example-console').text($(form).serialize());
      console.log("Form submission", $(form).serialize());
       
      // Remove added elements
      $('input[name="id\[\]"]', form).remove();
       
      // Prevent actual form submission
      e.preventDefault();
   });
});
</script>


{{-- 
<script type="text/javascript">
                    $(document).ready(function () {
                         
                        $('#users').DataTable({
                            "columns": [
                                {"data": "id"},
                                {"data": "name"},
                                {"data": "email"},
                                {"data": "approved"},
                                {"data": "action"}
                            ],

                            "columnDefs": [ {
                                  "targets": [ 4 ],
                                  "orderable": false
                                },

                                ],
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                     "url": "{{url('admin/get-users')}}",
                                     "dataType": "json",
                                     "type": "POST",
                                     "data":{ _token: "{{csrf_token()}}"}
                                   },
                        });

                    });
   </script> --}}
  

@endsection
