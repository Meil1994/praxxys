<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('index.css') }}">

</head>
<body>
    <div class="588px:grid 588px:grid-cols-5 730px:grid-cols-7 1000px:grid-cols-5 h-screen overflow-auto">
        <div class="col-span-1 730px:col-span-2 1000px:col-span-1">
            @include('/components/Sidebar')
        </div>
    
        <div class="588px:col-span-4 730px:col-span-5 1000px:col-span-4" id="app">
            <create/>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/12e77b0106.js" crossorigin="anonymous"></script>

    <script src="{{ asset('burger.js') }}"></script>


</body>
</html>
