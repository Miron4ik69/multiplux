@section("modal-login")
<div id="modal-login" uk-modal>
    <div class="uk-modal-dialog">
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Авторизация</h2>
        </div>
        <div class="uk-modal-body">


                <div class="uk-margin uk-flex-center uk-flex">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input id="email" type="email" class="uk-input  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-color: #bbbbbb !important;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="uk-margin uk-flex-center uk-flex">
                    <div class="uk-inline">
                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                        <input id="password" type="password" class="uk-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Отменить</button>
            <button class="uk-button uk-button-primary" type="submit">Войти</button>
        </div>
        </form>
    </div>
</div>
@endsection