@if((isset($can['permission'])
    && auth()->user()->isAbleTo($can['permission']))
    || ! isset($can))
    <li class="{{ ($hasTree = isset($tree) && is_array($tree) && count($tree)) ? 'treeview' : '' }}">
        <a class="app-menu__item {{ isset($isActive) && $isActive ?  'active' : '' }}"
           href="{{ $url ?? '#' }}"
           @if($hasTree) data-toggle="treeview" @endif>
            @isset($icon)
                <i class="app-menu__icon {{ $icon }}"></i>
            @endisset
            <span class="app-menu__label">
                {{ $name }}
            </span>
            @isset($badge)
                <span class="mr-1 badge badge-{{ $badgeLevel ?? 'danger' }}">{{ $badge }}</span>
            @endisset
            @if($hasTree)
                <i class="treeview-indicator fa fa-angle-right"></i>
            @endif
        </a>
        @if($hasTree)
            <ul class="treeview-menu">
                @foreach($tree as $item)
                    @if(isset($item['module']) && \Module::collections()->has($item['module']))
                        @if((isset($item['can']['permission'])
                        && auth()->user()->isAbleTo($item['can']['permission']))
                        || ! isset($item['can']))
                            <li>
                                <a class="treeview-item {{ isset($item['isActive']) && $item['isActive'] ? ' active' : '' }}"
                                   href="{{ $item['url'] }}">
                                    <i class="icon {{ $item['icon'] ?? 'far fa-circle' }}"></i>
                                    {{ $item['name'] }}
                                    @isset($item['badge'])
                                        <span class="flex-grow-1">
                                        <span
                                            class="mr-1 float-right badge badge-{{ $item['badgeLevel'] ?? 'danger' }}">{{ $item['badge'] }}</span>
                                    </span>
                                    @endisset
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endif
