<!-- create-user-modal.blade.php -->

<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">@lang('create new user')</h5>
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
                        <label for="name">@lang('name')</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="surnames">@lang('surnames')</label>
                        <input type="text" name="surnames" id="surnames" class="form-control" value="{{ old('surnames') }}">
                    </div>

                    <div class="form-group">
                        <label for="DNI">@lang('dni')</label>
                        <input type="text" name="DNI" id="DNI" class="form-control" value="{{ old('DNI') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">@lang('email')</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direction">@lang('direction')</label>
                        <input type="text" name="direction" id="direction" class="form-control" value="{{ old('direction') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">@lang('phone number')</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="fct_dual" id="fct_dual" class="form-check-input" value="1" {{ old('fct_dual') ? 'checked' : '' }}>
                            <label for="fct_dual" class="form-check-label">@lang('fct dual')</label>
                        </div>
                        <input type="hidden" name="fct_dual" value="0"> <!-- Hidden input to ensure '0' is sent if checkbox is unchecked -->
                    </div>
                    <hr>

                    <div class="form-group">
                        <h5><label>@lang('roles')</label></h5>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" class="form-check-input role-checkbox">
                                <label for="role{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="department">@lang('department')</label>
                        <select id="department" class="form-control" name="department">
                            <option value="">@lang('none')</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('create user')</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('close')</button>
            </div>
        </div>
    </div>
</div>

