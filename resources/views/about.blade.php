@extends('layout.main')
@section('title')
   About
@endsection
@section('content')
<div class="text-center mt-5">
   <h2>About</h2>
   <p class="fs-4">Ini adalah website "Story" yang merupakan sebuah platform untuk bercerita, entah itu cerita fiksi ataupun nyata</p>
   <h3>Owner</h3>
   <p class="fs-4">Seorang praktikan FAI bernama Julio dalam jurusan SIB angkatan 2021 yang sedang berjuang menempuh pendidikan di ISTTS</p>
   <img src="{{ asset('img/221180539.png') }}" class="rounded" style="max-width: 12%">
</div>
@endsection