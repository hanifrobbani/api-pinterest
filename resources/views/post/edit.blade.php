@extends('main')

@section('container')

<div class="w-full px-4 py-5">
    <h1 class="mb-5 text-2xl font-semibold">Edit Post</h1>
    <form action="/posts/{{ $data->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-4 w-auto">
            <input type="text" class="w-1/2 bg-white outline-none border-2 p-2 rounded-xl focus:border-blue-600 transition focus:ring-4 focus:ring-blue-200 {{ $errors->has('title') ? 'border-red-500' : 'border-slate-300' }}" placeholder="title" name="title" value="{{ old('title', $data->title) }}">
            @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4 w-auto">
            <div class="w-1/2 border-2 min-h-36 bg-white p-6 rounded-lg flex flex-col items-center justify-center cursor-pointer {{ $errors->has('image') ? 'border-red-500' : 'border-slate-300' }}" id="file-upload-wrapper">
                @if ($data->image)
                <img id="img-preview" class="h-36 w-auto mb-4" src="{{ asset('storage/' . $data->image) }}" alt="Image Preview"> <!-- Pratinjau gambar -->
                @else
                <img id="img-preview" class="hidden h-36 w-auto mb-4" alt="Image Preview"> <!-- Pratinjau gambar -->
                @endif
                <svg id="svg-icon" width="52" height="52" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10V11H17C18.933 11 20.5 12.567 20.5 14.5C20.5 16.433 18.933 18 17 18H16C15.4477 18 15 18.4477 15 19C15 19.5523 15.4477 20 16 20H17C20.0376 20 22.5 17.5376 22.5 14.5C22.5 11.7793 20.5245 9.51997 17.9296 9.07824C17.4862 6.20213 15.0003 4 12 4C8.99974 4 6.51381 6.20213 6.07036 9.07824C3.47551 9.51997 1.5 11.7793 1.5 14.5C1.5 17.5376 3.96243 20 7 20H8C8.55228 20 9 19.5523 9 19C9 18.4477 8.55228 18 8 18H7C5.067 18 3.5 16.433 3.5 14.5C3.5 12.567 5.067 11 7 11H8V10ZM15.7071 13.2929L12.7071 10.2929C12.3166 9.90237 11.6834 9.90237 11.2929 10.2929L8.29289 13.2929C7.90237 13.6834 7.90237 14.3166 8.29289 14.7071C8.68342 15.0976 9.31658 15.0976 9.70711 14.7071L11 13.4142V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13.4142L14.2929 14.7071C14.6834 15.0976 15.3166 15.0976 15.7071 14.7071C16.0976 14.3166 16.0976 13.6834 15.7071 13.2929Z" fill="#475569" />
                </svg>
                <span id="upload-text" class="text-gray-500">Upload file or Image</span>
                <input type="file" id="file-upload-input" class="hidden" name="image" onchange="previewImage()">
            </div>
            @error('image')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between w-1/2 gap-3">
            <a href="/post" class="w-full text-center py-2 bg-white rounded-lg text-slate-600 font-semibold mt-4 border-2 border-slate-400 focus:border-blue-600 transition focus:ring-4 focus:ring-blue-200">Cancel</a>
            <button class="w-full text-center py-2 bg-blue-600 rounded-lg text-white font-semibold mt-4 focus:border-blue-600 transition focus:ring-4 focus:ring-blue-200 hover:bg-blue-500" type="submit">Update</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('file-upload-wrapper').addEventListener('click', function() {
        document.getElementById('file-upload-input').click();
    });

    function previewImage() {
        const image = document.querySelector('#file-upload-input');
        const imgPreview = document.querySelector('#img-preview');
        const svgIcon = document.querySelector('#svg-icon');
        const uploadText = document.querySelector('#upload-text');

        const fileReader = new FileReader();
        fileReader.readAsDataURL(image.files[0]);

        fileReader.onload = function(event) {
            imgPreview.src = event.target.result;
            imgPreview.classList.remove('hidden');
            svgIcon.classList.add('hidden');
            uploadText.classList.add('hidden');
        }
    }
</script>
@endsection