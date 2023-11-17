@extends('layout.admin')
@section('content')
<p class="fs-1 text-center mt-3 mb-4">Transaction Membership</p>
<div class="container">

<div class="card mb-3">
    <div class="card-header">Total Transaction : Rp {{ $total }}</div>
</div>

<table class="table align-middle">
    <thead>
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Total</th>
            <th>Date</th>
        </tr>
    </thead>

    @forelse ($transaction as $t)
        <tr>
            <td>{{ $t['id_user'] }}</td>
            <td>{{ $t['username'] }}</td>
            <td>Rp {{ $t['total'] }}</td>
            <td>{{ $t['created_at'] }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="2" style="text-align: center;">Tidak ada transaction yang terjadi!</td>
        </tr>
    @endforelse

</table>
</div>
@endsection
