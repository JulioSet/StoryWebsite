<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Admin</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://kit.fontawesome.com/94560e2cb9.js" crossorigin="anonymous"></script>
</head>
<body>
   <nav class="navbar navbar-expand-lg bg-warning">
      <div class="container-fluid">
         <img src="{{ asset('img/brand.png') }}" class="navbar-brand" style="max-width: 5%;">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto mb-2 mb-lg-0">
               <a class="nav-link" href="/admin/users">Users</a>
               <a class="nav-link" href="/admin/feeds">Feeds</a>
               <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                   Report
                </a>
                <ul class="dropdown-menu">
                   <li><a class="dropdown-item" href="/admin/report/membership">Membership</a></li>
                </ul>
             </li>
            </div>
            <div class="btn-group" style="width: 10%;">
               <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="{{ asset("img/profile.png") }}" style="width:40%">
               </button>
               <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="#no-need">Profile</a></li>
                  <li><a class="dropdown-item" href="#help-yourself">Help</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <form action="{{ route('logout') }}" method="GET">
                     <li><a class="dropdown-item" href="/logout" style="color: red">Logout</a></li>
                  </form>
               </ul>
            </div>
         </div>
      </div>
   </nav>
   @yield('content')
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
