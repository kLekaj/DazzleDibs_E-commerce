<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<div class="container d-flex">
  <div class="image-container">
    <img src="{{ asset('img/Become a Member.png') }}" alt="Image 1">
  </div>
  <div class="card col-md-4">
    <div class="card-header bg-primary text-white">{{ __('Register') }}</div>
    <div class="card-body">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <label for="name">{{ __('Name') }}</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror form-group" name="name" value="{{ old('name') }}" required autocomplete="name">
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="email">{{ __('E-Mail Address') }}</label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror form-group" name="email" value="{{ old('email') }}" required autocomplete="email">
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="password">{{ __('Password') }}</label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-group" name="password" required autocomplete="new-password">
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="password-confirm" >{{ __('Confirm Password') }}</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
        <div class="form-group mb-0">
          <button type="submit" class="btn btn-primary btn-block">
            {{ __('Submit') }}
          </button>
        </div>
      </form>
      <script>
        // Get the name input element
const nameInput = document.getElementById('name');

// Add an event listener to the input element
nameInput.addEventListener('input', function(event) {
  // Get the input value
  const nameValue = event.target.value.trim();

  // Check if the name field is empty
  if (!nameValue) {
    nameInput.classList.add('is-invalid');
  } else {
    nameInput.classList.remove('is-invalid');
  }
});


// Get the email input element
const emailInput = document.getElementById('email');

// Add an event listener to the input element
emailInput.addEventListener('input', function(event) {
  // Get the input value
  const emailValue = event.target.value.trim();

  // Check if the email field is empty
  if (!emailValue) {
    emailInput.classList.add('is-invalid');
    return;
  }

  // Check if the email format is valid
  const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  if (!emailRegex.test(emailValue)) {
    emailInput.classList.add('is-invalid');
    return;
  }

  // TODO: Check if the email is unique
  // You can send an AJAX request to check if the email already exists in the database.

  emailInput.classList.remove('is-invalid');
});



// Get the password input element
const passwordInput = document.getElementById('password');

// Add an event listener to the input element
passwordInput.addEventListener('input', function(event) {
  // Get the input value
  const passwordValue = event.target.value;

  // Check if the password field is empty
  if (!passwordValue) {
    passwordInput.classList.add('is-invalid');
    return;
  }

  // Check if the password length is valid
  if (passwordValue.length < 8) {
    passwordInput.classList.add('is-invalid');
    return;
  }

  passwordInput.classList.remove('is-invalid');
});

      </script>
    </div>
  </div>
  <div class="image-container">
    <img src="{{ asset('img/Become a Member1.png') }}" alt="Image 2">
  </div>
</div>
