<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('portfolio-assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('portfolio-assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('portfolio-assets/assets/Owl/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('portfolio-assets/assets/Owl/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{asset('portfolio-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('portfolio-assets/css/animate.css')}}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="0">
    <header>
        <nav class="navbar navbar-default navbar-fixed-top" id="navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">John Doe</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#experience">EXPERIENCE</a></li>
                        <li><a href="#education">EDUCATION</a></li>
                        <li><a href="#skills">SKILLS</a></li>
                        <li><a href="#expertise">EXPERTISE</a></li>
                        <li><a href="#contact">CONTACT</a></li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div class="clearfix"></div>
    </header>
    <section class="intro">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xm-6 col-xs-12 wow slideInLeft img-col">
                        <img src="{{asset('portfolio-assets/images/funny-profile-pictures.jpg')}}">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xm-6 col-xs-12  bg-gray introduction wow slideInRight">
                        
                        <h3>{{@$aboutMe[0]->name}} <br><span class="text-uppercase font-15"><strong>{{@$aboutMe[0]->position}} </strong></span></h3>
                        <h4><strong>Phone: </strong><br>{{@$aboutMe[0]->phone}}</h4>
                        <h4><strong>Email: </strong><br>{{@$aboutMe[0]->email}}</h4>
                        <h4><strong>Address: </strong><br>{{@$aboutMe[0]->address}}</h4>
                        <h4><strong>Date of Birth: </strong><br>
                            @if(@$aboutMe[0]->birthday)
                            <?php
                                    $dt = new DateTime($aboutMe[0]->birthday);
                                    echo $dt->format('F jS, Y');
                               
                            ?>
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="social-links">
        <div class="container">
            <div class="row">
                <div class="links">
                    <ul class="text-center">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                    </ul>
                </div>
            </div>
            <div class="texts text-center">
                <h2>Hello I'm 
                @if(@$aboutMe[0]->name)
                <?php 
                    $name = explode(" ",$aboutMe[0]->name);
                    echo $name[0];
                ?>
                @endif
                </h2>
                <p>{{@$aboutMe[0]->about_me}}</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section id="experience" class="experience">
        <div class="title">
            <h3>EXPERIENCE</h3>
        </div>
        <div class="container rel-div">
            @if(!isset($experiences) || !$experiences->isEmpty() )
            @foreach($experiences as $experience)
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="yr-div clearfix">
                        <h6 class="wow slideInLeft"><strong>
                            <?php
                                    $dt = new DateTime($experience->joined_date);
                                    echo $dt->format(('F jS, Y'));
                               
                            ?>-
                            @if(!isset($experience->resigned_date))
                            NOW
                            @else

                            <?php
                                    $dt = new DateTime($experience->resigned_date);
                                    echo $dt->format('F jS, Y');
                               
                            ?>
                            @endif
                        </strong></h6>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="exp-div">
                        <div class="dot hidden-xs wow fadeInUp"></div>
                        <h4 class="wow slideInRight">{{$experience->company_name}}</h4>
                        <p class="wow slideInRight">{{$experience->about_job}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="yr-div clearfix">
                        <h4 class="wow slideInLeft"><strong>2020-2023</strong></h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="exp-div">
                        <div class="dot hidden-xs wow fadeInUp"></div>
                        <h4 class="wow slideInRight">Company name</h4>
                        <p class="wow slideInRight">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="clearfix"></div>
    </section>
    <section id="education" class="education">
        <div class="title">
            <h3>EDUCATION</h3>
        </div>
        <div class="container">
            @if(!isset($educations) || !$educations->isEmpty() )
            @foreach($educations as $education)
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="yr-div clearfix">
                        <h4 class="wow slideInLeft"><strong>{{@$education->enrolled_year}}-{{$education->graduation_year}}</strong></h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="exp-div">
                        <div class="dot hidden-xs wow fadeInUp"></div>
                        <h4 class="wow slideInRight">{{$education->degree}}</h4>
                        <p class="wow slideInRight">This degree has the major courses of {{$education->major}} and I realized this degree under the hood of {{$education->institution}} affiliated to the board/university {{$education->board_or_university}} and graduated this degree in {{$education->graduation_year}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="yr-div clearfix">
                        <h4 class="wow slideInLeft"><strong>2020-2023</strong></h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="exp-div">
                        <div class="dot hidden-xs wow fadeInUp"></div>
                        <h4 class="wow slideInRight">Company name</h4>
                        <p class="wow slideInRight">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="clearfix"></div>
    </section>

    <section id="skills" class="skills">
        <div class="title">
            <h3>SKILLS</h3>
        </div>

        <div class="container">
            <div class="row">
                @if(!isset($skills) || !$skills->isEmpty() )
                @foreach($skills as $skill)
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInLeft">
                        <h4>{{$skill->certificate_title}}</h4>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInRight">
                        <h4>Hyper Text Markup Language(HTML)</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInLeft">
                        <h4>Hyper Text Markup Language(HTML)</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInRight">
                        <h4>Hyper Text Markup Language(HTML)</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInLeft">
                        <h4>Hyper Text Markup Language(HTML)</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="skill wow fadeInRight">
                        <h4>Hyper Text Markup Language(HTML)</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <section id="expertise" class="expertise">
        <div class="title">
            <h3>EXPERTISE</h3>
        </div>
        <div class="container p-40">
            <div class="owl-carousel owl-theme">
                @if(!isset($expertises) || !$expertises->isEmpty())
                @foreach($expertises as $expertise)
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <div class="item">
                    <div class="expert">
                        <h4>Jquery</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section id="contact" class="contact">
        <div class="title">
            <h3>CONTACT ME</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="footer-form">
                        <div id="message-box" ></div>
                        <form id="message-form" class="wow fadeInUp">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group submit">
                                    <input type="submit" class="form-control btn btn-primary" value="Send">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 b-l">
                    <div class="footer-contact">
                        <h4>{{@$aboutMe[0]->name}} <br><span class="text-uppercase font-15"><small>{{@$aboutMe[0]->position}} </small></span></h4>
                        <h5><strong>Phone: </strong><br>{{@$aboutMe[0]->phone}}</h5>
                        <h5><strong>Email: </strong><br>{{@$aboutMe[0]->email}}</h5>
                        <div class="line"></div>
                        <div class="footer-link">
                            <ul class="text-center">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="copyright text-center">
        <span> 2017 &copy; Peter Kumal</span>
    </section>
    <div> <a href="#" class="scrollToTop"><i class="fa fa-angle-up" aria-hidden="true"></i></a></div>
    <script src="{{asset('portfolio-assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('portfolio-assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('portfolio-assets/assets/Owl/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('portfolio-assets/js/custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{asset('plugins/validate/jquery.validate.min.js')}}"></script>
    <script>
        // Select all links with hashes
        $('a[href*="#"]')
            // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 60
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                }
            });

    </script>

    <script type="text/javascript">
       
        $('form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
                maxlength: 50,
                //minlength:4
            },
            email: {
                required: true,
                maxlength: 100,
                //minlength:4
            },
            subject: {
                required: true,
                maxlength: 30,
                //minlength:4
            },
            message: {
                required: true,
                maxlength: 191,
                //minlength:4
            },
        },
        submitHandler: function (form) {
            
            console.log($("form").serialize())
            $.ajax({
                method:"POST",
                url:"{{url("/portfolio/contact/store/")}}",
                data:$("form").serialize()+"&_token={{csrf_token()}}",
                success: function ($response) {
                    console.log($response);
                    $("#message-box").empty();
                    if ($response["alert-class"]){

                        $("#message-box").prepend('<div id = "message-box"><div id="message"></div><div class="alert alert-dismissable '+$response["alert-class"]+'" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="fa fa-circle-o"></i>'+$response.message+'</div></div>');

                    }else{

                            $("#message-box").append('<div class="alert alert-dismissable alert-warning" id="contactform-message"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button></div>');
                            $.each( $response, function( key, value ) {

                            $("#contactform-message").append('<i class="fa fa-times"></i><span>'+value+'</span>');
                        });

                    }

                    $("form")[0].reset();
                    $("form input[name=name]").focus();
              
                  }

        });
            
            console.log('form submitted via ajax');
            //return false; // blocks redirect after submission via ajax
        },
    });

    </script>


</body>

</html>
