@extends('layout.main')
@section('title')
   Top Up
@endsection
@section('content')
<div class="container mt-5">
   <div class="card w-25 m-auto">
      <div class="card-body text-center">
         <h5 class="card-title fs-1 mb-3">TOP UP</h5>

         <form action="/topup" method="post">
            @csrf
            <input type="hidden" name="id" value={{ Session::get('userLoggedIn') }}>
            <div class="mb-3">
               <input type="text" class="form-control" name="topup">
               <span style="color: red;">{{ $errors->first('topup') }}</span>
            </div>

            <button type="submit" class="btn btn-primary">Top Up</button>
         </form>
      </div>
   </div>
</div>
@endsection
