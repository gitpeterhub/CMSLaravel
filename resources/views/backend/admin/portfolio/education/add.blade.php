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
        About Me
        <small>13 unfilled fields</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="#"><i></i> Education</a></li>
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
                      <input type="text" class="form-control" id="degree" placeholder="Enter Your Full Degree" name="degree" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="major">Major* :</label>
                      <input type="text" class="form-control" id="major" placeholder="Enter Your Major" name="major" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="enrolled_year">Enrolled Year:</label>
                      <input type="text" class="form-control" id="enrolled_year" placeholder="Enter Your Enrolled Year" name="enrolled_year" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="graduation_year">Graduation Year:</label>
                      <input type="text" class="form-control" id="graduation_year" placeholder="Enter Your Graduation Year" name="graduation_year" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="institution">Institution:</label>
                      <input type="text" class="form-control" id="institution" placeholder="Enter Your Institution" name="institution" value="" required="required">
                    </div>                                    
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="institution_address">Institution Address:</label>
                      <input type="text" class="form-control" id="institution_address" placeholder="Enter Your Institution Address" name="institution_address" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="board_or_university">Board/University:</label>
                      <input type="text" class="form-control" id="board_or_university" placeholder="Enter Your Board/University" name="board_or_university" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="score">Score:</label>
                      <input type="text" class="form-control" id="Score" placeholder="Enter Your Score" name="Score" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" name="achievements" value="" required="required">
                    </div>
                  </div>
                </div>
                <div class="row" >
                    <div class="col-md-4" >
                      <button type="submit" class="btn btn-success">Create</button>
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

  <script type="text/javascript">
        $("form").on("submit", function (e) {

            e.preventDefault();
                console.log($("form").serialize());
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/education/")}}",
                data:$("form").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id = "message-box"><div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div></div>');
                        $("#education")[0].reset();
                        $("form input[name=degree]").focus();
                  }

        });


    });
    </script>  

@endsection
