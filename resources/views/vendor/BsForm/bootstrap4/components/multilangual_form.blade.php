<?php $tabuniqid = 'tab-' . $uniqid; ?>
<ul class="nav nav-tabs" id="{{ $tabuniqid }}" role="tablist">
    @multilangualForm
    @if(Settings::get('dashboard_template') == 'neptune')
        <button class="nav-link {{ $loop->index == 0 ? ' active' : '' }}"
                id="{{ $tabuniqid.$locale->code }}-tab"
                data-bs-toggle="tab"
                data-bs-target="#{{ $tabuniqid.$locale->code }}"
                type="button"
                role="tab"
                aria-controls="{{ $tabuniqid.$locale->code }}"
                aria-selected="{{ $loop->index == 0 ? 'true' : 'false' }}">
            <img src="{{ $locale->flag }}" class="mx-1" alt="">
            {{ $locale->name }}
        </button>
    @else
        <li class="nav-item">
            <a class="nav-link{{ $loop->index == 0 ? ' active' : '' }}"
               id="{{ $tabuniqid.$locale->code }}-tab"
               data-toggle="tab"
               href="#{{ $tabuniqid.$locale->code }}"
               role="tab"
               aria-controls="{{ $tabuniqid.$locale->code }}"
               aria-selected="{{ $loop->index == 0 ? 'true' : 'false' }}">
                <img src="{{ $locale->flag }}" class="mx-1" alt="">
                {{ $locale->name }}
            </a>
        </li>
    @endif
    @endMultilangualForm
</ul>
<div class="tab-content" id="{{ $tabuniqid }}-content">
    @multilangualForm
    @if(Settings::get('dashboard_template') == 'neptune')
        <div class="tab-pane fade{{ $loop->index == 0 ? ' show active' : '' }}" id="{{ $tabuniqid.$locale->code }}"
             role="tabpanel"
             aria-labelledby="{{ $tabuniqid.$locale->code }}-tab">
            <div class="py-2">
                @stack($uniqid.$locale->code)
            </div>
        </div>
    @else
        <div class="tab-pane fade{{ $loop->index == 0 ? ' show active' : '' }}"
             id="{{ $tabuniqid.$locale->code }}"
             role="tabpanel"
             aria-labelledby="{{ $tabuniqid.$locale->code }}-tab">
            <div class="py-2">
                @stack($uniqid.$locale->code)
            </div>
        </div>
    @endif
    @endMultilangualForm
</div>
