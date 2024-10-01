<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    @if(session()->has('loginError'))
    <div id="alert-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-96 rounded-lg shadow-lg">
            <div class="bg-red-600 py-4 px-6 rounded-t-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="fill-current text-white" width="20" height="20">
                    <path fill-rule="evenodd" d="M4.47.22A.75.75 0 015 0h6a.75.75 0 01.53.22l4.25 4.25c.141.14.22.331.22.53v6a.75.75 0 01-.22.53l-4.25 4.25A.75.75 0 0111 16H5a.75.75 0 01-.53-.22L.22 11.53A.75.75 0 010 11V5a.75.75 0 01.22-.53L4.47.22zm.84 1.28L1.5 5.31v5.38l3.81 3.81h5.38l3.81-3.81V5.31L10.69 1.5H5.31zM8 4a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 018 4zm0 8a1 1 0 100-2 1 1 0 000 2z"></path>
                </svg>
                <span class="ml-3 text-white font-semibold">Login Error</span>
            </div>
            <div class="px-6 py-4">
                <p>{{ session('loginError') }}</p>
            </div>
            <div class="flex justify-end px-6 py-4">
                <button id="close-btn" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('close-btn').addEventListener('click', function() {
            document.getElementById('alert-modal').style.display = 'none';
        });
    </script>
    @endif

    <div class="min-h-screen flex w-full justify-center items-center">
        <form class="w-full max-w-md border border-slate-200 p-5 py-7 rounded-lg shadow-md" method="post" action="/login">
            @csrf
            <h1 class="text-2xl font-bold text-blue-600">Login</h1>
            <p class="font-semibold text-slate-700">Hello guest! Please enter your credentials.</p>

            <div class="flex flex-col mt-5">
                <label for="username" class="font-bold">Username</label>
                <input type="text" name="username" placeholder="Enter username"
                    class="w-full border border-slate-400 mt-2 px-2 py-3 rounded-md focus:outline-blue-600 placeholder:text-slate-500"
                    value="{{ old('username') }}" />
                @error('username')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <label for="password" class="font-bold mt-3">Password</label>
                <input type="password" name="password" placeholder="password"
                    class="w-full border border-slate-400 px-2 py-3 rounded-md focus:outline-blue-600 placeholder:text-slate-500" />
                <!-- Pesan error untuk password -->
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full bg-blue-600 text-white font-semibold text-center mt-4 p-2 rounded-md outline-none hover:bg-blue-500 transition" type="submit">
                Login
            </button>

            <p class="text-base text-center text-slate-600 mt-10">
                Don't have an account?
                <a href="/register" class="font-semibold text-blue-600 hover:underline">
                    Register
                </a>
            </p>
        </form>
    </div>
</body>

</html>
