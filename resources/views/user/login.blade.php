<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="box">
    <button type="button" class="btn btn-primary" id="login-button">
      <span>
        {{ __('Login') }}
      </span>
    </button>
  </div>

<main class="main">
  <div id="login-popup" class="popup">
    <div class="popup-content">
      <span class="close-button">&times;</span>
        <h2 class="text text-large">Login</h2>
          <p class="text text-normal" style="padding-top: 5px;">New user? <span><a href="#" class="text text-links">Create an account</a></span>
            <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
              <div class="form-group row input-control">
                <div class="col-md-6">
                  <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control input-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>
              </div>
              <div class="form-group row input-control">
                <div class="col-md-6">
                  <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control input-field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                </div>
              </div>
              <div class="form-group row input-control">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                      </label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary input-submit" style="margin-bottom: 10px;">Login</button>
              <br>
              @if (Route::has('password.request'))
                <a class="btn btn-link input-control text text-links" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
                </a>
              @endif
            </form>
                <div class="striped">
				          <span class="striped-line"></span>
				          <span class="striped-text">Or</span>
				          <span class="striped-line"></span>
			          </div>
                <div class="method">
				          <div class="method-control">
                    <a href="{{ url('auth/facebook') }}" class="method-action">
                      <i class="fa fa-facebook-square ion ion-logo-facebook" aria-hidden="true" style="color: #0b61f4;"></i>
				              <span>Sign in with Facebook</span>
                    </a>
                  </div>
                  <div class="method-control">
                    <a href="{{ url('auth/linkedin') }}" class="method-action">
                      <i class="fa fa-linkedin-square  ion ion-logo-linkedin" aria-hidden="true" style="color: #0b61f4;"></i>
                      <span>Sign in with Linkedin</span>
                    </a>
                  </div>
                  <div class="method-control">
                    <a href="{{ url('auth/google') }}" class="method-action btn btn-google btn-block">
                      <i class="fa fa-google ion ion-logo-google" aria-hidden="true" style="color: red;"></i>
                      <span>Sign in with Google</span>
                    </a>
                  </div>
                  <div class="method-control">
                    <a href="{{ url('auth/github') }}" class="method-action">
                      <i class="fa fa-github ion ion-logo-github" aria-hidden="true"  style="color: black;"></i>
                      <span>Sign in with GitHub</span>
                    </a>
                  </div>
                </div>
  </div>
</main>
<style>
.input-field::placeholder {
  color: var(--color-grey);
}

.input-field:not(:placeholder-shown) + label {
  display: none;
}

.input-field:not(:placeholder-shown) {
  padding-top: 1.5rem;
}

.input-field:not(:placeholder-shown) ~ .invalid-feedback {
  margin-top: 0.25rem;
}





		.form {
			width: 100%;
			height: auto;
			margin-top: 2rem;
    }

    .input-control {
				/* display: flex; */
        width: 90%;
				align-items: center;
				justify-content: space-between;
				margin-bottom: 1.25rem;
			}

      .input-field {
				font-family: inherit;
				font-size: 1rem;
				font-weight: 400;
				line-height: inherit;
				width: 100%;
				height: auto;
				padding: 0.75rem 1.25rem;
				border: none;
				outline: none;
				border-radius: 2rem;
				color: var(--color-black);
				background: var(--color-light);
				text-transform: unset;
				text-rendering: optimizeLegibility;
			}
      .input-submit {
				font-family: inherit;
				font-size: 1rem;
				font-weight: 500;
				line-height: inherit;
				cursor: pointer;
				min-width: 40%;
				height: auto;
				padding: 0.65rem 1.25rem;
				border: none;
				outline: none;
				border-radius: 2rem;
				color: var(--color-white);
				background: var(--color-blue);
				box-shadow: var(--shadow-medium);
				text-transform: capitalize;
				text-rendering: optimizeLegibility;
			}

      .striped {
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			margin: 1rem 0;
      }
			.striped-line {
				flex: auto;
				flex-basis: auto;
				border: none;
				outline: none;
				height: 2px;
				background: var(--color-grayish);
			}

			.striped-text {
				font-family: inherit;
				font-size: 1rem;
				font-weight: 500;
				line-height: inherit;
				color: var(--color-black);
				margin: 0 1rem;
			}

      .method-control {
				margin-bottom: 1rem;
        width: 88%;
			}

			.method-action {
				font-family: inherit;
				font-size: 0.95rem;
				font-weight: 500;
				line-height: inherit;
				display: flex;
				justify-content: center;
				align-items: center;
				width: 100%;
				height: auto;
				padding: 0.35rem 1.25rem;
				outline: none;
				border: 2px solid var(--color-grayish);
				border-radius: 2rem;
				color: var(--color-black);
				background: var(--color-white);
				text-transform: capitalize;
				text-rendering: optimizeLegibility;
				transition: all 0.35s ease;
      }

				.method-action:hover {
					background: var(--color-light);
				}











.popup {
  position: fixed;
  top: 20px;
  right: 20px;
  display: none;
  z-index: 1;
}

.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
}

.close-button {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close-button:hover,
.close-button:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

form {
  margin-top: 20px;
}

form label {
  font-weight: bold;
}

form input {
  margin-bottom: 10px;
}

.box{
  width: 600px;
  margin: auto;
  padding-top: 20px;
  overflow: hidden;
  height: 100%
}

.box button{
  height: 90px;
  width: 280px;
  line-height: 90px;
  background: transparent;
  border: 3px solid #fff;
  margin: 10px;
  font-size: 16px;
  color: #fff;
  text-transform: uppercase;
  cursor: pointer;
  float: left;
  display: block;
  position: relative;
  overflow: hidden
}

.box button span{
  width: 100%;
  display: block;
  text-align: center;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 2;
  transition: all 0.1s ease 0.3s
}

button:hover span{color: #fff}

button:nth-child(1){
  color: #0096FF;
  border-color: #0096FF;
}

button:nth-child(1):before{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 25%;
  height: 100%;
  background: #0096FF;
  transform: rotateY(90deg);
  transition: all 0.6s ease;
}

button:nth-child(1) span:before{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 69px;
  width: 25%;
  height: 97%;
  background: #0096FF;
  transform: rotateY(90deg);
  transition: all 0.6s ease;
  z-index: -1
}


button:nth-child(1):after{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 138px;
  width: 25%;
  height: 100%;
  background: #0096FF;
  transform: rotateY(90deg);
  transition: all .6s ease;
}

button:nth-child(1) span:after{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 207px;
  width: 25%;
  height: 97%;
  background: #0096FF;
  transform: rotateY(90deg);
  transition: all 0.6s ease;
  z-index: -1
}



button:nth-child(1):hover:before{
  transform: rotateY(0)
}

button:nth-child(1):hover span:before{
  transform: rotateY(0);
  transition-delay: 0.2s;
}

button:nth-child(1):hover:after{
  transform: rotateY(0);
  transition-delay: 0.4s;
}

button:nth-child(1):hover span:after{
  transform: rotateY(0);
  transition-delay: 0.6s;
}




/* Login form Style */
:root {
	--color-white: #ffffff;
	--color-light: #f1f5f9;
	--color-black: #121212;
	--color-night: #001632;

	--color-red: #f44336;
	--color-blue: #1a73e8;
	--color-gray: #80868b;
	--color-grayish: #dadce0;

	--shadow-normal: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
		0 1px 2px 0 rgba(0, 0, 0, 0.06);
	--shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
		0 2px 4px -1px rgba(0, 0, 0, 0.06);
	--shadow-large: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
		0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

*,
*::before,
*::after {
	padding: 0;
	margin: 0;
	box-sizing: inherit;
	list-style: none;
	list-style-type: none;
	text-decoration: none;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-rendering: optimizeLegibility;
}


	.ion-logo-facebook {
		font-size: 1.65rem;
		line-height: inherit;
		margin-right: 0.5rem;
		color: var(--color-black);
	}
	.ion-logo-linkedin {
		font-size: 1.65rem;
		line-height: inherit;
		margin-right: 0.5rem;
		color: var(--color-red);
	}
	.ion-logo-google {
		font-size: 1.65rem;
		line-height: inherit;
		margin-right: 0.5rem;
		color: var(--color-blue);
	}
  .ion-logo-github {
		font-size: 1.65rem;
		line-height: inherit;
		margin-right: 0.5rem;
		color: var(--color-blue);
	}

.text {
	font-family: inherit;
	line-height: inherit;
	text-transform: unset;
	text-rendering: optimizeLegibility;
}

	.text-large {
		font-size: 2rem;
		font-weight: 600;
		color: var(--color-black);
	}

	.text-normal {
		font-size: 1rem;
		font-weight: 400;
		color: var(--color-black);
	}

	.text-links {
		font-size: 1rem;
		font-weight: 400;
		color: var(--color-blue);
  }
		.text-links:hover {
			text-decoration: underline;
		}
</style>
<script>
  var loginPopup = document.getElementById('login-popup');
  var loginButton = document.getElementById('login-button');
  var closeButton = document.getElementsByClassName('close-button')[0];

  loginButton.onclick = function() {
    loginPopup.style.display = 'block';
  }

  closeButton.onclick = function() {
    loginPopup.style.display = 'none';
  }

  window.onclick = function(event) {
    if (event.target == loginPopup) {
      loginPopup.style.display = 'none';
    }
  }
</script>