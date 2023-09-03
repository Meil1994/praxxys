<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Video</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('index.css') }}">
    <link href="https://vjs.zencdn.net/8.5.2/video-js.css" rel="stylesheet" />
    
</head>
<body>
    <div class="588px:grid 588px:grid-cols-5 730px:grid-cols-7 1000px:grid-cols-5 h-screen overflow-auto">
        <div class="col-span-1 730px:col-span-2 1000px:col-span-1">
            @include('/components/Sidebar')
        </div>
    
        <div class="588px:col-span-4 730px:col-span-5 1000px:col-span-4">
            <div class="video-container flex justify-center items-center h-screen bg-slate-500">
                <video
                    id="my-video"
                    class="video-js vjs-default-skin w-500px h-500px"
                    controls
                    preload="auto"
                    width="100%"
                    height="100%"
                    poster="{{ asset('images/video.png') }}"
                    data-setup="{}"
                >
                    <source src="{{ asset('video/demo.mp4') }}" type="video/mp4">
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                            >supports HTML5 video</a
                        >
                    </p>
                </video>
            </div>

            <script src="https://vjs.zencdn.net/8.5.2/video.min.js"></script>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/12e77b0106.js" crossorigin="anonymous"></script>

    <script src="{{ asset('burger.js') }}"></script>

</body>
</html>
