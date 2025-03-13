@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Designations</h1>

        <!-- Button to trigger Add/Edit form -->
        <button type="button" id="addDesignationBtn" class="btn btn-primary">Add Designation</button>

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
                            <button class="btn btn-warning edit-btn" data-id="{{ $designation->id }}" data-title="{{ $designation->title }}" data-status="{{ $designation->status }}">Edit</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add/Edit Designation Modal -->
        <div class="modal fade" id="designationModal" tabindex="-1" role="dialog" aria-labelledby="designationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="designationForm" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="designationModalLabel">Add Designation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Handle Add Designation
            $('#addDesignationBtn').click(function() {
                $('#designationModalLabel').text('Add Designation');
                $('#designationForm')[0].reset();
                $('#designationForm').attr('action', '{{ route('designations.store') }}');
                $('#designationModal').modal('show');
            });

            // Handle Edit Designation
            $('.edit-btn').click(function() {
                let id = $(this).data('id');
                let title = $(this).data('title');
                let status = $(this).data('status');

                $('#designationModalLabel').text('Edit Designation');
                $('#title').val(title);
                $('#status').val(status);
                $('#designationForm').attr('action', '/designations/' + id);

                $('#designationModal').modal('show');
            });

            // Handle form submission with Ajax
            $('#designationForm').submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let action = form.attr('action');
                let method = action.includes('edit') ? 'PUT' : 'POST';

                $.ajax({
                    url: action,
                    method: method,
                    data: form.serialize(),
                    success: function(response) {
                        alert(response.message);
                        location.reload(); // Reload page to see the changes
                    },
                    error: function(response) {
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>
@endsection
