<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('our_design/style.css')}}">
    <!-- google-fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
          rel="stylesheet">

    <title>Online Exam</title>
    <!-- Bootstrap core CSS -->
    <link href="landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
{{--  <link href="landing/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>--}}

<!-- Plugin CSS -->
    <link href="landing/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="landing/css/creative.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!--Student Login  - ---------------------------- -->
<div class="modal fade" id="studentlogin" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <h4><span class="glyphicon glyphicon-lock"></span>Student Login</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:40px 50px;">

                <form role="form">
                    <div class="form-group hidden">
                        <span class="alert-danger " id="error_msg"></span>
                    </div>
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Student Id</label>
                        <input type="text" class="form-control" id="loginstudent_id" name="loginstudent_id"
                               placeholder="Enter student Id">
                        <span class="help-block hidden" id="error_student_id">
              </span>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword"
                               placeholder="Enter password">
                        <span class="help-block hidden" id="error_student_pass">
              </span>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"
                                      {{ old('remember') ? 'checked' : '' }} style="margin-right:15px">Remember
                            me</label>
                    </div>
                </form>
                <button onclick="studentInitialAbility()" id="std-login" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>
                    Login
                </button>

            </div>
            <div class="modal-footer text-center">
                <p>Not a member? <a href="#" id="signup">Sign Up</a></p>

            </div>
        </div>

    </div>
</div>

<!--- Start Registration -------------------------- ---------------------------------------------------- -->
<!--  form Create Post -->
<div id="create" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <h4><span class="glyphicon glyphicon-lock"></span>Sign Up</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">

                <form role="form">
                    <div class="form-group hidden">
                        <span class="alert-danger " id="rerror_msg"></span>
                    </div>
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Student Name : </label>
                        <input type="text" class="form-control" id="student_name" name="student_name"
                               placeholder="Enter student name">
                        <span class="help-block hidden" id="error_name_id">
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Student Id : </label>
                        <input type="text" class="form-control" id="stid" name="stid"
                               placeholder="Create New student Id">
                        <span class="help-block hidden" id="error_rstudent_id">
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="usrname"><span class="glyphicon glyphicon-user"></span> Contact No : </label>
                        <input type="tel" class="form-control" id="contact" name="contact"
                               placeholder="Create New student Id">
                        <span class="help-block hidden" id="error_contact_id">
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password :</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Create New password">
                        <span class="help-block hidden" id="error_pass">
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Confirm Password : </label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation" placeholder="Enter password">
                        <span class="help-block hidden" id="error_pass">
                    </span>
                    </div>
                    {{--<div class="checkbox">
                      <label><span  style="margin-right:15px" ></span>Terms and Condition</label>
                    </div>--}}
                </form>
                <button id="std-signup" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span>
                    Sign Up
                </button>

            </div>
            <div class="modal-footer text-center">


            </div>
        </div>

    </div>
</div>
<!-- EndLogin And Registration - ---------------------------- -->

<!-- Navigation -->
<nav class="navbar navbar-dark bg-success navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Online Exam</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ url('/home') }}">Home</a>
                        </li>

                    @else
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal"
                               data-target="#studentlogin">Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="{{ route('admin.login') }}">Admin</a>
                        </li>


                    @endauth
                @endif
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">FAQS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Free Trial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead text-center text-white d-flex">
    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h3 class="text-uppercase">
                    The Best Quiz Maker for Business & Education
                </h3>
                <hr>
            </div>
            <div class="col-lg-8 mx-auto">
                <p class="text-faded mb-5">Final Year Project demonstrating the online Exam Platform</p>
                <a class="btn bg-success btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
            </div>
        </div>
    </div>
</header>

{{--<section class="bg-primary" id="about">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading text-white">We've got what you need!</h2>
        <hr class="light my-4">
        <p class="text-faded mb-4">Online Exam has everything you need to start your online Exam and publish in no time! We Provide Free App of your Institution / Organization, It will be Available on PlayStore, free to download, and easy to use.!</p>
        <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>
      </div>
    </div>
  </div>
</section>--}}

<section id="contact">
    <div class="contact-area">
        <div class="container">
            <h2>
                <center>Contact us</center>
            </h2>
            <h5>
                <center>Please fill this form in the decent manner</center>
            </h5>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name"><p>Name</p></label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="email"><p>Email</p></label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name"><p>Message</p></label>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="button">
                            <button type="button" class="btn btn-success">Submit</button>
                        </div>
                        <div class="col-md-3"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about">

    {{--<div class="banner">
      <img class="img-fluid" src={{ asset('our_design/images/banner.jpg') }} alt="">
      <p>The Best Quiz Maker for Business & Education</p>
      <h6>The Best Quiz Maker for Business & Education</h6>
    </div>--}}

    <div class="body">
        <div class="container">
            <h1>
                <center>About Us</center>
            </h1>
            <div class="row">
                <div class="col-md-6">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                        but also the leap into electronic typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                        and more recently with desktop publishing software like Aldus PageMaker including versions of
                        Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type specimen book. It has survived not only
                        five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including
                        versions of Lorem Ipsum.</p>
                </div>
                <div class="col-md-6">
                    <img src={{ asset('our_design/images/home.jpg') }} alt="">
                </div>
            </div>
        </div>
    </div>

</section>


<!-- Bootstrap core JavaScript -->
<script src="landing/vendor/jquery/jquery.min.js"></script>
<script src="landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="landing/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="landing/vendor/scrollreveal/scrollreveal.min.js"></script>
<script src="landing/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="landing/js/creative.min.js"></script>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-xl-3">
                <h5>QUICK LINKS</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="#">FAQs</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Exam</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">Results</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <h5>CONTACT US</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span>Technical Support</span>
                        <p class="mb-0">+xxx-xxx-xxx</p>
                        <p>onlineexam7th@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <h5>FOLLOW US</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>
                            <div class="col-10">
                                <a href="#">
                                    facebook
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                            <div class="col-10">
                                <a href="#">
                                    instagram
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                            <div class="col-10">
                                <a href="#">
                                    twitter
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <h5>FIND US</h5>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1766.7471458087934!2d85.33909130290228!3d27.671113793275154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e5f743e76b%3A0x368dbad07042b560!2sKathford+Int&#39;l+College+of+Engineering+and+Management!5e0!3m2!1sen!2snp!4v1560576477900!5m2!1sen!2snp"
                        width="150" height="100" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</footer>
<div class="copyright">
    <div class="container">
        <p>&copy; 2019 OnlineExam . All Right Reserved .</p>
    </div>
</div>
//Student Registeration
<script>
    function studentInitialAbility() {

        //add student initial ability
        let ACCURACY = 0.7;
        //starting ability is between 90 - 95
        let ABILITY = 0;
        console.log(ABILITY);
        let ABILITYRIGHT = 0;
        let SE = ACCURACY;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

//initialize student initial ability
        $.ajax({
            type: 'POST',
            url: '/studentinitialability',


            data: {
                student_id: $('input[name=loginstudent_id]').val(),
                pability: ABILITY,
                abilityright: ABILITYRIGHT,
                se: SE,

            },
            success: function (data) {
                console.log(data);
            }
        })
    }
</script>
<script>

    // Register
    $(document).ready(function () {

        $("#signup").click(function () {
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-title').text('Contact');
        });

        $("#std-signup").click(function () {
            $('#std-signup').text("");
            $('#std-signup').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Processing ...');

            var data = new FormData();
            var selectednumbers = [];
            var i = 0;
            @foreach ($category as $cat)
                selectednumbers[i] = '{{ $cat->category }}';
            i++;
            @endforeach

            data.append('name', $('input[name=student_name]').val());
            data.append('student_id', $('input[name=stid]').val());
            data.append('admin_id', '1');
            data.append('admin_email', 'onlineexam@gmail.com.com');
            data.append('category', JSON.stringify(selectednumbers));
            data.append('contact', $('input[name=contact]').val());
            data.append('password', $('input[name=password]').val());
            data.append('password_confirmation', $('input[name=password_confirmation]').val());

            $("#error_msg").text('');
            $("#error_msg").addClass('hidden');
            $.ajax({
                type: 'POST',
                url: '/ajaxstudentsignup',
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },

                success: function (data) {

                    $('#std-signup').text("");
                    $('#std-signup').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Connecting ...');
                    //      console.log(data);
                    if (data.errors) {
                        //     alert("err");
                        $("#rerror_msg").removeClass('hidden');
                        if (data.errors.name)
                            $('#rerror_msg').text(data.errors.name);
                        else if (data.errors.student_id)
                            $('#rerror_msg').text(data.errors.student_id);
                        else if (data.errors.contact)
                            $('#rerror_msg').text(data.errors.contact);
                        else if (data.errors.password)
                            $('#rerror_msg').text(data.errors.password);
                        else if (data.errors.password_confirmation)
                            $('#rerror_msg').text(data.errors.password_confirmation);
                        else
                            $('#rerror_msg').text("Unknown Error! pls fill proper detail");

                        $('#std-signup').text("");
                        $('#std-signup').append('Sign Up');
                    } else if (data.msg) {
                        //     alert("err");
                        $('#create').modal('hide');
                        $("#error_msg").removeClass('hidden');
                        $('#error_msg').text("NOW ! You Can Login !");

                    } else {
                        $('#std-signup').text("");
                        $('#std-signup').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Redirecting ...');
                        window.location.replace("/home");
                        //      console.log("ABC");
                    }
                }
            }).fail(function (jqXHR, textStatus, error) {
                $('#std-signup').text("");
                $('#std-signup').append('Sign Up');

                $('#errorModal').modal('show');
            });
        });
    });
</script>
<script>
    // Add Question
    $(document).ready(function () {

        $("#std-login").click(function () {

            $("#std-login").addClass('hidden');
            $('#std-login').text("");
            $('#std-login').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Processing ...');

            var data = new FormData();

            data.append('student_id', $('input[name=loginstudent_id]').val());
            data.append('password', $('input[name=loginpassword]').val());
            data.append('remember', $('input[name=remember]').val());
            $("#error_msg").text('');
            $("#error_msg").addClass('hidden');
            $.ajax({
                type: 'POST',
                url: '/ajaxstudentlogin',
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));
                },

                success: function (data) {


                    $('#std-login').text("");
                    $('#std-login').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Connecting ...');
                    console.log(data);
                    if (data.errors) {
                        //     alert("err");
                        $("#error_msg").removeClass('hidden');
                        $('#error_msg').text("credentials are not correct");
                        $('#std-login').text("");
                        $('#std-login').append('Login');
                    } else {
                        $('#std-login').text("");
                        $('#std-login').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Redirecting ...');
                        window.location.replace("/home");
                        $('#add_question_msg').text("Question Successfully Added");
                        console.log("ABC");
                    }
                }
            }).fail(function (jqXHR, textStatus, error) {

                $('#errorModal').modal('show');
            });
        });
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
</body>
</html>