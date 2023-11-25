@extends('layout.admin')
@section('content')
<p class="fs-1 text-center mt-3 mb-4">Users</p>
<div class="container">
   <table class="table align-middle">
      <thead>
        <tr>
            <th>Profile</th>
            <th>Title</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Birthday</th>
            <th>Description</th>
            <th></th>
            <th></th>
        </tr>
      </thead>

      @forelse ($listUser as $key => $u)
         @if ($u->username != 'admin')
         <tr>
            <td>
                @if ($u->pict == null)
                <img src="{{ asset("img/profile.png") }}" style="height: 4rem; width: 4rem">
                @else
                <img class="rounded-circle" src="{{ Storage::url("photo/$u->pict") }}" style="height: 4rem; width: 4rem">
                @endif
            </td>
            <td>{{ $u->title }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            @if ($u->gender == 'm')
               <td>Male</td>
            @else
               <td>Female</td>
            @endif
            <td>{{ $u->bod }}</td>
            <td>{{ $u->description }}</td>
            <td>
               <button type="button" class="btn btn-primary" id="edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $u->id }}" data-title="{{ $u->title }}" data-username="{{ $u->username }}" data-email="{{ $u->email }}" data-password="{{ $u->password }}" data-gender="{{ $u->gender }}" data-bod="{{ $u->bod }}" data-description="{{ $u->description }}">
                  Edit
               </button>
            </td>
            <td>
                @if ($u->status == 1)
                <a href="/lock/{{ $u->id }}"><button type="button" class="btn btn-success"><i class="fa-solid fa-lock-open"></i></button></a>
                @else
                <a href="/unlock/{{ $u->id }}"><button type="button" class="btn btn-danger"><i class="fa-solid fa-lock"></i></button></a>
                @endif
            </td>
         </tr>
         @endif
      @empty
         <tr>
            <td colspan="8" style="text-align: center;">Tidak ada user saat ini!</td>
         </tr>
      @endforelse

   </table>
</div>
@include('admin.modal.userModal')
<script>
   $(document).on("click", "#edit", function () {
      // Get data
      var id = $(this).data('id');
      var title = $(this).data('title');
      var username = $(this).data('username');
      var email = $(this).data('email');
      var password = $(this).data('password');
      var gender = $(this).data('gender');
      var bod = $(this).data('bod');
      var description = $(this).data('description');

      // Binding
      $('#id').val( id );
      $('#title').val( title );
      $('#username').val( username );
      $('#email').val( email );
      $('#password').val( password );
      if (gender == 'm') {
         $('#genderM').attr( 'checked', true );
      }
      else
      {
         $('#genderF').attr( 'checked', true );
      }
      $('#bod').val( bod );
      $('#description').html( description );
   });
</script>
@endsection
