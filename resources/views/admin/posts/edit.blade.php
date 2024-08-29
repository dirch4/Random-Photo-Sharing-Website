@extends('admin.layoutadmin.template')

@section('konten')
    <div id="content" class="content p-8 transition-all duration-300">
        <h1 class="text-3xl font-bold mb-4">Edit Post</h1>
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <input type="text" id="description" name="description" value="{{ $post->description }}" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Image</label>
                <input type="file" id="image" name="image" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Post</button>
        </form>
    </div>
@endsection
