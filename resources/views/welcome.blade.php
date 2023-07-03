<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>postcodes-api</title>
    <!-- Styles -->
    <link  href="build/assets/app-a1f176bd.css" rel="stylesheet">
    <link  href="build/assets/app-1f469613.css" rel="stylesheet">
    <link  href="build/manifest.json" rel="manifest">
    <script defer src="build/assets/app-6ec6f6e1.js" type="text/javascript"></script>
</head>

<body>
    <div class="container py-5" id="container">
           @yield('content')
    </div>
</body>
</html>
