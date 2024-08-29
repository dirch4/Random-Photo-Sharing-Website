@extends('admin.layoutadmin.template')

@section('konten')
    <div id="content" class="content p-8 transition-all duration-300">
        <h1 class="text-3xl font-bold mb-4">Edit User</h1>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                {{-- <label for="name" class="block text-gray-700">Name</label> --}}
                <input  type="hidden" id="name" name="name" value="{{ $user->name }}" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                {{-- <label for="email" class="block text-gray-700">Email</label> --}}
                <input  type="hidden" id="email" name="email" value="{{ $user->email }}" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <input type="text" id="role" name="role" value="{{ $user->role }}" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <div class="mb-4">
                {{-- <label for="photo" class="block text-gray-700">Photo</label> --}}
                <input type="hidden" id="photo" name="photo" class="p-2 border border-gray-300 rounded w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update User</button>
        </form>
    </div>
@endsection
