<div class="hidden 588px:block bg-gradient-to-b from-stone-700 to-slate-600 h-screen overflow-auto">
    <div class="p-5 border-b flex items-end justify-center">
        <img src="/images/logo.png" class="h-8"/>
        <p class="hidden 730px:block text-amber-600 text-lg">PRAXXYS</p>
    </div>
    <div class="m-10 mt-5 mb-5 flex justify-center items-center 730px:border rounded-lg p-5">
        <div>
            <div class="flex justify-center">
                <div class="w-20 h-20">
                    <img class="object-cover w-full h-full rounded-full ring-2 ring-white p-1" src="/images/image.png"/>
                </div>
            </div>
            <p class="hidden 730px:block text-amber-600 text-center mt-4">test</p>
            <p class="hidden 730px:block text-amber-600 text-center text-2px">test@example.com</p>
        </div>
    </div>
    <div class="p-10">
        <button onclick="window.location.href = '{{ route('dashboard') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-solid fa-landmark 730px:text-sm"></i><span class="hidden 730px:block ml-2">Dashboard</span></button>
        <button onclick="window.location.href = '{{ route('create') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-regular fa-square-plus 730px:text-sm"></i><span class="hidden 730px:block ml-2">Create</span></button>
        <button onclick="window.location.href = '{{ route('videos') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-solid fa-video 730px:text-sm"></i><span class="hidden 730px:block ml-2">Videos</span></button>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="mt-40 p-10 pt-16 border-t">
        @csrf
        <button class="w-100% p-2 text-amber-600 730px:bg-amber-600 730px:text-white 730px:hover:bg-amber-700 flex items-center justify-center"><i class="fa-solid fa-right-from-bracket text-lg 730px:text-sm"></i><span class="hidden 730px:block ml-2">Logout</span></button>
    </form>
</div>

<div class="588px:hidden p-4 bg-gradient-to-r from-stone-700 to-slate-600">
   <div class="flex justify-between items-center">
       <img src="/images/logo.png" class="h-8"/>
       <button id="burger"><i class="fa-solid fa-bars text-amber-600 text-lg"></i></button>
       <button id="close" class="hidden"><i class="fa-regular fa-rectangle-xmark text-amber-600 text-lg"></i></button>

   </div>

   <div id="menu" class="hidden mt-4 h-screen slide absolute bg-slate-400/50 w-full bg-gradient-to-r from-stone-700 to-slate-600 ring-2 ring-amber-600">

    <div class="m-10 mt-5 mb-5 flex justify-center items-center border rounded-lg p-5">
        <div>
            <div class="flex justify-center">
                <div class="w-20 h-20">
                    <img class="object-cover w-full h-full rounded-full ring-2 ring-white p-1" src="/images/image.png"/>
                </div>
            </div>
            <p class=" text-amber-600 text-center mt-4">username</p>
            <p class=" text-amber-600 text-center text-2px">email@email.com</p>
        </div>
    </div>
    <div class="p-10">
        <button onclick="window.location.href = '{{ route('dashboard') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-solid fa-landmark 730px:text-sm"></i><span class="ml-2">Dashboard</span></button>
        <button onclick="window.location.href = '{{ route('create') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-regular fa-square-plus 730px:text-sm"></i><span class="ml-2">Create</span></button>
        <button onclick="window.location.href = '{{ route('videos') }}'" class="text-amber-600 w-100% p-2 hover:bg-amber-600 hover:text-white flex items-center justify-center 730px:justify-start"><i class="fa-solid fa-video 730px:text-sm"></i><span class="ml-2">Videos</span></button>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="mt-20 p-10 pt-8 border-t">
        @csrf
        <button class="w-100% p-2 text-amber-600 730px:bg-amber-600 730px:text-white 730px:hover:bg-amber-700 flex items-center justify-center"><i class="fa-solid fa-right-from-bracket text-lg 730px:text-sm"></i><span class="ml-2">Logout</span></button>
    </form>
</div>

</div>

