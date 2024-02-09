<!-- Modal -->
<div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">{{ __('messages.edit user') }} <b>{{$user->name}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT') <!-- Add this line to use the PUT method for updates -->

                    <div class="form-group">
                        <label for="name">{{ __('messages.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="surnames">{{ __('messages.surnames') }}</label>
                        <input type="text" name="surnames" id="surnames" class="form-control" value="{{ old('surnames', $user->surnames) }}">
                    </div>

                    <div class="form-group">
                        <label for="DNI">{{ __('messages.dni') }}</label>
                        <input type="text" name="DNI" id="DNI" class="form-control" value="{{ old('DNI', $user->DNI) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('messages.email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direction">{{ __('messages.direction') }}</label>
                        <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction', $user->direction) }}">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">{{ __('messages.phone number') }}</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
                    </div>

                    <div class="form-group">
                        <label for="fct_dual">{{ __('messages.fct dual') }}</label>
                        <input type="checkbox" name="fct_dual" id="fct_dual" class="form-check-input" value="1" {{ old('fct_dual', $user->fct_dual) ? 'checked' : '' }}>
                    </div>

                    <div class="form-group">
                        <h5><label>{{ __('messages.roles') }}</label></h5>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" class="form-check-input role-checkbox" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="department">{{ __('messages.department') }}</label>
                        <select id="department" class="form-control" name="department">
                            <option value="">{{ __('messages.none') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department', $user->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.update user') }}</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Your existing JavaScript logic can remain the same -->
<script>
    $(document).ready(function() {
        // Your existing JavaScript logic
        // ...

        // Ensure the modal is hidden when the page loads
        $('#editUserModal{{$user->id}}').modal('hide');
    });
</script>
