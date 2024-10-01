@extends('main')

@section('container')

<div class="w-full pb-10">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert" id="alert">
            <span class="font-bold">Success</span> {{ session('success') }}
        </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-xl font-semibold text-left rtl:text-right text-blue-800 bg-white dark:text-white dark:bg-gray-800">
                List Comment User
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Validate comments before posting to the website</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Comment
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Title Post
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        <span>Allow Comment</span>
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        <span>Decline Comment</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                @if(!$item->is_approved)
                <tr class="whitespace-nowrap bg-white border-b dark:bg-gray-800 dark:border-gray-700 overflow-x-scroll">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->body }}
                    </th>
                    <td class="py-4 px-6 text-center">
                        {{ $item->post->title }}
                    </td>
                    <td class="py-4 flex justify-center">
                        <a href="javascript:void(0)" class="allow-comment max-w-fit p-1 font-semibold text-white bg-green-600 rounded-lg block hover:bg-green-500" data-id="{{ $item->id }}">
                            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>
                        </a>

                        <form id="allow-form-{{ $item->id }}" action="{{ route('admin.comments.allow', $item->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </td>
                    <td class="text-center align-middle">
                        <form id="delete-form-{{ $item->id }}" action="/admin/comments/{{ $item->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" style="border: none; background: none; cursor: pointer;">
                                <svg class="w-[27px] h-[27px] text-white bg-red-600 rounded-lg inline-block p-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18 17.94 6M18 18 6.06 6" />
                                </svg>
                            </button>
                        </form>
                    </td>

                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
    <script>
        setTimeout(displayAlert, 4000)

        function displayAlert() {
            document.getElementById('alert').style.display = 'none';
        }
    </script>
</div>
@endsection