@if (auth()->user()->hasPermission('block_parents'))
    @if (!$parent->blocked_at)
        <a href="#parent-{{ $parent->id }}-block-model" class="btn btn-light" data-toggle="modal">
            <i class="fa fa-ban"></i>
            @lang('accounts::parents.actions.block')
        </a>


        <!-- Modal -->
        <div class="modal fade" id="parent-{{ $parent->id }}-block-model" tabindex="-1" role="dialog"
            aria-labelledby="modal-title-{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-{{ $parent->id }}">@lang('accounts::parents.dialogs.block.title')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('accounts::parents.dialogs.block.info')
                    </div>
                    <div class="modal-footer">
                        {{ BsForm::patch(route('dashboard.parents.block', $parent)) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang('accounts::parents.dialogs.block.cancel')
                        </button>
                        <button type="submit" class="btn btn-danger">
                            @lang('accounts::parents.dialogs.block.confirm')
                        </button>
                        {{ BsForm::close() }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="#parent-{{ $parent->id }}-unblock-model" class="btn btn-light" data-toggle="modal">
            <i class="fa fa-check"></i>
            @lang('accounts::parents.actions.unblock')
        </a>


        <!-- Modal -->
        <div class="modal fade" id="parent-{{ $parent->id }}-unblock-model" tabindex="-1" role="dialog"
            aria-labelledby="modal-title-{{ $parent->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-{{ $parent->id }}">@lang('accounts::parents.dialogs.unblock.title')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @lang('accounts::parents.dialogs.unblock.info')
                    </div>
                    <div class="modal-footer">
                        {{ BsForm::patch(route('dashboard.parents.unblock', $parent)) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang('accounts::parents.dialogs.unblock.cancel')
                        </button>
                        <button type="submit" class="btn btn-danger">
                            @lang('accounts::parents.dialogs.unblock.confirm')
                        </button>
                        {{ BsForm::close() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
