<div id="login-popup" class="popup">
  <div class="popup-content">
    <span class="close-button">&times;</span>
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
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

