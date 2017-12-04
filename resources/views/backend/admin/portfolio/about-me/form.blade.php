@extends('backend.master-layout')
@section('title')
<title>AdminLTE 2 | Experiences</title>
@endsection
@section('styles')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}">
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
        About Me
        <small>Update Your Info</small>
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
              <form id="about-me" action="#" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="text" name="id" class="hidden" value="@if($aboutMe){{$aboutMe->id}}@else @endif">
                <div class="form-group hidden">
                      <input type="text" class="form-control" id="prev_photo" name="prev_photo" value="@if($aboutMe){{$aboutMe->photo}}@else @endif">
                    </div>
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
                      <input type="text" class="form-control" id="phone" placeholder="Enter Your phone number" name="phone" value="@if($aboutMe){{$aboutMe->phone}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="social_links">Social Links:</label>
                      <input type="text" class="form-control" id="social_links" placeholder="Enter Your Social Links" name="social_links" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->social_links}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="websites">Websites:</label>
                      <input type="text" class="form-control" id="websites" placeholder="Enter Your Websites" name="websites" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->websites}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="address" placeholder="Enter Your Duties" name="address" value="@if($aboutMe){{$aboutMe->address}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="company">Company:</label>
                      <input type="text" class="form-control" id="company" placeholder="Enter Your Company" name="company" value="@if($aboutMe){{$aboutMe->company}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" class="form-control" id="position" placeholder="Enter Your Positionl" name="position" value="@if($aboutMe){{$aboutMe->position}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birth Date:</label>
                      <input type="date" class="form-control" id="birthday" placeholder="Enter Your Birth Date" name="birthday" value="@if($aboutMe){{$aboutMe->birthday}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="marital_status">Marital Status:</label>
                      <select class="form-control" name="marital_status" id="marital_status">
                        @if($aboutMe)
                          @if($aboutMe->marital_status==0)
                          <option value= 0 selected="selected" >Single</option>
                          <option value= 1 >Married</option> 
                          @else
                          <option value= 0 >Single</option>
                          <option value= 1 selected="selected" >Married</option>
                          @endif
                        @else
                          <option value= 0 >Single</option>
                          <option value= 1 >Married</option> 
                        @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" >
                      <div id="imagePreview" style="background: url(@if($aboutMe){{$aboutMe->photo_url}}@else @endif);"></div>
                      <br/>
                      <label class="control-label new-label" for="photo">
                      <input style="display: none" name="photo" type="file" id="photo">
                      @if($aboutMe)
                          @if($aboutMe->photo_url!=NULL)
                          <span class="btn btn-primary" id="photo-button">Change Photo</span>
                          </label>
                          @else
                          <span class="btn btn-primary" id="photo-button">Choose Photo</span>   
                          </label>
                          @endif
                      @else
                      <span class="btn btn-primary" id="photo-button">Choose Photo</span>
                      </label>
                      @endif

                    </div>
                    <div class="form-group">
                      <label for="gender">Gender:</label>
                      <select class="form-control" name="gender" id="gender">
                        @if($aboutMe)
                          @if($aboutMe->gender==0)
                          <option value= 0 selected="selected" >Male</option>
                          <option value= 1 >Female</option> 
                          @else
                          <option value= 0 >Male</option>
                          <option value= 1 selected="selected" >Female</option>
                          @endif
                        @else
                          <option value= 0 >Male</option>
                          <option value= 1 >Female</option> 
                        @endif
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="nationality">Nationality:</label>
                      <input type="text" class="form-control" id="nationality" placeholder="Enter Your Nationality" name="nationality" value="@if($aboutMe){{$aboutMe->nationality}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="religion">Religion:</label>
                      <input type="text" class="form-control" id="religion" placeholder="Enter Your Marital Religion" name="religion" value="@if($aboutMe){{$aboutMe->religion}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="interests">Interests:</label>
                      <input type="text" class="form-control" id="interests" placeholder="Enter Your Interests" name="interests" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->interests}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="hobbies">Hobbies:</label>
                      <input type="text" class="form-control" id="hobbies" placeholder="Enter Your Hobbies" name="hobbies" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->hobbies}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="strengths">Strengths:</label>
                      <input type="text" class="form-control" id="strengths" placeholder="Enter Your Strengths" name="strengths" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->strengths}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="achievements">Achievements:</label>
                      <input type="text" class="form-control" id="achievements" placeholder="Enter Your Achievements" data-role="tagsinput" name="achievements" value="@if($aboutMe){{$aboutMe->achievements}}@else @endif" >
                    </div>
                    <div class="form-group">
                      <label for="skills">Skills:</label>
                      <input type="text" class="form-control" id="skills" placeholder="Enter Your Skills" name="skills" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->skills}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="languages">Languages:</label>
                      <input type="text" class="form-control" id="languages" placeholder="Enter Your Languages" name="languages" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->languages}}@else @endif">
                    </div>
                    <div class="form-group">
                      <label for="about_me">About Me:</label>
                      <textarea class="form-control" id="about_me" placeholder="Enter Your About Me" name="about_me" >@if($aboutMe){{$aboutMe->about_me}}@else @endif</textarea>
                    </div>
                    <div class="form-group">
                      <label for="references">references:</label>
                      <input type="text" class="form-control" id="references" placeholder="Enter Refrences" name="references" data-role="tagsinput" value="@if($aboutMe){{$aboutMe->references}}@else @endif">
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

  <script src="{{asset('plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>

  <script type="text/javascript">

    //for passing multiple value as string - bootstrap-tagsinput
    $("input").val();
    //for passing multiple value as array - bootstrap-tagsinput
    //$("input").tagsinput('items');
        //checkFields();


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

       

       //submit form with ajax
        /*$("#about-me").on("submit", function (e) {
            e.preventDefault();
               // console.log($("#about_me").serialize());
               var formData = new FormData(this);
               console.log(formData);
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/about-me/")}}",
                data:formData,
                processData: false,
                contentType: false,
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id = "message-box"><div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div></div>');
                        //$("#experience")[0].reset();
                        $("form input[name=degree]").focus();
                  }

        });
        
       

    });*/

        $(document).ready(function(){

            //javascript validation for form
       $("#about-me").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100
                },
                email: {
                    required: true,
                    maxlength: 100
                },
                phone: {
                    required: false,
                    maxlength: 20
                },
                social_links: {
                    required: false,
                    maxlength: 100
                },
                websites: {
                    required: false,
                    //maxlength: 50
                },
                address: {
                    required: false,
                    maxlength: 50
                },
                company: {
                    required: false,
                    maxlength: 50
                },
                position: {
                    required: true,
                    maxlength: 50
                },
                birthday: {
                    required: false,
                    maxlength: 11
                },
                nationality: {
                    required: false,
                    maxlength: 20
                },
                religion: {
                    required: false,
                    maxlength: 20
                },
                interests: {
                    required: false,
                   // maxlength: 100
                },

                hobbies: {
                    required: false,
                   // maxlength: 100
                },
                strengths: {
                    required: false,
                    //maxlength: 100
                },
                achievements: {
                    required: false,
                   // maxlength: 100
                },
                skills: {
                    required: false,
                    //maxlength: 100
                },
                languages: {
                    required: false,
                    //maxlength: 100
                },
                about_me: {
                    required: false,
                    //maxlength: 191
                },
                photo: {
                    required: false,
                    //maxlength: 100
                },
                references: {
                    required: false,
                   // maxlength: 191
                },

            },

            submitHandler: function (form) {
            
            var formData = new FormData($("#about-me")[0]);
               console.log(formData);
            $.ajax({
                method:"POST",
                url:"{{url("/admin/portfolio/about-me/")}}",
                data:formData,
                processData: false,
                contentType: false,
                success: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div>');
                        //$("#experience")[0].reset();
                        $("form input[name=name]").focus();
                        $("#message-box").hide();
                        $("#message-box").show(1000);
                        $("#message-box").hide(4000);   
                  },
                error: function ($response) {
                    console.log($response);

                    $("#message-box").empty();
                     $("#message-box").prepend('<div id="message"></div><div class="alert alert-dismissable warning id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>Something went wrong! Try again.</div>');
                        //$("#experience")[0].reset();
                        $("form input[name=name]").focus();
        }

        });
            
            console.log('form submitted via ajax');
            //return false; // blocks redirect after submission via ajax
        }

        })       
        })

    </script>  

@endsection
