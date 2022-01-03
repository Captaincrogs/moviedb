<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dept/Aimane</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
 
    </head>
    <body id="page-top">
        
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/">Dept Agency</a>
                @if (Auth::user())
                <form id="content" action="movies/search" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="search"  name="title" class="input" id="search-input">
                    <button type="reset" class="search" id="search-btn"></button>
                    </form>

                    <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                @endif
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        {{-- if user is logged in show only this two else hide othe stuff --}}
                        @if (Auth::user())
                        <li class="nav-item"><a class="nav-link" href="/">home</a></li>
                        <li class="nav-item"><a class="nav-link" href="movies">movies</a></li>
                        <li class="nav-item"><a class="nav-link" href="home">Account</a></li>
                        @else
                        <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
                        <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                        @endif

                    </ul>
                </div>
            </div>
            
        </nav>