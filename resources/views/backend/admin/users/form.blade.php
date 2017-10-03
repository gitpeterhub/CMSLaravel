@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Users</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
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
      <!-- row starts -->
        <div class="row">
            <div class="col-md-12">
              <form action="{{url('/admin/users/update')}}/{{$user->id}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group hidden">
                      <input type="text" class="form-control" id="prev_photo" name="prev_photo" value="{{$user->photo}}">
                    </div>
                    <div class="form-group">
                      <label for="name">Full Name:</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter Your Full Name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="text" class="form-control" id="password" placeholder="Enter Your Password" name="password" value="{{$user->password}}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" >
                      <div id="imagePreview" style="background: url({{$user->photo_url}});"></div>
                      <br/>
                      <label class="control-label new-label" for="photo">
                      <input style="display: none" name="photo" type="file" id="photo">
                      @if($user->photo_url != null)
                      <span class="btn btn-primary" id="photo-button">Change Photo</span>
                      @else
                      <span class="btn btn-primary" id="photo-button">Choose Photo</span>                   
                      </label>
                      @endif
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./Content Wrapper-->
  @endsection

@section('scripts')

<script>

  $('.user-management').siblings().removeClass('active');
  $('.user-management').addClass('active');
  
  </script>
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- script for datatable plugin -->
<script type="text/javascript">
                    $(document).ready(function () {
                         
                        $('#users').DataTable({
                            "columns": [
                                {"data": "id"},
                                {"data": "name"},
                                {"data": "email"},
                                {"data": "action"}
                            ],
                            "columnDefs": [ {
                                  "targets": [ 3 ],
                                  "orderable": false
                                } ],
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                     "url": "{{url('admin/users')}}",
                                     "dataType": "json",
                                     "type": "POST",
                                     "data":{ _token: "{{csrf_token()}}"}
                                   },
                        });

                    });

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
   </script>
  

@endsection
