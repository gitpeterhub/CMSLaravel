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
        Skills
        <small>Edit Skill</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="{{url('admin/portfolio/skill')}}"><i></i> Skills List</a></li>
        <li class="active">Edit Skill</li>
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
              <form id="skill" action="{{url('/admin/contact/')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="certificate_title">Certificate Title* :</label>
                      <input type="text" class="form-control" id="certificate_title" placeholder="Enter Your Certificate Title" name="certificate_title" value="{{$skill->certificate_title}}" required="required">
                    </div>
                    <div class="form-group">
                      <label for="major">Major* :</label>
                      <input type="text" class="form-control" id="major" placeholder="Enter Your Major" name="major" value="{{$skill->major}}" required="required">
                    </div>
                    <div class="form-group">
                      <label for="start_date">Start Date:</label>
                      <input type="date" class="form-control" id="start_date" placeholder="Enter Your Start Date" name="start_date" value="{{$skill->start_date}}">
                    </div>
                    <div class="form-group">
                      <label for="end_date">End Date:</label>
                      <input type="date" class="form-control" id="end_date" placeholder="Enter Your End Date" name="end_date" value="{{$skill->end_date}}">
                    </div>
                    <div class="form-group">
                      <label for="institution">Institution* :</label>
                      <input type="text" class="form-control" id="institution" placeholder="Enter Your Institution" name="institution" value="{{$skill->institution}}">
                    </div>
                    <div class="form-group">
                      <label for="board">Board:</label>
                      <input type="text" class="form-control" id="board" placeholder="Enter Your About Board" name="board" value="{{$skill->board}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="score">Score:</label>
                      <input type="text" class="form-control" id="score" placeholder="Enter Your Score" name="score" value="{{$skill->score}}">
                    </div>
                    <div class="form-group">
                      <label for="description">Description:</label>
                      <textarea class="form-control" id="description" placeholder="Enter Your Description" name="description">{{$skill->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="type">Skill Type* :</label>
                      <select class="form-control" id="type" name="type" required="required" >
                      @if($skill->type==0)
                        <option value=0 selected="selected" >Skill</option>
                        <option value=1 >Certificate/Training</option>
                      @else
                        <option value=0 >Skill</option>
                        <option value=1 selected="selected" >Certificate/Training</option>
                      @endif                       
                      </select>
                    </div>
                  </div>
                </div>
                  <div class="row" >
                    <div class="col-md-4" >
                      <button type="submit" class="btn btn-success">Update Skill</button>
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
  $('.skills').siblings().removeClass('active');
  $('.skills').addClass('active');  
  </script>

      <script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">

      $(document).ready(function () {

    $('#skill').validate({ // initialize the plugin
        rules: {
            certificate_title: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            major: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            start_date: {
                required: false,
            },
            end_date: {
                required: false,
            },
            institution: {
                required: false,
                maxlength: 50,
            },
            board: {
                required: false,
                maxlength: 50,
            },
            score: {
                required: false,
                maxlength: 10,
            },
            description: {
                required: false,
                maxlength:191
            },
            type: {
                required: true,
            },
        },
        submitHandler: function (form) {
            
            $.ajax({
                method:"PUT",
                url:"{{url("/admin/portfolio/skill/".$skill->id)}}",
                data:$("#skill").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div>');
                        //$("#expertise")[0].reset();
                        $("form input[name=certificate_title]").focus();
                        
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
