<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/img/Group 3454.svg.png') }}" type="image/x-icon">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <title></title>
    </head>

    <body>
        <div class="container">
            <div class="left">
                <img src="{{ asset('img/Group 3454.svg.png') }}">
                <div class="form">
                    <div class="brand"><img src="{{ asset('img/Group 3454.svg.png') }}"></div>
                    <label>Please enter your login details to continue</label>
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf


                        <input id="email" type="email" class="inputs" name="email" required autocomplete="email" autofocus placeholder="Email"> 
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> 
                        @endif


                        <input id="password" type="password" class="inputs" name="password" required autocomplete="current-password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span> 
                        @endif 

                        <div class="btnContainer">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                        </div>
                        <div id="rst">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a> @endif
                        </div>
                    </form>
                </div>
            </div>
            {{--
            <div class="right">
                <div class="one"><img src="{{ asset('img/Mask Group 12.png') }}"></div>
                <div class="two"><img src="{{ asset('img/Mask Group 13.png') }}"></div>
                <div class="three"><img src="{{ asset('img/Mask Group 5.png') }}"></div>
                <div class="top"><img src="{{ asset('img/Group 3454.svg') }}"></div>
            </div> --}}
        </div>
    </body>

</html>