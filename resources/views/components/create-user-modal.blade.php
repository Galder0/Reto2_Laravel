<!-- create-user-modal.blade.php -->

<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="{{ route('users.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="surnames">Surnames:</label>
                <input type="text" name="surnames" id="surnames" class="form-control" value="{{ old('surnames') }}">
            </div>

            <div class="form-group">
                <label for="DNI">DNI:</label>
                <input type="text" name="DNI" id="DNI" class="form-control" value="{{ old('DNI') }}">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="direction">Direction:</label>
                <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
            </div>

            <hr>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="fct_dual" id="fct_dual" class="form-check-input" value="1" {{ old('fct_dual') ? 'checked' : '' }}>
                    <label for="fct_dual" class="form-check-label">FCT Dual:</label>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <h5><label>Roles:</label></h5>
                @foreach($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" class="form-check-input role-checkbox">
                        <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" class="form-control" name="department">
                            <option value="">None</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>