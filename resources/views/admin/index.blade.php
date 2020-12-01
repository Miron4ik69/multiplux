{{-- Head Section --}}
@include("includes/head")
@yield("head")
<nav class="uk-navbar-container" uk-navbar style="background: #221f1f !important; color: white !important; height: 60px !important">
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav" style="height: 60px !important;">
            <li><a href="#" style="color: red; font-size: 20px;">Multiplux</a></li>
        </ul>
        <ul class="uk-navbar-nav">
            <li><a href="{{ route('addMovie') }}">Добавить фильм</a></li>
        </ul>
        <ul class="uk-navbar-nav">
            <li><a href="{{ route('cashbox') }}">Касса</a></li>
        </ul>
    </div>
    <div class="uk-navbar-right">
        @guest
            <ul class="uk-navbar-nav">
                <li class=""><a href="#modal-login" uk-toggle><span uk-icon="icon: user; ratio: 1" style="margin-right: 5px;"></span>Войти</a></li>
            </ul>
        @else
            <ul class="uk-navbar-nav">
                <li class=""><a href="{{ route('home') }}" uk-toggle><span uk-icon="icon: user; ratio: 1" style="margin-right: 5px;"></span>{{ Auth::user()->name }}</a></li>
            </ul>
        @endguest
    </div>
</nav>





{{-- Footer Section --}}
@include("includes/footer")
@yield("footer")