<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ $title ?? '在庫管理' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])

</head>

<body>
  {{ $slot }}
</body>

</html>
