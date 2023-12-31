<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    @vite('resources/css/app.css')
  </head>
  <body class="antialiased">
    <div id="app">
      <router-view />
    </div>

    <script>
      @if(isset($access_token) && isset($refresh_token) && isset($access_token_created_at))
        localStorage.setItem('access_token', '<?php  echo $access_token ?>');
        localStorage.setItem('refresh_token', '<?php  echo $refresh_token ?>');
        localStorage.setItem('access_token_created_at', '<?php  echo $access_token_created_at ?>');
      @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
  </body>
</html>
