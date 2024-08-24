<!--==========================
        TOPBAR PART START
    ===========================-->

@guest
    <section id="wsus__topbar">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-7 d-none d-md-block">
                    <ul class="wsus__topbar_left">
                        <li><a href="mailto:{{ config('settings.site_email') }}"><i class="fal fa-envelope"></i>
                                {{ config('settings.site_email') }}</a></li>
                        <li><a href="callto:{{ config('settings.site_phone') }}"><i
                                    class="fal fa-phone-alt"></i>{{ config('settings.site_phone') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endguest
@auth
    <section id="wsus__topbar">
        <div class="container">
            <div class="row">
                {{--  <div class="col-xl-6 col-md-7 d-none d-md-block">
                    <ul class="wsus__topbar_left">
                        <li><a href="mailto:{{ config('settings.site_email') }}"><i class="fal fa-envelope"></i>
                                {{ config('settings.site_email') }}</a></li>
                        <li><a href="callto:{{ config('settings.site_phone') }}"><i class="fal fa-phone-alt"></i>{{ config('settings.site_phone') }}</a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </section>
@endauth
<!--==========================
        TOPBAR PART END
    ===========================-->


<!--==========================
        MENU PART START
    ===========================-->
<nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset(config('settings.logo')) }}" alt="DB.Card">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">

                @foreach (Menu::getByName('Main Menu') as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $menu['link'] }}">
                            {{ $menu['label'] }}

                            @if ($menu['child'])
                                <i class="far fa-chevron-down"></i>
                            @endif
                        </a>
                        @if ($menu['child'])
                            <ul class="menu_droapdown">
                                @foreach ($menu['child'] as $child)
                                    <li><a href="{{ $child['link'] }}">{{ $child['label'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            @auth
                <a class="user_btn text-center" href="{{ route('user.dashboard') }}">DashBoard</a>
            @endauth
            @guest
            <a class="user_btn text-center" href="{{ route('login') }}">Login</a>
            @endguest
        </div>
</nav>
<!--==========================
        MENU PART END
    ===========================-->
