<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

    <!-- alphine js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.js"></script>
</head>

<body class="h-screen bg-slate-200">
    <main class="flex flex-col h-full max-w-full bg-slate-200 p-4">
        <div class="flex flex-grow">
            <div class="min-w-64 h-full pb-10 bg-white overflow-y-auto rounded-lg mr-5">
                <div class="w-full py-7 px-7 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 512 512" xml:space="preserve" class="p-0 m-0">
                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#EF7122" d="M475.758 473.124c-2.945 3.625-7.414 6.016-12.445 6.016-8.867 0-16.062-7.195-16.062-16.079 0-4.594 1.953-8.719 5.062-11.641 17.125-17.367 27.695-41.134 27.695-67.416V240c0-8.829-7.18-16-16-16h-64.009c-22.086 0-40.008-17.907-40.008-40.009v-55.986c0-53.033-42.978-96.003-95.993-96.003H127.997c-53.028 0-95.993 42.97-95.993 96.003v255.999c0 53.025 42.965 95.995 95.993 95.995h176.001c8.828 0 16.008 7.172 16.008 16 0 8.845-7.18 16.001-16.008 16.001H127.997C57.301 512 0 454.701 0 384.004v-256C0 57.299 57.301 0 127.997 0h136.001c70.704 0 128.001 57.299 128.001 128.004v48.001c0 8.829 7.156 15.985 16 15.985h64.009c22.086 0 39.992 17.922 39.992 40.009v152.005c0 34.696-13.836 66.072-36.242 89.12zM144.001 191.99c-8.844 0-16.004-7.156-16.004-15.985 0-8.844 7.16-16 16.004-16h95.993c8.848 0 16.004 7.156 16.004 16 0 8.829-7.156 15.985-16.004 15.985h-95.993zm-16.004 144.005c0-8.829 7.16-15.985 16.004-15.985h191.99c8.844 0 16 7.156 16 15.985 0 8.844-7.156 16-16 16h-191.99c-8.844 0-16.004-7.156-16.004-16zm240.002 144.004c8.844 0 16 7.172 16 16 0 8.845-7.156 16.001-16 16.001-8.828 0-16.008-7.156-16.008-16.001 0-8.828 7.18-16 16.008-16z" />
                    </svg>
                    <h1 class="text-2xl font-semibold">Aplikasi Title</h1>
                </div>
                <div class="px-5 flex flex-col gap-2 mt-5">
                    <a href="/" class="hover:bg-slate-200 rounded-lg py-2 bg-white flex gap-2 w-full items-center text-lg text-gray-600 font-normal">
                        <svg class="w-8 h-8 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                        </svg>
                        Home
                    </a>
                    <a href="/posts" class="bg-white flex gap-2 w-full items-center text-lg text-gray-600 font-normal hover:bg-slate-200 rounded-lg py-2">
                        <svg class="w-8 h-8 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
                        </svg>
                        Post
                    </a>
                    <div x-data="{ open: false }">
                        <div @click="open = !open" class="flex gap-2 w-full justify-center items-center text-lg text-gray-600 font-normal hover:bg-slate-200 rounded-lg py-2">
                            <svg class="w-8 h-8 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                            </svg>
                            Admin Control
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 ml-auto mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div x-show="open" class="mt-2">
                            <a href="/admin/posts" class="block py-2 text-gray-600 hover:bg-slate-200 rounded-lg pl-3">All Post User</a>
                            <a href="/admin/comments" class="block py-2 text-gray-600 hover:bg-slate-200 rounded-lg pl-3">Comment User</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 bg-slate-200 rounded-lg w-full">
                <nav class="bg-white w-full rounded-lg p-5 flex justify-between">
                    <div class="relative flex items-center w-full max-w-lg cursor-pointer">
                        <svg class="w-6 h-6 text-gray-600 dark:text-white absolute left-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2.2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <input
                            type="text"
                            placeholder="Cari"
                            class="w-full pl-12 pr-4 py-2 border border-gray-200 bg-gray-100 rounded-full text-gray-800 focus:outline-none font-semibold focus:ring-4" />
                    </div>
                    <div class="flex justify-center items-center gap-5">

                        @if(auth()->user()->role == "admin")
                        <p class="font-semibold text-blue-600"><span class="font-bold text-red-600">Admin: </span>{{ auth()->user()->username }}</p>
                        @else
                        <p class="font-semibold text-blue-600">{{ auth()->user()->username }}</p>
                        @endif
                        <div class="relative">
                            <div>
                                <button type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true" onclick="userDropdown()">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1526313199968-70e399ffe791?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHBob3RvJTIwcHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="">
                                </button>
                            </div>
                            <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" id="dropdown-user" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-100" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                                <form method="POST" action="/logout" role="none">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-slate-100" role="menuitem" tabindex="-1" id="menu-item-3">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </nav>
                <div class="h-auto">
                    @yield('dashboard')
                    @yield('container')
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>