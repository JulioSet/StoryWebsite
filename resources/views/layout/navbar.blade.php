<nav class="navbar navbar-expand-lg bg-warning">
<div class="container-fluid">
   <img src="{{ asset('img/brand.png') }}" class="navbar-brand" style="max-width: 5%;">
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
         </li>

         @if (Session::has('userLoggedIn'))
         <li class="nav-item">
            <a class="nav-link" href="/feed">Feed</a>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
               Write
            </a>
            <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="/feed/add">Create a New Feed</a></li>
               <li><a class="dropdown-item" href="/myfeeds">My Feeds</a></li>
            </ul>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/feed/bookmark">Bookmark</a>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
               Friend
            </a>
            <ul class="dropdown-menu">
               <li><a class="dropdown-item" href="/friend/add">Add New Friend</a></li>
               <li><a class="dropdown-item" href="/friend/list">My Friends</a></li>
            </ul>
         </li>
         @endif

         <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
         </li>
      </ul>

      @if (Session::has('userLoggedIn'))
      <a href="/topup" class="text-muted text-decoration-none">
         <div class="d-flex align-items-center">
            <img src="{{ asset('img/wallet.png') }}" class="me-2" style="width: 2.5em">
            <div>
               <b class="m-0 p-0">Rp {{ Session::get('saldo') }}</b>
               <p class="m-0 p-0" style="font-size: 0.7em">Top up</p>
            </div>
         </div>
      </a>
      <div class="btn-group" style="width: 10%;">
         <button type="button" class="nav-link dropdown-toggle p-0" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Session::has('profile'))
            <img class="rounded-circle ms-5" src="{{ Storage::url("photo/".Session::get('profile')) }}" alt="" width="40em" height="40em">
            @else
            <img class="ms-3" src="{{ asset("img/profile.png") }}" style="width:40%">
            @endif
         </button>
         <ul class="dropdown-menu dropdown-menu-lg-end">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="#help-yourself">Help</a></li>
            <li><hr class="dropdown-divider"></li>
            <form action="{{ route('logout') }}" method="GET">
               <li><a class="dropdown-item" href="/logout" style="color: red">Logout</a></li>
            </form>
         </ul>
      </div>
      @else
      <a class="nav-link" href="/login">Login</a>
      @endif

   </div>
</div>
</nav>
