<div class="card mt-3 mb-4">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <div>
            <h3 class="m-0 text-primary">
                {{ $title ?? '' }}
            </h3>
        </div>
        <div class="card-tools float-right">
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
