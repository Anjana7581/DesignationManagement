@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Manage Designations</h1>

        <!-- Button to navigate to the create page -->
        <a href="{{ route('admin.designations.create') }}" class="btn btn-primary">Add Designation</a>

        <table class="table mt-4" id="designationsTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                    <tr>
                        <td>{{ $designation->title }}</td>
                        <td>{{ $designation->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('admin.designations.edit', $designation->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection