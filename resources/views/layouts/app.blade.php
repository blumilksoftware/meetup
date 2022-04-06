<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/static/css/app.css') }}">
    <title>Meetup app</title>
</head>
<body>
    @include('partials.navbar')
    <div class="flex-grow">
        @yield('content')
    </div>
</body>
</html>
