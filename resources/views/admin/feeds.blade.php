@extends('layout.admin')
@section('content')
<p class="fs-1 text-center mt-3 mb-4">Feeds</p>
<div class="container">
   <table class="table align-middle">
      <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Writer</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Likes</th>
            <th></th>
        </tr>
      </thead>

      @forelse ($listFeed as $key =>$f )
         <tr>
            <td>
                <img src="{{ Storage::url("photo/$f->photo") }}" style="height: 5rem; width: 4rem">
            </td>
            <td>{{ $f->title }}</td>
            <td>{{ $f->writer }}</td>
            <td>{{ $f->date }}</td>
            <td>{{ $f->duration }} Minutes</td>
            <td>{{ $f->likes }}</td>
            <td>
               <button type="button" class="btn btn-danger" id="edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $f->id }}" data-title="{{ $f->title }}" data-duration={{ $f->duration }} data-description="{{ $f->description }}" data-content="{{ $f->content }}">
                  Edit
               </button>
            </td>
         </tr>
      @empty
         <tr>
            <td colspan="9" style="text-align: center;">Tidak ada feed saat ini!</td>
         </tr>
      @endforelse

   </table>
</div>
@include('admin.modal.feedModal')
<script>
   $(document).on("click", "#edit", function () {
      // Get data
      var id = $(this).data('id');
      var title = $(this).data('title');
      var duration = $(this).data('duration');
      var description = $(this).data('description');
      var content = $(this).data('content');
      console.log(content);
      // Binding
      $('#id').val( id );
      $('#title').val( title );
      $('#duration').val( duration );
      $('#description').html( description );
      $('#story').html( content );
   });
</script>
@endsection
