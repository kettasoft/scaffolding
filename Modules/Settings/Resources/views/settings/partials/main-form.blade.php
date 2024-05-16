@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@bsMultilangualFormTabs

{{ BsForm::text('name')->value(Settings::locale($locale->code)->get('name'))->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('description')->rows(3)->attribute('class','form-control textarea')->value(Settings::locale($locale->code)->get('description'))->attribute(['data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('meta_description')->rows(3)->attribute('class','form-control textarea')->value(Settings::locale($locale->code)->get('meta_description'))->attribute(['data-parsley-minlength' => '3']) }}
{{ BsForm::text('keywords')->value(Settings::locale($locale->code)->get('keywords'))->note(trans('settings::settings.notes.keywords')) }}

@endBsMultilangualFormTabs

<div class="row">
    <div class="col-md-6">
        {{ BsForm::image('logo')->collection('logo')->files(optional(Settings::instance('logo'))->getMediaResource('logo'))->notes(trans('settings::settings.messages.images_note')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('favicon')->collection('favicon')->files(optional(Settings::instance('favicon'))->getMediaResource('favicon'))->notes(trans('settings::settings.messages.images_note')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('loginLogo')->collection('loginLogo')->files(optional(Settings::instance('loginLogo'))->getMediaResource('loginLogo')) }}
    </div>
    <div class="col-md-6">
        {{ BsForm::image('loginBackground')->collection('loginBackground')->files(optional(Settings::instance('loginBackground'))->getMediaResource('loginBackground')) }}
    </div>
</div>

{{--    <select2 name="privacy_policy"--}}
{{--             label="@lang('settings::settings.attributes.privacy_policy')"--}}
{{--             remote-url="{{ route('pages.select') }}"--}}
{{--             value="{{ (new Modules\Settings\Entities\Setting)->get('privacy_policy', old('privacy_policy',null)) }}"--}}
{{--             :required="false"--}}
{{--    ></select2>--}}

{{--    <select2 name="terms"--}}
{{--             label="@lang('settings::settings.attributes.terms')"--}}
{{--             remote-url="{{ route('pages.select') }}"--}}
{{--             value="{{ (new Modules\Settings\Entities\Setting)->get('terms', old('terms',null)) }}"--}}
{{--             :required="false"--}}
{{--    ></select2>--}}

