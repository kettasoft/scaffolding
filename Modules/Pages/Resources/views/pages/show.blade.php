<x-layout :title="$page->title" :breadcrumbs="['dashboard.pages.show',$page]">

    <div class="row">
        <div class="col-md-6">
            @component(layout('dashboard').'components.box')
                @slot('bodyClass', 'p-0')

                <table class="table table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('pages::pages.attributes.title')</th>
                        <td>{{ $page->title }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('pages::pages.attributes.link')</th>
                        <td>{{ $page->link }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('pages::pages.partials.actions.edit')
                    @include('pages::pages.partials.actions.delete')
                @endslot
            @endcomponent
        </div>

    </div>

</x-layout>


