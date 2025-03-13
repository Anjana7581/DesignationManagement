@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Edit User</h1>

        <form id="editUserForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                <span class="text-danger" id="name-error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                <span class="text-danger" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
                <span class="text-danger" id="contact_number-error"></span>
            </div>
            <div class="form-group">
                <label for="alt_contact_number">Alternative Contact Number</label>
                <input type="text" class="form-control" id="alt_contact_number" name="alt_contact_number" value="{{ $user->alt_contact_number }}">
                <span class="text-danger" id="alt_contact_number-error"></span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ $user->address }}</textarea>
                <span class="text-danger" id="address-error"></span>
            </div>
            <div class="form-group">
                <label for="designation_id">Designation</label>
                <select class="form-control" id="designation_id" name="designation_id">
                    <option value="">Select Designation</option>
                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}" {{ $user->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->title }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="designation_id-error"></span>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                <span class="text-danger" id="status-error"></span>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editUserForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Clear previous error messages
                $('#name-error, #email-error, #contact_number-error, #alt_contact_number-error, #address-error, #designation_id-error, #status-error').text('');

                let isValid = true;

                // Step 1: Validate Name Field
                var name = $('#name').val();
                if (name.trim() === '') {
                    $('#name-error').text('Name is required.');
                    isValid = false; // Set isValid to false if validation fails
                }

                // Step 2: Validate Email Field
                var email = $('#email').val();
                var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!emailRegex.test(email)) {
                    $('#email-error').text('Please enter a valid email address.');
                    isValid = false;
                }

                // Step 3: Validate Contact Number (if provided)
                var contactNumber = $('#contact_number').val();
                if (contactNumber && contactNumber.length !== 10) {
                    $('#contact_number-error').text('Contact number must be 10 digits.');
                    isValid = false;
                }

                // Step 4: Validate Alternative Contact Number (if provided)
                var altContactNumber = $('#alt_contact_number').val();
                if (altContactNumber && altContactNumber.length !== 10) {
                    $('#alt_contact_number-error').text('Alternative contact number must be 10 digits.');
                    isValid = false;
                }

                // Step 5: Validate Address Field
                var address = $('#address').val();
                if (address.trim() === '') {
                    $('#address-error').text('Address cannot be empty.');
                    isValid = false;
                }

                // Step 6: Validate Designation
                var designation = $('#designation_id').val();
                if (designation === '') {
                    $('#designation_id-error').text('Please select a designation.');
                    isValid = false;
                }

                // Step 7: Validate Status Field
                var status = $('#status').val();
                if (status === '') {
                    $('#status-error').text('Please select a status.');
                    isValid = false;
                }

                // If everything is valid, proceed with AJAX submission
                if (isValid) {
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                window.location.href = "{{ route('admin.users.index') }}";
                            } else {
                                alert('There was an issue updating the user.');
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                } else {
                    alert('Please fix the validation errors before submitting the form.');
                }
            });
        });
    </script>
@endsection
