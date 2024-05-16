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
{{ BsForm::text('title')->required()->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('content')->rows(3)->attribute('class','form-control textarea')->required()->attribute(['data-parsley-minlength' => '3']) }}
@endBsMultilangualFormTabs


{{ BsForm::text('link')->required() }}
