<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    @if(isset($title))
        <a href="#{{ preg_replace('/\s+/', '', $title) }}One" class="d-block card-header py-3 collapsed"
           data-toggle="collapse"
           role="button"
           aria-expanded="false" aria-controls="{{ preg_replace('/\s+/', '', $title) }}One">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title ?? '' }}</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="{{ preg_replace('/\s+/', '', $title) }}One">
            <div class="card-body {{ $bodyClass ?? '' }}">
                {{ $slot }}
            </div>
            @isset($footer)
                <div class="card-footer">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    @endif
</div>
