@if((isset($can['permission'])
    && auth()->user()->isAbleTo($can['permission']))
    || ! isset($can))
    <li class="nav-item {{ isset($isActive) && $isActive ?  'active' : '' }}">
        <a class="nav-link {{ isset($isActive) && $isActive ? '' : 'collapsed' }}"
           href="{{ isset($tree) && is_array($tree) ? '#' : ($url ?? '#') }}"
           data-toggle="{{ isset($tree) && is_array($tree) ? 'collapse' : '' }}"
           data-target="{{ isset($tree) && is_array($tree) ? '#'.$name : '' }}"
           aria-expanded="{{ isset($isActive) && $isActive ? 'true' : 'false' }}"
           aria-controls="{{ isset($tree) && is_array($tree) ? $name : '' }}"
        >
            @isset($icon)
                <i class="{{ $icon }}"></i>
            @endisset
            <span>{{ $name }}</span>
        </a>
        @if(isset($tree) && is_array($tree) && count($tree))
            <div id="{{ $name }}" class="collapse {{ isset($isActive) && $isActive ? 'show' : '' }}"
                 aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @foreach($tree as $item)
                        @if(isset($item['module']) && \Module::collections()->has($item['module']))
                            @if((isset($item['can']['permission'])
                            && auth()->user()->isAbleTo($item['can']['permission']))
                            || ! isset($item['can']))
                                <a class="collapse-item {{ isset($item['isActive']) && $item['isActive'] ? ' active' : '' }}"
                                   href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </li>
@endif
