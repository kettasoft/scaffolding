@if((isset($can['permission'])
    && auth()->user()->isAbleTo($can['permission']))
    || ! isset($can))

    <li class="nav-item {{ isset($tree) && is_array($tree) && count($tree) ? 'dropdown' : '' }} {{ isset($isActive) && $isActive ?  'active' : '' }} {{ isset($tree) && collect($tree)->contains('isActive',true) ?  'active' : '' }}">
        <a class="nav-link dropdown-toggle arrow-none {{ isset($isActive) && $isActive ?  'active' : '' }}"
           href="{{ isset($tree) && is_array($tree) ? '#' : ($url ?? '#') }}" id="topnav-{{ $name }}"
           role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @isset($icon)
                <i class="{{ $icon }}"></i>
            @endisset
            <span data-key="t-{{ $name }}">{{ $name }}</span>
            @if(isset($tree) && is_array($tree) && count($tree))
                <div class="arrow-down"></div>
            @endif
        </a>
        @if(isset($tree) && is_array($tree) && count($tree))
            <div class="dropdown-menu"
                 aria-labelledby="topnav-{{ $name }}">
                @foreach($tree as $item)
                    @if(isset($item['module']) && \Module::collections()->has($item['module']))
                        @if((isset($item['can']['permission'])
                        && auth()->user()->isAbleTo($item['can']['permission']))
                        || ! isset($item['can']))
                            @if(isset($item['tree']) && is_array($item['tree']) && count($item['tree']))
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none {{ isset($item['isActive']) && $item['isActive'] ?  'active' : '' }}"
                                       href="{{ isset($item['tree']) && is_array($item['tree']) ? '#' : ($item['url'] ?? '#') }}"
                                       id="topnav-{{ $item['name'] }}"
                                       role="button">
                                        <span data-key="t-{{ $item['name'] }}">{{ $item['name'] }}</span>
                                        <div class="arrow-down"></div>
                                    </a>
                                    @if(isset($item['tree']) && is_array($item['tree']) && count($item['tree']))
                                        <div class="dropdown-menu" aria-labelledby="topnav-{{ $item['name'] }}-second">
                                            @foreach($item['tree'] as $treeItem)
                                                @if(isset($treeItem['module']) && \Module::collections()->has($treeItem['module']))
                                                    @if((isset($treeItem['can']['permission'])
                                                    && auth()->user()->isAbleTo($treeItem['can']['permission']))
                                                    || ! isset($treeItem['can']))
                                                        <a href="{{ $treeItem['url'] }}"
                                                           class="dropdown-item {{ isset($treeItem['isActive']) && $treeItem['isActive'] ? 'active' : '' }}"
                                                           data-key="t-{{ $treeItem['name'] }}">{{ $treeItem['name'] }}</a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @else
                                <a href="{{ isset($item['tree']) && is_array($item['tree']) ? '#' : ($item['url'] ?? '#') }}"
                                   class="dropdown-item {{ isset($item['isActive']) && $item['isActive'] ?  'active' : '' }}"
                                   data-key="t-{{ $item['name'] }}">{{ $item['name'] }}</a>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        @endif
    </li>
    {{--    <li class="nav-item dropdown">--}}
    {{--        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">--}}
    {{--            <i class="bx bx-file icon"></i>--}}
    {{--            <span data-key="t-pages">Pages</span>--}}
    {{--            <div class="arrow-down"></div>--}}
    {{--        </a>--}}

    {{--    </li>--}}
@endif
