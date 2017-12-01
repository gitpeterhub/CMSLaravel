@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Experiences</title>
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
        Expertises
        <small>Add Expertise</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="{{url('admin/portfolio/expertise')}}"><i></i> Expertise List</a></li>
        <li class="active">Add Expertise</li>
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
              <div id="message-box" ></div>
              <form  id="expertise" action="#" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="field_of_expertise">Field Of Expertise* :</label>
                      <input type="text" class="form-control" id="company_name" placeholder="Enter Your Full Field Of Expertise" name="field_of_expertise" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="research_topics">Research Topics:</label>
                      <input type="text" class="form-control" id="research_topics" placeholder="Enter Your Research Topics" name="research_topics" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="expertise_details">Expertise Details* :</label>
                      <input type="text" class="form-control" id="expertise_details" placeholder="Enter Your Expertise Details" name="expertise_details" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your achievements" name="achievements" value="">
                    </div>
                    <button type="submit" class="btn btn-success">Add Expertise</button>
                  </div>
                  <div class="col-md-6">
                    
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

<<script>
  $('.treeview').siblings().removeClass('active');
  $('.portfolio').addClass('active');
  $('.expertise').siblings().removeClass('active');
  $('.expertise').addClass('active');  
  </script>

    <script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function () {

    $('#expertise').validate({ // initialize the plugin
        rules: {
            field_of_expertise: {
                required: true,
                maxlength: 40,
                //minlength:4
            },
            expertise_details: {
                required: true,
                maxlength: 191,
                //minlength:4
            },
            research_topics: {
                required: true,
                maxlength: 100,
                //minlength:4
            },
            achievements: {
                required: false,
                maxlength: 191,
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
                url:"{{url("/admin/portfolio/expertise/")}}",
                data:$("#expertise").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id = "message-box"><div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div></div>');
                        $("#expertise")[0].reset();
                        $("form input[name=field_of_expertise]").focus();
                  }

        });
            
            console.log('form submitted via ajax');
            //return false; // blocks redirect after submission via ajax
        },
    });

});

    </script>  

@endsection
