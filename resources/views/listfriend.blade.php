@extends('layout.main')
@section('title')
   Friend
@endsection
@section('content')
<div class="container">
   <h1 class="text-center mt-4 mb-5">Friend</h1>
   <div class="position-relative">
      <div class="position-absolute top-0 start-50 translate-middle-x">

         @forelse ($listfriend as $f)
         <div class="card shadow mb-5 bg-body-tertiary rounded" style="width: 60rem;">
            <div class="card-body">
               <div class="d-flex">
                  @if ($f->pict == null)
                  <img src="{{ asset("img/profile.png") }}" style="height: 8rem; width: 8rem">
                  @else
                  <img class="rounded-circle" src="{{ Storage::url("photo/$f->pict") }}" style="height: 8rem; width: 8rem">
                  @endif
                  <div class="ms-3">
                     <p class="fs-4">{{ $f->username }}</p>
                     <p class="card-text">{{ $f->title }}</p>
                  </div>
               </div>
            </div>
         </div>
         @empty
         <div class="text-center">
               <h1>Masih belum punya teman kamu!</h1>
         </div>
         @endforelse

      </div>
   </div>
</div>
@endsection
