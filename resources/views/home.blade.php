@extends('layout.main')
@section('title')
   Home
@endsection
@section('style')
   style="background-image: url('{{ asset('img/bghome.jpg') }}');"
@endsection
@section('content')
<div class="overflow-x-hidden mt-5">
   <div class="row p-5">
      <div class="col mt-5">
         <h1>Hola, selamat datang di situs ini</h1>
         <h3>Platform sosial untuk bercerita</h3>
         <p class="fs-5">Story menghubungkan sebuah komunitas kampus ISTTS yang berisikan gatau jumlahnya berapa</p>
         @if (Session::has('userLoggedIn'))
            @if ($state == 0)
            <a href="/membership"><button class="btn btn-success">Buy Membership!</button></a>
            @else
            <a href="#"><button class="btn btn-secondary" disabled>Already a Member!</button></a>
            @endif
         @endif
      </div>
      <div class="col">
         <img src="{{ asset('img/landing.png') }}" style="max-width: 90%">
      </div>
   </div>
</div>

@if (Session::has('msg'))
   <script>
      $(document).ready(function(){
         $("#myModal").modal('show');
      });
   </script>

   <div class="modal fade" id="myModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p>Your balance is insufficient!</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
      </div>
   </div>
@endif
@endsection
