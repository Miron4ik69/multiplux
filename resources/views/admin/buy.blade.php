<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Multiplux</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<style>
    .seat {
        border: 1px solid #6caadf;
        width: 15px;
        height: 25px;
        border-radius: 3px;
        margin-right: 15px;
        cursor: pointer;
    }

    .name {
        font-size: 15px;
        line-height: 18px;
        font-weight: bold;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }

    .reserved {
        cursor: not-allowed !important;
        background: #730001;
        border: 1px solid #810004;
    }

    .reserved:hover {
        cursor: not-allowed !important;
        background: #730001;
        border: 1px solid #810004;
    }

    .set {
        border: 1px solid #6caadf;
        background: #6caadf;
    }

    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
<nav class="uk-navbar-container uk-position-bottom" uk-navbar style="background: #312d2d">
    <div class="uk-navbar-left">

        <ul class="uk-navbar-nav">
            <li class="">
                <a href="#">
                    <span uk-icon="clock" style="color: #af1b1b;"></span>
                    <span id="time" style="color: #af1b1b; margin-left: 5px;"></span>
                </a>
            </li>
            <li><a href="#">К оплате: <span id="price" style="margin-left: 15px;">0 грн</span></a></li>
        </ul>

    </div>
    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            <li><a href="#" id="confirm-button" class="uk-button uk-button-danger" style="color: white; background: #af1b1b">ПРОДОЛЖИТЬ</a></li>
        </ul>
    </div>
</nav>

<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-body">
                <p>К оплате: <span id="endprice"></span></p>
                <input id="deposited" type="text" class="uk-input" placeholder="Внесенная сумма">
                <p>Сдача: <span id="oddmoney"></span></p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Отменить</button>
                <button id="submit-button" class="uk-button uk-button-primary" type="submit">Оплатить</button>
            </div>
    </div>
</div>

<div class="uk-section" style="padding-top: 15px;">
    <div class="uk-container-fluid">
        <div class="uk-flex uk-flex-between">
            <div class="uk-width-1-4" style="margin-left: 15px;">
                <img src="{{ asset('/storage/'. $movie[0]->image) }}" uk-img style="height: 25%;">
                <h3 id="modal-movie-title" style="margin: 0;">{{ $movie[0]->title }}</h3>
                <div id="modal-movie-age">Возраст: {{ $movie[0]->age }}</div>
                <div id="modal-movie-director">Режисер: {{ $movie[0]->director }}</div>
                <div id="modal-movie-hire">Период проката: {{ $movie[0]->start_hire }} - {{ $movie[0]->end_hire }}</div>
                <div id="modal-movie-rating">Рейтинг: {{ $movie[0]->rating }}</div>
            </div>
            <div class="uk-width-1-2" style="user-select: none; margin: 0 auto;">
                <div style="text-align: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 806 21" fill="#061420">
                        <path d="M3.2,20l-2,0.2l-0.3-4l2-0.2C136.2,5.3,269.6,0,403,0s266.8,5.3,400.2,16l2,0.2l-0.3,4l-2-0.2 C669.5,9.3,536.3,4,403,4S136.4,9.3,3.2,20z"></path>
                    </svg>
                    <div class="name">Экран</div>
                </div>
                <div class="uk-display-inline-block" style="width: 100%; margin-top: 100px;">
                    <input id="reservationId" type="text" hidden value="{{ $reservationId }}">
                    @foreach($places as $place)
                        <div class="uk-flex uk-flex-center" style="margin: 15px">
                            @foreach($place as $item)
                                <div
                                        id="place"
                                        class="uk-display-inline-block seat @if($item["isReserved"] == 1) reserved @endif"
                                        data-row="{{ $item["row"] }}"
                                        data-place="{{ $item["place"] }}"
                                        data-price="{{ $item["price"] }}"
                                        @if($item["isReserved"] !== 1) onclick="setPlace(this)" @endif
                                >
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var movieId = {{ $movieId }};
</script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/js/uikit-icons.min.js"></script>
<script src="{{ asset('js/admin-buy.js') }}"></script>
</body>
</html>