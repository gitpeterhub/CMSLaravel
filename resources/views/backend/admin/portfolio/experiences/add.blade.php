@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Experiences</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}">  
@endsection
@section('contents')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Experiences
        <small>Add Experience</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="{{url('admin/portfolio/experience')}}"><i></i> Experiences List</a></li>
        <li class="active">Add Experience</li>
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
              <div id="message-box"></div>
              <form id="experience" action="{{url('/admin/contact/')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_name">Company Name* :</label>
                      <input type="text" class="form-control" id="company_name" placeholder="Enter Your Full Company Name" name="company_name" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="joined_date">Joined Date* :</label>
                      <input type="date" class="form-control" id="joined_date" placeholder="Enter Your Joined Date" name="joined_date" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="resigned_date">Resigned Date :</label>
                      <input type="date" class="form-control" id="resigned_date" placeholder="Enter Your Resigned Date" name="resigned_date" value="">
                    </div>
                    <div class="form-group">
                      <label for="position">Position* :</label>
                      <input type="text" class="form-control" id="position" placeholder="Enter Your Position" name="position" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="about_job">About Job:</label>
                      <textarea class="form-control" id="about_job" placeholder="Write about Your Job" name="about_job" ></textarea>
                    </div>
                    <div class="form-group">
                      <label for="duties">Duties* :</label>
                      <input type="text" class="form-control" id="duties" data-role="tagsinput" placeholder="Enter Your Duties" name="duties" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="projects">Projects:</label>
                      <input type="text" class="form-control" id="projects" data-role="tagsinput" placeholder="Enter Your Projects" name="projects" value="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_email">Company Email:</label>
                      <input type="email" class="form-control" id="company_email" placeholder="Enter Your Company Email" name="company_email" value="">
                    </div>
                    <div class="form-group">
                      <label for="company_phone">Company Phone:</label>
                      <input type="text" class="form-control" id="company_phone" placeholder="Enter Your Company Phone" name="company_phone" value="">
                    </div>
                    <div class="form-group">
                      <label for="company_address">Company Address:</label>
                      <input type="text" class="form-control" id="company_address" placeholder="Enter Your Company Address" name="company_address" value="">
                    </div>
                    <div class="form-group">
                      <label for="company_website">Company Website:</label>
                      <input type="text" class="form-control" id="company_website" placeholder="Enter Your Company website" name="company_website" value="">
                    </div>
                    <div class="form-group">
                      <label for="company_established">Company Established:</label>
                      <input type="date" class="form-control" id="Company Established" placeholder="Enter Your Company Established" name="company_established" value="">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" data-role="tagsinput" placeholder="Enter Your Achievements" name="achievements" value="">
                    </div>
                  </div>
                </div>
                <div class="row" >
                  <div class="col-md-4" ><button type="submit" class="btn btn-success">Add Experience</button></div>
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
  $('.experience').siblings().removeClass('active');
  $('.experience').addClass('active');  
  </script>  

  <script src="{{asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function () {

    $('#experience').validate({ // initialize the plugin
        rules: {
            company_name: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            joined_date: {
                required: true,
                //maxlength: 50,
                //minlength:4
            },
            resigned_date: {
                required: false,
                //maxlength: 10,
                //minlength:4
            },
            position: {
                required: true,
                maxlength: 30,
                //minlength:4
            },
            about_job: {
                required: false,
                maxlength: 191,
                //minlength:4
            },
            duties: {
                required: true,
                maxlength: 100,
                //minlength:4
            },
            projects: {
                required: false,
                maxlength: 100,
                //minlength:4
            },
            achievements: {
                required: false,
                maxlength: 100,
                //minlength:4
            },
            company_email: {
                required: false,
                maxlength: 50,
                //minlength:4
            },
            company_phone: {
                required: false,
                maxlength: 30,
                //minlength:4
            },
            company_address: {
                required: false,
                maxlength: 50,
                //minlength:4
            },
            company_websites: {
                required: false,
                maxlength: 50,
                //minlength:4
            },
            company_established: {
                required: false,
                //maxlength: 30,
                //minlength:4
            },
            about_company: {
                required: false,
                maxlength: 191,
                //minlength:4
            },
        },
        messages: {
           /* degree: {
                    required: "Please enter degree",
                },*/
            /*middle: {
                required: "Please enter middle",
            },          
            image: {
                required: "Please Select logo",*/
            },
        submitHandler: function (form) {
            
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/experience/")}}",
                data:$("#experience").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div>');
                        $("#experience")[0].reset();
                        $("form input[name=company_name]").focus();
                        $("#message-box").hide();
                        $("#message-box").show(1000);
                        $("#message-box").hide(4000);
                  }

        });
            
            console.log('form submitted via ajax');
            //return false; // blocks redirect after submission via ajax
        },
    });

});

    </script>  

@endsection
