{{ BsForm::resource('pages::pages')->get(url()->current()) }}
@component(layout('dashboard').'components.accordion')
    @slot('title', trans('pages::pages.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('title')->value(request('title')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('pages::pages.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('pages::pages.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
