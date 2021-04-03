<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Complaint Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous"
    />
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #f8fafc;
            /* color: #636b6f; */
            font-family: "Nunito", sans-serif;
            font-weight: 400;
            height: 100vh;
            margin: 0;

            --primary-color: #6c757d;
            --info :  #17a2b8;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .full-width{
            height: 100vh;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 0.9rem;

        }

        .bg-info {
            background-color: var(--info) !important;
        }

        .m-b-md {
            margin-bottom: 30px;
        }


        .navbar {
            background-color: #fff;
            font-size: 0.9rem;
        }

        .complaint-banner{
            /* background: linear-gradient(to right, purple, blue); */
            /* background-color: #21D4FD;
            background-image: linear-gradient(19deg, #21D4FD 0%, #B721FF 100%); */
            background-color: #0093E9;
            background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);




            color: whitesmoke;
        }

        .complaint-banner .container{
            display: flex;
        }

        .complaint-banner .container .row {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .complaint-banner .banner-image{
            position: relative
        }

        .score{
            background-color: #0093E9;
            /* background-image: linear-gradient(160deg, #0093f9 0%, #80D0d7 100%); */
            font-size: 20px;
            font-weight: 300;
            font-family: monospace;
            color: white;
            padding: 6px 0px 6px 0px;
        }





    </style>
</head>
<body>
<!-- our navbar -->
<div class="my-navbar">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Complaint Register
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Authentication Links -->

                    @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link"  href="{{ url('/home') }}">Home</a></li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link"  href="{{ route('login') }}">Login</a></li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('register') }}">Register</a></li></ul>
                                @endif
                            @endauth
                        </div>
                @endif
            </div>
           </nav>
</div>


<!-- Main div-->
<!-- <div class="flex-center position-ref full-height welcome">
    <div class="jumbotron container text-center">
        <h1 class="display-4">Welcome to Complaint Register!!!</h1>
        <p class="lead">
            An Online portal to register complaints of NIT Hamirpur
        </p>
        <hr class="my-4" />
        <p class="justify-content-center">Scroll down to know more</p>
    </div>
</div> -->
<div class="complaint-banner">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="display-4"> NITH Complaint Registration Portal</h1>
                <div class="row mt-5">
                    @auth

                    @else
                        <div class="col-6"><a class="nav-link" href="{{ route('register') }}"><button class="btn btn-warning btn-lg pl-5 pr-5 pt-2 pb-2">Register</button></a></div>
                    <div class="col-6"><a class="nav-link" href="{{ route('login') }}"><button class="btn btn-primary btn-lg pl-5 pr-5 pt-2 pb-2">Login</button></a></div>
                    @endauth
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <img src="images/banner-side-img.png" class="banner-image">
            </div>
        </div>

    </div>
</div>

<div class="container stats">
    <div class="row mt-5">
        <div class="col-6 text-center font-weight-bold">
            <p class="display-5">Number of Complaints Registered: </p>
            <div class="score">{{\App\User::count()}}</div>
        </div>
        <div class="col-6 text-center font-weight-bold">
            <p class="display-5 ">Number of Students Registered:</p>
            <div class="score">{{\App\Complaint::count()}}</div>
        </div>
    </div>


</div>





<!-- lets do this section now  -->
<div
    class="about full-height flex-center position-ref container text-center"
>
    <div>
        <h1 class="display-3">About us</h1>
        <p class="display-4">
            We are trying solve maximum complaints of the students
        </p>
        <p class="lead">
            This is an online portal for complaint registration in NIT Hamirpur.
        </p>
    </div>
</div>

<!-- bootstrap imports -->
<script
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"
></script>
<script src="app.js"></script>
</body>
</html>
