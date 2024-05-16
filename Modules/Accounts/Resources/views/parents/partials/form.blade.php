@include('dashboard::errors')
{{ BsForm::text('name')->required()->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3']) }}
{{ BsForm::email('email')->attribute(['data-parsley-type' => 'email', 'data-parsley-minlength' => '3']) }}
{{ BsForm::text('phone')->required()->attribute(['data-parsley-type' => 'number', 'data-parsley-minlength' => '3']) }}
{{ BsForm::password('password') }}
{{ BsForm::password('password_confirmation') }}

<div class="form-group">
    <label for="preferred_locale">@lang('accounts::parents.attributes.preferred_locale')</label>
    <select name="preferred_locale" id="preferred_locale" class="form-control" data-live-search="true"
        data-actions-box="true">
        @foreach (Locales::get() as $locale)
            <option value="{{ $locale->code }}"
                @isset($parent)
                {{ $parent->preferred_locale == $locale->code ? 'selected' : '' }}
                @endisset>
                {{ $locale->name }}
            </option>
        @endforeach
    </select>
</div>

@isset($parent)
    {{ BsForm::image('avatar')->collection('avatars')->files($parent->getMediaResource('avatars'))->notes(trans('accounts::parents.messages.images_note')) }}
@else
    {{ BsForm::image('avatar')->notes(trans('accounts::parents.messages.images_note'))->collection('avatars') }}
@endisset
