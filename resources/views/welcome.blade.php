<!DOCTYPE html>
<html lang="en">
  <style>
    body{
      background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg')
    }
    </style>
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-rjKzzx1VcPB+CGZvbtV/s8OfzX9XVIZ+OosyJ7V3A1e+Ja2sOKs1s4Zz0JQUd8l9A+DUJL0Tf1YjKlJ6xHYxkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-lm3X9D1b11mrU6dRyGp5+Z5oz5f5i5Z6iv2q3B1/c6dy1y6UfM6YRy6U/SiZPhKT05b0Nx0ZawELTxIzH9XQ2Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Welcome</title>
  </head>
<body>

   <div class="container my-5 text-center">
      <img src="http://minsu.edu.ph/template/images/logo.png" alt="Logo" />
      <h3 class="my-3 text-white">Welcome to Mindoro State University</h3>
      <h1 class="my-3 text-white">MinSU-AlumConnect</h1>

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
