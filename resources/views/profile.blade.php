@extends('layout.main')
@section('title')
    Profile
@endsection
@section('content')
<div class="container">
    <div class="card m-auto mt-5 mb-5">
        <div class="card-body">
            <h5 class="card-title text-center fs-3">Profile</h5>

            @if ($user->pict == null)
            <img class="mx-auto d-block" src="{{ asset("img/profile.png") }}" style="max-width: 20%">
            @else
            <img class="rounded-circle mx-auto d-block mt-4 mb-4" src="{{ Storage::url("photo/$user->pict") }}" alt="" width="200em" height="200em">
            @endif
            <div class="row">
            <div class="col-2">
                <p class="card-text">Title</p>
                <p class="card-text">Username</p>
                <p class="card-text">Email</p>
                <p class="card-text">Gender</p>
                <p class="card-text">Tanggal Lahir</p>
                <p class="card-text">Deskripsi Diri</p>
            </div>
            <div class="col-10">
                <p class="card-text">: {{ $user->title }}</p>
                <p class="card-text">: {{ $user->username }}</p>
                <p class="card-text">: {{ $user->email }}</p>
                @if ($user->gender == 'm')
                    <p class="card-text">: Male</p>
                @else
                    <p class="card-text">: Female</p>
                @endif
                <p class="card-text">: {{ $user->bod }}</p>
                <p class="card-text">: {{ $user->description }}</p>
            </div>
            </div> <br>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Edit Profile
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit-profile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Profile</label>
                                <input type="file" class="form-control" name="photo">
                                <span style="color: red;">{{ $errors->first('photo') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                                <span style="color: red;">{{ $errors->first('username') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <span style="color: red;">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="old_password">
                                <span style="color: red;">{{ $errors->first('old_password') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password">
                                <span style="color: red;">{{ $errors->first('password') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                <span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label> <br>
                                @if ($user->gender == 'm')
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="m" checked>
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="f">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div> <br>
                                @else
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="m">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="f" checked>
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div> <br>
                                @endif
                                <span style="color: red;">{{ $errors->first('gender') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="bod" value={{ $user->bod }}>
                                <span style="color: red;">{{ $errors->first('bod') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Julukan</label>
                                <input type="text" class="form-control" name="title" value="{{ $user->title }}">
                                <span style="color: red;">{{ $errors->first('title') }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi Diri</label>
                                <textarea type="text" class="form-control" name="description">{{ $user->description }}</textarea>
                                <span style="color: red;">{{ $errors->first('description') }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
