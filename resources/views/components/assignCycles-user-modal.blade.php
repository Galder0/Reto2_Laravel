<!-- Modal -->
<div class="modal fade" id="assignCyclesModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="assignCyclesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="assignCyclesModalLabel">@lang('messages.assign cycles to') <b>{{$user->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('users.assignCycles', $user) }}">
                    @csrf

                    <div class="form-group">
                        <h1><label>@lang('messages.select cycles')</label></h1>
                        @foreach ($cycles as $cycle)
                            <div class="form-check">
                                <input type="checkbox" name="cycles[]" id="cycle_{{ $cycle->id }}" value="{{ $cycle->id }}" {{ $user->cycles->contains($cycle) ? 'checked' : '' }}>
                                <label for="cycle_{{ $cycle->id }}">@lang('messages.' . $cycle->name)</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('messages.assign cycles')</button>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('messages.close')</button>
            </div>
        </div>
    </div>
</div>
