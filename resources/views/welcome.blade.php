<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <title>Welcome</title>
  </head>
  <body>
    <div class="container my-5 text-center">
      <img src="http://minsu.edu.ph/template/images/logo.png" alt="Logo" />
      <h3 class="my-3">Welcome</h3>
      <h1 class="my-3">MinSU-AlumnConnect</h1>
      <p>
        This is a simple Bootstrap welcome page.
      </p>
      <div class="my-3">
         @if (Route::has('login'))
          @auth
            <a href="{{ url('/home') }}" class="btn btn-primary mx-3">Home</a>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary mx-3">Login</a>
             @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary mx-3">Register</a>
             @endif
          @endauth
         @endif
      </div>
    </div>
  </body>
</html>
