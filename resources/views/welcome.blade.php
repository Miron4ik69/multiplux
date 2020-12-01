{{-- Head Section --}}
@include("includes/head")
@yield("head")

@include("modals/modal-login")
@yield("modal-login")
<nav class="uk-navbar-container" uk-navbar style="background: #221f1f !important; color: white !important; height: 60px !important">
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav" style="height: 60px !important;">
            <li><a href="#" style="color: red; font-size: 20px;">Multiplux</a></li>
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

<div class="uk-section" style="padding: 0 !important">
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider>

    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m">
        @foreach($movies as $movie)
            <li>
                <img src="{{ asset('/storage/'. $movie->image) }}" alt="">
                <div class="uk-position-top uk-panel uk-flex uk-flex-between">
                    <div class="info" style="margin: 15px;">
                        <a href="#modal-full" onclick="sendAjax({{ $movie->id }}, '{{ route('getMovie') }}')" uk-toggle><span uk-icon="icon: info; ratio: 2"></span></a>
                    </div>
                    <div class="info" style="margin: 15px;">
                        <div uk-lightbox video-autoplay>
                            <a href="{{ $movie->video }}" data-caption="{{ $movie->title }}"><span uk-icon="icon: tv; ratio: 2"></span></a>
                        </div>
                    </div>
                </div>
                <div class="uk-position-center uk-panel"><span style="user-select: none;">{{ $movie->title }}</span></div>
            </li>
        @endforeach
    </ul>
        <div id="modal-full" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog" style="background: #221f1f !important;">
                <button class="uk-modal-close-full uk-close-large" type="button" uk-close style="background: #221f1f !important;"></button>
                <div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>
                    <div id="modal-movie-image" class="uk-background-cover" uk-height-viewport></div>
                    <div class="uk-padding-small">
                        <h1 id="modal-movie-title"></h1>
                        <div id="modal-movie-age"></div>
                        <div id="modal-movie-director"></div>
                        <div id="modal-movie-hire"></div>
                        <div id="modal-movie-rating"></div>
                        <div id="modal-movie-language"></div>
                        <div id="modal-movie-duration"></div>
                        <div id="modal-movie-country"></div>
                        <div id="modal-movie-description"></div>
                        <a id="modal-movie-button" class="uk-button uk-button-danger" href="{{ route('reservationMovie', ['id' => $movie->id, 'buyId' => uniqid()]) }}">Купить билет</a>
                    </div>
                </div>
            </div>
        </div>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

</div>
</div>

{{-- Footer Section --}}
@include("includes/footer")
@yield("footer")