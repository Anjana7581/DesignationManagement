@extends('adminlte::page')

@section('content')
    <div class="container">
        <h1>Add User</h1>

        <!-- Success Message -->
        <div id="success-message" class="alert alert-success" style="display: none;"></div>

        <!-- Error Message -->
        <div id="error-message" class="alert alert-danger" style="display: none;"></div>

        <form id="createUserForm" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                <span class="text-danger" id="name-error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                <span class="text-danger" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number') }}">
                <span class="text-danger" id="contact_number-error"></span>
            </div>
            <div class="form-group">
                <label for="alt_contact_number">Alternative Contact Number</label>
                <input type="text" class="form-control" id="alt_contact_number" name="alt_contact_number" value="{{ old('alt_contact_number') }}">
                <span class="text-danger" id="alt_contact_number-error"></span>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                <span class="text-danger" id="address-error"></span>
            </div>
            <div class="form-group">
                <label for="designation_id">Designation</label>
                <select class="form-control" id="designation_id" name="designation_id">
                    <option value="">Select Designation</option>
                    @foreach($designations as $designation)
                        <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>{{ $designation->title }}</option>
                    @endforeach
                </select>
                <span class="text-danger" id="designation_id-error"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="text-danger" id="password-error"></span>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                <span class="text-danger" id="status-error"></span>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Ajax Script -->
    <script>
$(document).ready(function() {
    $('#createUserForm').submit(function(e) {
        e.preventDefault();

        // Clear previous error messages
        $('#name-error, #email-error, #contact_number-error, #alt_contact_number-error, #address-error, #designation_id-error, #password-error, #status-error').text('');

        // Step 1: Validate Name Field
        var name = $('#name').val();
        var nameRegex = /^[A-Za-z]{3,}$/; // Name must be at least 3 characters and alphabetic
        if (!nameRegex.test(name)) {
            $('#name-error').text('Name must contain only alphabetic characters and be at least 3 characters long.');
            $('#name').focus(); // Focus on the field with error
            return; // Stop form submission if validation fails
        }

        // Step 2: Validate Email Field
        var email = $('#email').val();
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailRegex.test(email)) {
            $('#email-error').text('Please enter a valid email address.');
            $('#email').focus();
            return; // Stop form submission if validation fails
        }

        // Step 3: Validate Contact Number Field (if filled)
        var contactNumber = $('#contact_number').val();
        if (contactNumber && contactNumber.length !== 10) {
            $('#contact_number-error').text('Contact number must be 10 digits.');
            $('#contact_number').focus();
            return; // Stop form submission if validation fails
        }

        // Step 4: Validate Password Field
        var password = $('#password').val();
        if (password.length < 8) {
            $('#password-error').text('Password must be at least 8 characters.');
            $('#password').focus();
            return; // Stop form submission if validation fails
        }

        // Step 5: Proceed with AJAX submission
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = "{{ route('admin.users.index') }}";
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Display the validation error messages
                    $.each(xhr.responseJSON.errors, function(field, messages) {
                        $('#' + field + '-error').text(messages[0]);
                    });
                } else {
                    alert('An error occurred. Please try again.');
                }
            }
        });
    });
});
</script>


@endsection