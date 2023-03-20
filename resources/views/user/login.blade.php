<div class="box">
<button type="button" class="btn btn-primary" id="login-button">
    <span>
    {{ __('Login') }}
    </span>
</button>
</div>

<div id="login-popup" class="popup">
  <div class="popup-content">
    <span class="close-button">&times;</span>
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
      </div>
      <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
      </div>
      <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                </div>
            </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
      @endif
    </form>
  </div>
</div>
<style>
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