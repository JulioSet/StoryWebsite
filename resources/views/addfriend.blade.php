@extends('layout.main')
@section('title')
   Add Friend
@endsection
@section('content')
<div class="container">
   <h1 class="text-center mt-4 mb-5">Search Friend</h1>
   <div class="position-relative">
      <div class="position-absolute top-0 start-50 translate-middle-x">

         @forelse ($listuser as $u)
         <div class="card shadow mb-5 bg-body-tertiary rounded" style="width: 60rem;">
            <div class="card-body">
               <div class="d-flex">
                  @if ($u['pict'] == null)
                  <img src="{{ asset("img/profile.png") }}" style="height: 8rem; width: 8rem">
                  @else
                  <img class="rounded-circle" src="{{ Storage::url("photo/".$u['pict']) }}" style="height: 8rem; width: 8rem">
                  @endif
                  <div class="ms-3">
                     <p class="fs-4">{{ $u['username'] }}</p>
                     <p class="card-text">{{ $u['title'] }}</p>
                     @if ($u['status'] == 0)
                     <form action="/friend/add/{{ $u['id'] }}" method="post">
                           @csrf
                           <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit()">Add</button>
                     </form>
                     @else
                     <button type="submit" class="btn btn-secondary" disabled>Add</button>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         @empty
         <div class="text-center">
            <h1>Masih belum ada user lain!</h1>
         </div>
         @endforelse

      </div>
   </div>
</div>
@endsection
