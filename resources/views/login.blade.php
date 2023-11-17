@extends('layout.main')
@section('title')
   Login
@endsection
@section('content')
<div class="container mt-5">
   <div class="card w-25 m-auto">
      <div class="card-body">
         <h5 class="card-title fs-1 text-center">LOGIN</h5>

         <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
               <label class="form-label">Username</label>
               <input type="text" class="form-control" name="username">
               <span style="color: red;">{{ $errors->first('username') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Password</label>
               <input type="password" class="form-control" name="password">
               <span style="color: red;">{{ $errors->first('password') }}</span>
            </div>

            <div class="mb-3">
               <input class="form-check-input" type="checkbox" name="rememberme" value="true">
               <label class="form-check-label" for="rememberme">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit()">Login</button>
         </form>
         <a href="/register">Don't have an account yet?</a> <br>
      </div>
   </div>
</div>
@endsection
