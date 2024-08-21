<div class="accordion mb-2" id="accordion">
    <div class="card">
        @if(isset($title))
            <div class="card-header" id="{{ preg_replace('/\s+/', '', $title) }}One8">
                <div class="card-title collapsed" data-toggle="collapse"
                     data-target="#{{ preg_replace('/\s+/', '', $title) }}"
                     aria-expanded="false">
                    <h3 class="card-label">
                        {{ $title ?? '' }}
                    </h3>
                </div>
            </div>

            <!-- /.card-header -->
            <div id="{{ preg_replace('/\s+/', '', $title) }}" class="collapse" data-parent="#accordion" style="">
                <div class="card-body {{ $bodyClass ?? '' }}">
                    {{ $slot }}
                </div>
                <!-- /.card-body -->

                @isset($footer)
                    <div class="card-footer">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        @endif
    </div>
    <!-- /.card -->
</div>
