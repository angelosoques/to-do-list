<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Home</title>
    </head>
    <body>
        <div id="todoListApp"></div>
    </body>

    <script src="{{ asset('js/app.js')}}"></script>
</html>