<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Login & Signup Form</title>
     <link rel="stylesheet" href="{{asset('assets/css/stylelog.css')}}" type="text/css" />
  </head>
  <body>
    <section class="wrapper">
      <div class="form signup">
        <header>Signup</header>
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <input type="text" placeholder="Full name" name="name" required />
          <input type="email" placeholder="Email address" name="email" required />
          <input type="password" placeholder="Password" name="password" required />
          <input type="password" placeholder="Password" name="password_confirmation" required />
          <input type="submit" value="Signup" />
        </form>
      </div>
      <div class="form login">
        <header>Login</header>
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <input type="email" name="email" placeholder="Email address" required />
          <input type="password" placeholder="Password" name="password" required />
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot password?</a>
          @endif
          <input type="submit" value="Login" />
        </form>
      </div>
      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");
        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
  </body>
</html>