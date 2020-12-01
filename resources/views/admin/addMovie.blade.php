{{-- Head Section --}}
@include("includes/head")
@yield("head")
<style>
    body {
        overflow: visible !important;
    }
</style>
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

<div class="uk-section">
    <div class="uk-container uk-flex uk-flex-center">
        <form action="{{ route('add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="uk-margin">
                <input name="title" class="uk-input uk-form-width-medium" type="text" placeholder="Заголовок" style="background: none;">
                <input name="video"  class="uk-input uk-form-width-medium" type="text" placeholder="Ссылка на трейлер" style="background: none;">
            </div>
            <div class="uk-margin">
                <input name="price" class="uk-input uk-form-width-medium" type="text" placeholder="Стоимость" style="background: none;">
                <input name="age" class="uk-input uk-form-width-medium" type="text" placeholder="Возраст" style="background: none;">
            </div>
            <div class="uk-margin">
                <input name="duration" class="uk-input uk-form-width-medium" type="text" placeholder="Продолжительность" style="background: none;">
                <input name="director" class="uk-input uk-form-width-medium" type="text" placeholder="Режисёр" style="background: none;">
            </div>
            <div class="uk-margin">
                <input name="country" class="uk-input uk-form-width-medium" type="text" placeholder="Страна" style="background: none;">
                <input name="studio" class="uk-input uk-form-width-medium" type="text" placeholder="Студия" style="background: none;">
            </div>
            <div class="uk-margin">
                <input name="start_hire" class="uk-input uk-form-width-medium" type="text" placeholder="Начало проката" style="background: none;">
                <input name="end_hire" class="uk-input uk-form-width-medium" type="text" placeholder="Конец проката" style="background: none;">
            </div>
            <div class="uk-margin">
                <input name="language" class="uk-input uk-form-width-medium" type="text" placeholder="Язык" style="background: none;">
                <input name="rating" class="uk-input uk-form-width-medium" type="text" placeholder="Рейтинг" style="background: none;">
            </div>
            <div class="uk-margin" uk-margin>
                <div uk-form-custom="target: true">
                    <input type="file" style="width: 100%;" name="image">
                    <input class="uk-input uk-form-width-medium" type="text" placeholder="Картинка фильма" style="background: none;">
                </div>
                <textarea name="description" class="uk-textarea uk-form-width-medium" style="background: none;"></textarea>
            </div>
            <div class="uk-margin" uk-margin>
                <button type="submit" class="uk-button uk-button-default" style="color: white; width: 100%;">Добавить фильм</button>
            </div>
        </form>
    </div>
</div>




{{-- Footer Section --}}
@include("includes/footer")
@yield("footer")