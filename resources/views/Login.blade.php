<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('index.css') }}">
</head>
<body>


    <div class="flex justify-center items-center h-screen bg-gradient-to-t from-stone-700 to-slate-600">
        <form 
            method="POST" action="{{ route('login') }}"
            class="w-80 p-8 pt-10 pb-10 ring-2 ring-amber-600 shadow-lg shadow-black">
            @csrf
            <p class="text-white text-center mb-5">LOGIN WITH USERNAME</p>
            <input 
                name="username"
                class="w-100% mt-1 mb-4 p-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                placeholder="Username"
                
            />

            <input 
                name="password"
                class="w-100% mt-1 p-3 focus:outline-none focus:ring-2 focus:ring-amber-600"
                placeholder="Password"
            />
            @if(session('error'))
                <p class="text-red-500 text-sm mt-2">{{ session('error') }}</p>
            @endif

            <div class="flex items-center mt-3">
                <input
                    type="checkbox"
                    class="h-4 w-4"
                    name="remember"
                />
                <label class="ml-1 text-white">Remember me</label>
            </div>

            <button type="submit" class="bg-amber-600 w-100% text-white p-10 pt-3 pb-3 mt-8 hover:bg-white hover:ring-2 hover:ring-amber-600 hover:text-amber-600">Login</button>
            
            <div class="flex justify-center mt-10 text-sm text-blue-500">
                <a href="/api/login/email" class="hover:text-blue-400">Login using Email</a>
            </div>
        </form>
    </div>
</body>
</html>
