@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Add Designation</h1>

        <form id="createDesignationForm" action="{{ route('admin.designations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.designations.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#createDesignationForm').submit(function(e) {
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