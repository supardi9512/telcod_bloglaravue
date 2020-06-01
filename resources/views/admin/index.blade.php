<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin dashboard</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
         
  </head>
  <body>
    <div id="app">
      <div class="wrapper">
      <div class="side-menu">
        <div class="logo">
         <h1 class="ch1"> Teluk Coding</h1>
          <p class="cp">Admin Panel | Dashboard</p>     
        </div>

        <!-- Sidebar Menu -->
           
    </div>
  <div class="main-content">
    <div class="topmenu">
      <a href="#" id="showmenu"><i class="fa fa-bars" aria-hidden="true"></i></a>
        <div class="search"><i class="fa fa-search" aria-hidden="true"></i> <input type='text' class='src' placeholder='Search...'/></div>
        <div class="uactions">
        <div class="admin-username"><p>Welcome, {{ Auth::user()->name }}</p> </div>
        <div class="admin-logout">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
          </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf
        </form>
        </div>
      </div>                             
    </div>
      <div class="main-section"> 

        <!-- Jumbotron  -->

        <div class="_container">
         <div class="h_wrap">
          <div class="admin-page-title"></div>
            <div class="jumbotron">
              <h1 class="display-4">Hello, Admin!</h1>
              <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
              <hr class="my-4"> 
              <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
              </p>
            </div>
            </div>
          </div>

       <!-- End Jumbotron  -->

      </div>
     </div>
    </div>
  </div>
   
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> 
  
  </body>
</html>