@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->designation}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
