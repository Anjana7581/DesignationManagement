@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Designations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($designations as $designation)
                <tr>
                    <td>{{ $designation->title }}</td>
                    <td>{{ $designation->status ? 'Active' : 'Inactive' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
