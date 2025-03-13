@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>

        <!-- Filters -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="alphabeticOrderFilter">Alphabetic Order</label>
                <select id="alphabeticOrderFilter" class="form-control">
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="designationFilter">Designation</label>
                <select id="designationFilter" class="form-control">
                    <option value="">All</option>
                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="statusFilter">Status</label>
                <select id="statusFilter" class="form-control">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- User List -->
        <table class="table" id="usersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->designation->title ?? 'N/A' }}</td>
                        <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add User Button -->
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // In your Blade view

<script>
    $(document).ready(function() {
        // Handle filter changes
        $('#alphabeticOrderFilter, #designationFilter, #statusFilter').change(function() {
            let alphabeticOrder = $('#alphabeticOrderFilter').val();
            let designationId = $('#designationFilter').val();
            let status = $('#statusFilter').val();

            $.ajax({
                url: "{{ route('admin.users.filter') }}",  // Make sure this matches the route URL
                method: 'GET',  // Use GET instead of POST
                data: {
                    alphabetic_order: alphabeticOrder,
                    designation_id: designationId,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    let users = response.users;
                    let html = '';
                    users.forEach(user => {
                        html += `
                            <tr>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.contact_number}</td>
                                <td>${user.designation ? user.designation.title : 'N/A'}</td>
                                <td>${user.status ? 'Active' : 'Inactive'}</td>
                                <td>
                                    <a href="/admin/users/${user.id}/edit" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        `;
                    });
                    $('#usersTable tbody').html(html);
                }
            });
        });
    });

</script>
@endsection
