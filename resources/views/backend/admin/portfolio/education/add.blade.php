@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Education</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
@endsection
@section('contents')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Education
        <small>Add Education</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="{{url('admin/portfolio/education/')}}"><i></i> Education List</a></li>
        <li class="active">Add Degree</li>
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

          <div id="message-box"></div>
      <!-- row starts -->
        <div class="row">
            <div class="col-md-12">
              <form action="{{url('/admin/contact/')}}" method="POST" id="education">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="degree">Degree* :</label>
                      <input type="text" class="form-control" id="degree" placeholder="Enter Your Full Degree" name="degree" value="">
                    </div>
                    <div class="form-group">
                      <label for="major">Major* :</label>
                      <input type="text" class="form-control" id="major" placeholder="Enter Your Major" name="major" value="">
                    </div>
                    <div class="form-group">
                      <label for="enrolled_year">Enrolled Year:</label>
                      <input type="text" class="form-control" id="enrolled_year" placeholder="Enter Your Enrolled Year" name="enrolled_year" value="" >
                    </div>
                    <div class="form-group">
                      <label for="graduation_year">Graduation Year:</label>
                      <input type="text" class="form-control" id="graduation_year" placeholder="Enter Your Graduation Year" name="graduation_year" maxlength="">
                    </div>
                    <div class="form-group">
                      <label for="institution">Institution:</label>
                      <input type="text" class="form-control" id="institution" placeholder="Enter Your Institution" name="institution" value="">
                    </div>                                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="institution_address">Institution Address:</label>
                      <input type="text" class="form-control" id="institution_address" placeholder="Enter Your Institution Address" name="institution_address" value="" >
                    </div>
                    <div class="form-group">
                      <label for="board_or_university">Board/University:</label>
                      <input type="text" class="form-control" id="board_or_university" placeholder="Enter Your Board/University" name="board_or_university" value="">
                    </div>
                    <div class="form-group">
                      <label for="score">Score:</label>
                      <input type="text" class="form-control" id="score" placeholder="Enter Your Score" name="score" value="">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" name="achievements" value="">
                    </div>
                  </div>
                </div>
                <div class="row" >
                    <div class="col-md-4" >
                      <button type="submit" class="btn btn-success">Add Education</button>
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
$('.treeview').siblings().removeClass('active');
  $('.portfolio').addClass('active');
  $('.education').siblings().removeClass('active');
  $('.education').addClass('active');  
  </script>

<script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function () {

    $('#education').validate({ // initialize the plugin
        rules: {
            degree: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            major: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            enrolled_year: {
                required: true,
                maxlength: 10,
                //minlength:4
            },
            graduation_year: {
                required: true,
                maxlength: 10,
                //minlength:4
            },
            institution: {
                required: false,
                maxlength: 50,
                //minlength:4
            },
            institution_address: {
                required: false,
                maxlength: 50,
                //minlength:4
            },
            board_or_university: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            score: {
                required: false,
                maxlength: 10,
                //minlength:4
            },
            achievements: {
                required: false,
                maxlength: 100,
                //minlength:4
            },
        },
        messages: {
            degree: {
                    required: "Please enter degree",
                },
            /*middle: {
                required: "Please enter middle",
            },          
            image: {
                required: "Please Select logo",*/
            },
        submitHandler: function (form) {
            
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/education/")}}",
                data:$("#education").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div>');
                        $("#education")[0].reset();
                        $("form input[name=degree]").focus();

                        $("#message-box").hide();
                        $("#message-box").show(1000);
                        $("#message-box").hide(4000);
                  },
                error: function (responseData) {
                    console.log('Ajax request not recieved!');
                }
            });
            
            console.log('form submitted via ajax');
            //return false; // blocks redirect after submission via ajax
        },
    });

});

    </script>  

@endsection
