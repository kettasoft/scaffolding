<div class="dropdown d-none d-sm-inline-block">
    <button type="button" class="btn header-item"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img id="header-lang-img" src="{{ Locales::getFlag() }}" alt="Header Language" height="16">
    </button>
    <div class="dropdown-menu dropdown-menu-end">

        <!-- item-->
        @foreach(Locales::get() as $locale)
            <a href="{{ route('dashboard.locale', $locale->code) }}" class="dropdown-item notify-item language"
               data-lang="en">
                <img src="{{ $locale->flag }}" alt="user-image" class="me-1" height="12"> <span
                    class="align-middle">{{ $locale->name }}</span>
            </a>
        @endforeach

    </div>
</div>
