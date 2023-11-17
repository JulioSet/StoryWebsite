@extends('layout.main')
@section('title')
   Create a Story
@endsection
@section('content')
<div class="container">
   <div class="p-5">
      <h4>Create Feed</h4>
      <form method="post" action="{{ route('create-feed') }}" enctype="multipart/form-data">
         @csrf
         <input type="file" class="form-control mt-3" name="photo">
         <span style="color: red;">{{ $errors->first('photo') }}</span>

         <input type="text" class="form-control mt-3" name="title" placeholder="Title" value="{{ old('title') }}">
         <span style="color: red;">{{ $errors->first('title') }}</span>

         <input type="text" class="form-control mt-3" name="duration" placeholder="Duration(Minutes)" value={{ old('duration') }}>
         <span style="color: red;">{{ $errors->first('duration') }}</span>

         <textarea class="form-control mt-3" name="description" rows="3" placeholder="Description">{{ old('description') }}</textarea>
         <span style="color: red;">{{ $errors->first('description') }}</span>

         <textarea class="form-control mt-3" name="story" rows="5" placeholder="Story">{{ old('story') }}</textarea>
         <span style="color: red;">{{ $errors->first('story') }}</span> <br>

         <button type="submit" class="btn btn-warning mt-3" onclick="this.disabled=true;this.form.submit()"><b>Publish</b></button>
      </form>
   </div>
</div>
@endsection
