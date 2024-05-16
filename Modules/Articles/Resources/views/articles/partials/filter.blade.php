{{ BsForm::resource('articles::articles')->get(url()->current()) }}
@component(layout('dashboard').'components.accordion')
    @slot('title', trans('articles::articles.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('articles::articles.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('articles::articles.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
