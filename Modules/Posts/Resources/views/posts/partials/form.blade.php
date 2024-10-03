@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ BsForm::text('title')->attribute(['data-parsley-maxlength' => '191', 'data-parsley-minlength' => '3']) }}
{{ BsForm::textarea('content')->rows(3)->attribute('class', 'form-control textarea')->attribute(['data-parsley-minlength' => '3']) }}

@isset($post)
    {{ BsForm::image('image')->collection('default')->files($post->getMediaResource('default'))->notes(trans('posts::posts.messages.images_note')) }}
@else
    {{ BsForm::image('image')->collection('default')->notes(trans('posts::posts.messages.images_note')) }}
@endisset
