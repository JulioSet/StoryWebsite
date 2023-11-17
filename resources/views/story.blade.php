@extends('layout.main')
@section('title')
   Feed
@endsection
@section('content')
<div class="container">
<h1 class="text-center mt-4 mb-5">Feed</h1>
<div class="position-relative">
   <div class="position-absolute top-0 start-50 translate-middle-x">
      <form action="/feed" method="post" class="form-control mb-4">
         @csrf
         <div class="d-flex align-items-center">
            <span class="fa-solid fa-magnifying-glass"></span>
            <input type="text" class="form-control border-0 shadow-none" name="search" placeholder="Search Feed">
         </div>
      </form>

      @forelse ($listFeed as $s)
      <div class="card shadow mb-5 bg-body-tertiary rounded" style="width: 60rem;">
         <div class="card-body">
            <div class="d-flex">
               <img src="{{ Storage::url("photo/".$s['photo']) }}" style="height: 18rem; width: 15rem">
               <div class="ms-3">
                  <p class="fs-4">{{ $s['title'] }}</p>
                  <p class="card-text">By {{ $s['writer'] }}</p>
                  <p class="card-text">Posted at {{ $s['date'] }}</p>
                  <p class="card-text">{{ $s['likes'] }} Likes</p>
                  <p class="card-text">{{ $s['duration'] }} Min Read</p>
                  <p>{{ $s['description'] }}</p>
                  <div class="d-flex">
                        <a href="/feed/detail/{{ $s['id'] }}"><button type="submit" class="btn btn-primary me-3">Detail</button></a>
                        @if ($s['like'] == 0)
                        <form action="/like/{{ $s['id'] }}" method="post">
                           @csrf
                           <button type="submit" class="btn btn-outline-danger me-3" onclick="this.disabled=true;this.form.submit()">Like</button>
                        </form>
                        @else
                        <button type="submit" class="btn btn-danger me-3">Liked</button>
                        @endif
                        @if ($s['status'] == 0)
                        <form action="/bookmark/{{ $s['id'] }}" method="post">
                           @csrf
                           <button type="submit" class="btn btn-success" onclick="this.disabled=true;this.form.submit()">Bookmark</button>
                        </form>
                        @else
                        <button type="submit" class="btn btn-secondary" disabled>Bookmarked</button>
                        @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      @empty
      <div class="text-center">
         <h1>Feed tidak ditemukan!</h1>
      </div>
      @endforelse

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
            <p>Buy membership first!</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
@endif
@endsection
