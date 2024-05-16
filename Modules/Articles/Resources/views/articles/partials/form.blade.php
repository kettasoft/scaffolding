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
{{ BsForm::text('name')->attribute(['data-parsley-maxlength' => '191','data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('content')->rows(3)->attribute('class','form-control textarea')->attribute(['data-parsley-minlength' => '3']) }}
@endBsMultilangualFormTabs

@isset($article)
    {{ BsForm::image('image')->collection('default')->files($article->getMediaResource('default'))->notes(trans('articles::articles.messages.images_note')) }}
@else
    {{ BsForm::image('image')->collection('default')->notes(trans('articles::articles.messages.images_note')) }}
@endisset
