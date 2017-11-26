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
        <li><a href="#"><i></i> Experiences</a></li>
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
              <form action="{{url('/admin/contact/')}}" method="POST" enctype="multipart/form-data">
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
                      <label for="resigned_date">Resigned Date:</label>
                      <input type="date" class="form-control" id="resigned_date" placeholder="Enter Your Resigned Date" name="resigned_date" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" class="form-control" id="position" placeholder="Enter Your Position" name="position" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="about_job">About Job:</label>
                      <input type="text" class="form-control" id="about_job" placeholder="Enter Your About Job" name="about_job" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="duties">Duties:</label>
                      <input type="text" class="form-control" id="duties" placeholder="Enter Your Duties" name="duties" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="projects">Projects:</label>
                      <input type="text" class="form-control" id="projects" placeholder="Enter Your Projects" name="projects" value="" required="required">
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_email">Company Email:</label>
                      <input type="email" class="form-control" id="company_email" placeholder="Enter Your Company Email" name="company_email" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company_phone">Company Phone:</label>
                      <input type="text" class="form-control" id="company_phone" placeholder="Enter Your Company Phone" name="company_phone" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company_address">Company Address:</label>
                      <input type="text" class="form-control" id="company_address" placeholder="Enter Your Company Address" name="company_address" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company_websites">Company Websites:</label>
                      <input type="text" class="form-control" id="company_websites" placeholder="Enter Your Company websites" name="company_websites" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="company_established">Company Established:</label>
                      <input type="text" class="form-control" id="Company Established" placeholder="Enter Your Company Established" name="company_established" value="" required="required">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" name="achievements" value="" required="required">
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
