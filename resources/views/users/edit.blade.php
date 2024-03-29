@extends('layouts.admin')

@section('title', 'Edit User')

@section('content-title', 'Edit User')

@section('content')
    <div class="container">
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Add this line to use the PUT method for updates -->

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="surnames">Surnames:</label>
                <input type="text" name="surnames" id="surnames" class="form-control" value="{{ old('surnames', $user->surnames) }}">
            </div>

            <div class="form-group">
                <label for="DNI">DNI:</label>
                <input type="text" name="DNI" id="DNI" class="form-control" value="{{ old('DNI', $user->DNI) }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="direction">Direction:</label>
                <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction', $user->direction) }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
            </div>

            <div class="form-group">
                <label for="fct_dual">FCT Dual:</label>
                <input type="checkbox" name="fct_dual" id="fct_dual" class="form-check-input" value="1" {{ old('fct_dual', $user->fct_dual) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <h5><label>Roles:</label></h5>
                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" class="form-check-input role-checkbox" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="department">Department</label>
                <select id="department" class="form-control" name="department">
                    <option value="">None</option> <!-- Default null option -->
                    <!-- Populate this dropdown with the list of departments from your database -->
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // The JavaScript logic for handling role checkboxes remains the same
        $(document).ready(function() {
            // Initially hide the 'None' option
            hideNoneOption();

            // Toggle 'None' option based on role checkboxes
            $('.role-checkbox').change(function() {
                hideNoneOption();
            });

            function hideNoneOption() {
                var anyRoleSelected = $('.role-checkbox:checked').length > 0;
                var studentRoleSelected = $('#rolestudent').is(':checked');

                // Hide or show the 'None' option based on conditions
                $('#department option[value=""]').prop('disabled', anyRoleSelected && !studentRoleSelected);
            }
        });
    </script>
@endsection
