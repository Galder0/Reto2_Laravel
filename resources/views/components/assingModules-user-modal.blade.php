<!-- Modal -->
<div class="modal fade" id="assignModulesModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="assignModulesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="assignModulesModalLabel">@lang('messages.assign modules to user')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('users.assignModules', $user) }}">
                    @csrf

                    <div class="form-group">
                        <h1><label>@lang('messages.select modules')</label></h1>
                        @foreach ($modules as $module)
                            <div class="form-check">
                                <input type="checkbox" name="modules[]" id="module_{{ $module->id }}" value="{{ $module->id }}" {{ $user->modules->contains($module) ? 'checked' : '' }}>
                                <label for="module_{{ $module->id }}">@lang('messages.' . $module->name)</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('messages.assign modules')</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </div>
    </div>
</div>
