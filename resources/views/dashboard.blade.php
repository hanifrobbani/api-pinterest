@extends('main')
@section('dashboard')
<div class="bg-white max-w-60 p-4 rounded-lg flex items-center justify-between shadow-xl">
    <div class="w-auto">
        <h1 class="text-lg font-semibold text-slate-500">Total Post</h1>
        <p class="text-xl font-bold text-slate-800">{{ \App\Models\Post::count() }}</p>
    </div>
    <div class="p-2 bg-gradient-to-l from-cyan-500 to-blue-500 rounded-md">
        <svg class="w-8 h-8 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m4 10v-2m3 2v-6m3 6v-3m4-11v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
        </svg>
    </div>
</div>
@endsection