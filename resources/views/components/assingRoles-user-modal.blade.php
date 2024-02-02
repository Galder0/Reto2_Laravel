<!-- Modal -->
<div class="modal fade" id="assignRolesModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="assignRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="assignRolesModalLabel">{{ __('messages.assign roles to') }} <b>{{ $user->name }}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('users.assignRoles', $user) }}">
                    @csrf

                    <div class="form-group">
                        <h1><label>{{ __('messages.select roles') }}</label></h1>
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}"
                                    {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                    {{ $user->hasRole('student') && $role->name !== 'student' ? 'disabled' : '' }}>
                                <label for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.assign roles') }}</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div>
    </div>
</div>