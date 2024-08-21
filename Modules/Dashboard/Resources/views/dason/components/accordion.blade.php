<div class="accordion" id="accordionExample">
    <div class="accordion-item accordion-item-custom">
        @if(isset($title))
            <h2 class="accordion-header" id="{{ preg_replace('/\s+/', '', $title) }}One">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{ preg_replace('/\s+/', '', $title) }}" aria-expanded="false"
                        aria-controls="{{ preg_replace('/\s+/', '', $title) }}">
                    {{ $title ?? '' }}
                </button>
            </h2>
            <div id="{{ preg_replace('/\s+/', '', $title) }}" class="accordion-collapse collapse"
                 aria-labelledby="{{ preg_replace('/\s+/', '', $title) }}One"
                 data-bs-parent="#accordionExample">
                <div class="accordion-body card-body {{ $bodyClass ?? '' }}">
                    {{ $slot }}

                    @isset($footer)
                        <div class="card-footer">
                            {{ $footer }}
                        </div>
                    @endisset
                </div>
            </div>
        @endif
    </div>
</div>

