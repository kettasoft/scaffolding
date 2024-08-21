<div class="card card-custom mt-3 mb-4">
    <div class="card-header d-flex justify-content-between flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                {{ $title ?? '' }}
            </h3>
        </div>
        <div class="card-tools">
            {{ $tools ?? '' }}
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped table-valign-middle">
            {{ $slot }}
        </table>
    </div>
    @isset($footer)
        <div class="card-footer d-flex justify-content-center">
            {{ $footer }}
        </div>
    @endisset
</div>
