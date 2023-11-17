@extends('layout.main')
@section('title')
   My Feeds
@endsection
@section('content')
<div class="container">
   <h1 class="text-center mt-4 mb-5">My Feeds</h1>
   <div class="position-relative">
      <div class="position-absolute top-0 start-50 translate-middle-x">

         @forelse ($listFeed as $s)
         <div class="card shadow mb-5 bg-body-tertiary rounded" style="width: 60rem;">
            <div class="card-body">
               <div class="d-flex">
                  <img src="{{ Storage::url("photo/$s->photo") }}" style="height: 18rem; width: 15rem">
                  <div class="ms-3">
                     <p class="fs-4">{{ $s->title }}</p>
                     <p class="card-text">By {{ $s->writer }}</p>
                     <p class="card-text">Posted at {{ $s->date }}</p>
                     <p class="card-text">{{ $s->likes }} Likes</p>
                     <p class="card-text">{{ $s->duration }} Min Read</p>
                     <p>{{ $s->description }}</p>
                     <div class="d-flex">
                        <a href="/feed/detail/{{ $s->id }}"><button type="submit" class="btn btn-primary">Detail</button></a>
                        <a href="/feed/edit/{{ $s->id }}"><button type="submit" class="btn btn-danger ms-3">Edit</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @empty
         <div class="text-center">
            <img src="{{ asset('img/emptymystory.png') }}" style="max-width: 15rem" class="mb-3"> <br>
            <p class="fs-4">Hi! You haven't made any feed yet.</p>
            <button type="button" class="btn btn-primary">+ Create a Feed</button>
         </div>
         @endforelse

      </div>
   </div>
</div>
@endsection
