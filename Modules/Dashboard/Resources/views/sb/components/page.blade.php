<!-- Content Header (Page header) -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="h3 mb-0 text-gray-800">{{$title}}</h4>

            <ol class="">
                @isset($breadcrumbs)
                    {{ Breadcrumbs::render(...$breadcrumbs) }}
                @endisset
            </ol>

        </div>
    </div>
</div>

<!-- Main content -->
<section>
    @include('flash::message')
    {{ $slot }}
</section>
<!-- /.content -->
