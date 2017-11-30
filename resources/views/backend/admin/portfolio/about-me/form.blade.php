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
        About Me
        <small>13 unfilled fields</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Portfolio Options</a></li>
        <li><a href="#"><i></i> About Me</a></li>
        <li class="active">Update your info</li>
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
              <form id="about_me" action="{{url('/admin/contact/')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="text" name="id" class="hidden" value="@if($aboutMe){{$aboutMe->id}}@else @endif">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Your Full Name* :</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter Your Full Name" name="name" value="@if($aboutMe){{$aboutMe->name}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="email">Email* :</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" value="@if($aboutMe){{$aboutMe->email}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone:</label>
                      <input type="text" class="form-control" id="phone" placeholder="Enter Your phone number" name="phone" value="@if($aboutMe){{$aboutMe->phone}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="social_links">Social Links:</label>
                      <input type="text" class="form-control" id="social_links" placeholder="Enter Your Social Links" name="social_links" value="@if($aboutMe){{$aboutMe->social_links}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="websites">Websites:</label>
                      <input type="text" class="form-control" id="websites" placeholder="Enter Your Websites" name="websites" value="@if($aboutMe){{$aboutMe->websites}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="address" placeholder="Enter Your Duties" name="address" value="@if($aboutMe){{$aboutMe->address}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company">Company:</label>
                      <input type="text" class="form-control" id="company" placeholder="Enter Your Company" name="company" value="@if($aboutMe){{$aboutMe->company}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" class="form-control" id="position" placeholder="Enter Your Positionl" name="position" value="@if($aboutMe){{$aboutMe->position}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birth Date:</label>
                      <input type="date" class="form-control" id="birthday" placeholder="Enter Your Birth Date" name="birthday" value="@if($aboutMe){{$aboutMe->birthday}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="marital_status">Marital Status:</label>
                      <input type="text" class="form-control" id="marital_status" placeholder="Enter Your Marital Status" name="marital_status" value="@if($aboutMe){{$aboutMe->marital_status}}@else @endif" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="gender">Gender:</label>
                      <input type="text" class="form-control" id="gender" placeholder="Enter Your Gender" name="gender" value="@if($aboutMe){{$aboutMe->gender}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="nationality">Nationality:</label>
                      <input type="text" class="form-control" id="nationality" placeholder="Enter Your Nationality" name="nationality" value="@if($aboutMe){{$aboutMe->nationality}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="religion">Religion:</label>
                      <input type="text" class="form-control" id="religion" placeholder="Enter Your Marital Religion" name="religion" value="@if($aboutMe){{$aboutMe->religion}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="interests">Interests:</label>
                      <input type="text" class="form-control" id="interests" placeholder="Enter Your Interests" name="interests" value="@if($aboutMe){{$aboutMe->interests}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="hobbies">Hobbies:</label>
                      <input type="text" class="form-control" id="hobbies" placeholder="Enter Your Hobbies" name="hobbies" value="@if($aboutMe){{$aboutMe->hobbies}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="strengths">Strengths:</label>
                      <input type="text" class="form-control" id="strengths" placeholder="Enter Your Strengths" name="strengths" value="@if($aboutMe){{$aboutMe->strengths}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" name="achievements" value="@if($aboutMe){{$aboutMe->achievements}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="skills">Skills:</label>
                      <input type="text" class="form-control" id="skills" placeholder="Enter Your Skills" name="skills" value="@if($aboutMe){{$aboutMe->skills}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="languages">Languages:</label>
                      <input type="text" class="form-control" id="languages" placeholder="Enter Your Languages" name="languages" value="@if($aboutMe){{$aboutMe->languages}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="about_me">About Me:</label>
                      <input type="text" class="form-control" id="about_me" placeholder="Enter Your About Me" name="about_me" value="@if($aboutMe){{$aboutMe->about_me}}@else @endif" required="">
                    </div>
                    <div class="form-group">
                      <label for="photo">Photo:</label>
                      <input type="text" class="form-control" id="photo" placeholder="Enter Your Photo" name="photo" value="@if($aboutMe){{$aboutMe->photo}}@else @endif" required="required">
                    </div>
                    <div class="form-group">
                      <label for="references">references:</label>
                      <input type="text" class="form-control" id="references" placeholder="Enter Refrences" name="references" value="@if($aboutMe){{$aboutMe->references}}@else @endif" required="">
                    </div>
                  </div>
                </div>
                <div class="row" >
                  <div class="col-md-4" ><button type="submit" class="btn btn-success">Update info</button></div>
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
  $('.about_me').siblings().removeClass('active');
  $('.about_me').addClass('active');  
  </script>  

  <script type="text/javascript">
        $("#about_me").on("submit", function (e) {
            e.preventDefault();
                console.log($("#about_me").serialize());
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/about-me/")}}",
                data:$("#about_me").serialize(),
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id = "message-box"><div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div></div>');
                        //$("#experience")[0].reset();
                        $("form input[name=degree]").focus();
                  }

        });


    });
    </script>  

@endsection
