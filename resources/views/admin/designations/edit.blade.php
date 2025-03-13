@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Edit Designation</h1>

        <form id="editDesignationForm" action="{{ route('admin.designations.update', $designation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $designation->title }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ $designation->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $designation->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.designations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editDesignationForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = "{{ route('admin.designations.index') }}";
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection