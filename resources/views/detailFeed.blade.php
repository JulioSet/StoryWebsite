@extends('layout.main')
@section('title')
   Detail Feed
@endsection
@section('content')
   <div class="container">
      <div class="text-center mt-3">
         <p class="fs-4">{{ $feed->title }}</p>
         <img src="{{ Storage::url("photo/$feed->photo") }}" style="height: 18rem; width: 15rem">
      </div>
      <p class="card-text">By {{ $feed->writer }}</p>
      <p class="card-text">Posted at {{ $feed->date }}</p>
      <p class="card-text">{{ $feed->likes }} Likes</p>
      <p class="card-text">{{ $feed->duration }} Min Read</p> <br>
      <p>Description :</p>
      <p>{{ $feed->description }}</p> <br>
      <p>Content :</p>
      <p>{{ $feed->content }}</p>
      <a href="/feed"><button type="submit" class="btn btn-primary mb-3">Back</button></a>
   </div>
@endsection
