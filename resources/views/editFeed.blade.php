@extends('layout.main')
@section('title')
   Edit Feed
@endsection
@section('content')
<div class="container">
   <div class="p-5">
      <h4>Edit Feed</h4>
      <form method="post" action="/feed/edit/{{ $feed->id }}" enctype="multipart/form-data">
         @csrf
         <input type="file" class="form-control mt-3" name="photo">
         <span style="color: red;">{{ $errors->first('photo') }}</span>

         <input type="text" class="form-control mt-3" name="title" placeholder="Title" value="{{ $feed->title }}">
         <span style="color: red;">{{ $errors->first('title') }}</span>

         <input type="text" class="form-control mt-3" name="duration" placeholder="Duration(Minutes)" value="{{ $feed->duration }}">
         <span style="color: red;">{{ $errors->first('duration') }}</span>

         <textarea class="form-control mt-3" name="description" rows="3" placeholder="Description">{{ $feed->description }}</textarea>
         <span style="color: red;">{{ $errors->first('description') }}</span>

         <textarea class="form-control mt-3" name="story" rows="5" placeholder="Story">{{ $feed->content }}</textarea>
         <span style="color: red;">{{ $errors->first('story') }}</span> <br>

         <button type="submit" class="btn btn-warning mt-3"><b>Save Changes</b></button>
      </form>
   </div>
</div>
@endsection
