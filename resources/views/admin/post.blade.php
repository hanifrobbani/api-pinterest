@extends('main')

@section('container')
<div class="p-5 bg-white rounded-lg w-full">
    <diV class="flex w-full justify-between items-center">
        <h1 class="text-lg font-semibold text-blue-600">All Post list</h1>
        <a href="/post/create" class="px-2 py-3 bg-blue-600 rounded-lg flex gap-2 text-white"><svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd" />
                <path fill-rule="evenodd" d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z" clip-rule="evenodd" />
            </svg>
            Tambah Post</a>
    </diV>
    <div class="mt-5">
        @foreach ($data as $item)
        <div class="mt-5">
            <ul class="flex flex-col gap-y-10 items-start hover:bg-gray-100 rounded-lg cursor-pointer p-2">
                <li class="relative flex flex-row items-start w-full">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="" class="shadow-md rounded-lg bg-slate-50 w-64 mr-6 md:max-h-48 object-cover">

                    <div class="flex-1">
                        <h3 class="mb-1 text-slate-900 font-semibold">
                            <span class="mb-1 block text-sm leading-6 text-indigo-500">
                                {{ $item->user }}
                            </span>{{ $item->title }}
                        </h3>
                        <div class="w-1/2 flex items-center gap-3">
                            <a class="group inline-flex items-center h-9 rounded-lg text-sm font-semibold whitespace-nowrap px-4 py-3 focus:outline-none mt-6 bg-blue-600 text-white hover:bg-blue-500" href="/post/{{ $item->id }}/edit">
                                Edit
                            </a>

                            <form action="/post/{{ $item->id }}" method="post" class="p-0 m-0">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="inline-flex items-center h-9 rounded-lg text-sm font-semibold whitespace-nowrap px-4 py-3 focus:outline-none mt-6 bg-red-600 text-white hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        @endforeach
    </div>
</div>
@endsection