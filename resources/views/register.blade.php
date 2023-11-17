@extends('layout.main')
@section('title')
   Register
@endsection
@section('content')
<div class="container mt-5">
   <div class="card w-50 m-auto">
      <div class="card-body">
         <h5 class="card-title fs-1 text-center">REGISTER</h5>

         <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
               <label class="form-label">Username</label>
               <input type="text" class="form-control" name="username" value="{{ old('username') }}">
               <span style="color: red;">{{ $errors->first('username') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Email</label>
               <input type="email" class="form-control" name="email" value="{{ old('email') }}">
               <span style="color: red;">{{ $errors->first('email') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Password</label>
               <input type="password" class="form-control" name="password" value={{ old('password') }}>
               <span style="color: red;">{{ $errors->first('password') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Confirm Password</label>
               <input type="password" class="form-control" name="password_confirmation">
               <span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Gender</label> <br>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="m">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="f">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
               </div> <br>
               <span style="color: red;">{{ $errors->first('gender') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Tanggal Lahir</label>
               <input type="date" class="form-control" name="bod" value={{ old('bod') }}>
               <span style="color: red;">{{ $errors->first('bod') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Julukan</label>
               <input type="text" class="form-control" name="title" value="{{ old('title') }}">
               <span style="color: red;">{{ $errors->first('title') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Deskripsi Diri</label>
               <textarea type="text" class="form-control" name="description" value="{{ old('description') }}"></textarea>
               <span style="color: red;">{{ $errors->first('description') }}</span>
            </div>

            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit()">Register</button>
         </form>

         <a href="/login">Already have an account?</a>
      </div>
   </div>
</div>
@endsection
