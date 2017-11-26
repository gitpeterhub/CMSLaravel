@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | About Me</title>
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
        <li class="active">Update My Info</li>
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
              <form action="{{url('/admin/contact/')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Full Name* :</label>
                      <input type="text" class="form-control" id="name" placeholder="Enter Your Full Name" name="name" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="email">Email* :</label>
                      <input type="text" class="form-control" id="email" placeholder="Enter Your Email" name="email" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone:</label>
                      <input type="text" class="form-control" id="phone" placeholder="Enter Your Phone" name="phone" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="social_links">Social Links:</label>
                      <input type="text" class="form-control" id="social_links" placeholder="Enter Your Social Links" name="social_links" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="websites">Websites:</label>
                      <input type="text" class="form-control" id="websites" placeholder="Enter Your Websites" name="websites" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="address" placeholder="Enter Your Address" name="address" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company">Current Company:</label>
                      <input type="text" class="form-control" id="company" placeholder="Enter Your Company" name="company" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="position">Poistion:</label>
                      <input type="text" class="form-control" id="position" placeholder="Enter Your Position" name="position" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birthday:</label>
                      <input type="date" class="form-control" id="birthday" placeholder="Enter Your Birthday" name="birthday" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="marital_status">Marital Status:</label>
                      <input type="text" class="form-control" id="marital_status" placeholder="Enter Your Marital Status" name="marital_status" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="gender">Gender:</label>
                      <input type="text" class="form-control" id="gender" placeholder="Enter Your Gender" name="gender" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="nationality">Nationality:</label>
                      <input type="text" class="form-control" id="nationality" placeholder="Enter Your Nationality" name="nationality" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="religion">Religion:</label>
                      <input type="text" class="form-control" id="religion" placeholder="Enter Your Religion" name="religion" value="" required="required">
                    </div>
                    
                                     
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="photo">Photo:</label>
                      <input type="file" class="form-control" id="photo" placeholder="Enter Your Photo" name="photo" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="interests">Interests:</label>
                      <input type="text" class="form-control" id="interests" placeholder="Enter Your Interests" name="interests" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="hobbies">Hobbies:</label>
                      <input type="text" class="form-control" id="hobbies" placeholder="Enter Your Hobbies" name="hobbies" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="strengths">Strengths:</label>
                      <input type="text" class="form-control" id="strengths" placeholder="Enter Your Strengths" name="strengths" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" name="achievements" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="skills">Skills:</label>
                      <input type="text" class="form-control" id="skills" placeholder="Enter Your Skills" name="skills" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="languages">Languages:</label>
                      <input type="text" class="form-control" id="languages" placeholder="Enter Your Languages" name="languages" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="about_me">About Me:</label>
                      <input type="text" class="form-control" id="about_me" placeholder="Enter Your About Me" name="about_me" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="references">References:</label>
                      <input type="text" class="form-control" id="referenceR" placeholder="Enter Your References" name="references" value="" required="required">
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

  /*$('.treeview').siblings().removeClass('active');
  $('.').addClass('active');*/
  </script>  

@endsection
