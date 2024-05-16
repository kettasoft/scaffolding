@extends(layout('dashboard').'default')

@section('title')
    @lang('backups::backups.plural')
@endsection

@section('content')
    @component(layout('dashboard').'components.page')
        @slot('title', trans('backups::backups.plural'))
        @slot('breadcrumbs', ['dashboard.backups.index'])

        {{--        @include('backups::backups.partials.filter')--}}

        @component(layout('dashboard').'components.table-box')
            @slot('title', trans('backups::backups.actions.list'))
            @slot('tools')
                @include('backups::backups.partials.actions.create')
            @endslot

            <thead>
            <tr>
                <th>@lang('backups::backups.attributes.name')</th>
                <th class="d-none d-md-table-cell">@lang('backups::backups.attributes.file_size')</th>
                <th class="d-none d-md-table-cell">@lang('backups::backups.attributes.created_at')</th>
                <th class="d-none d-md-table-cell">@lang('backups::backups.attributes.created_age')</th>
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($backups as $backup)
                <tr>
                    <td>{{ $backup['file_name'] }}</td>
                    <td>{{ humanFilesize($backup['file_size']) }}</td>
                    <td>
                        {{ date('F jS, Y, h:i a',$backup['last_modified']) }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}
                    </td>
                    <td style="width: 160px">
                        @include('backups::backups.partials.actions.download')
                        @include('backups::backups.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('backups::backups.empty')</td>
                </tr>
            @endforelse
        @endcomponent

    @endcomponent
@endsection
