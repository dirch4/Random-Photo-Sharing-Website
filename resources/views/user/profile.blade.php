@extends('layouts.app')

@section('konten')
    <!-- Content -->
    <div id="content" class="p-8 transition-all duration-300 ml-0">
        <h1 class="text-2xl font-bold mb-4">Profil</h1>
        <div class="bg-white p-4 rounded shadow-md">
            <!-- Isi dari profil di sini -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <img src="{{ Auth::user()->photo ? asset('images/profile/' . Auth::user()->photo) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="rounded-full w-32 h-32 mx-auto mb-4">
                    <h2 class="text-xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                    <p class="text-gray-600">Joined {{ Auth::user()->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-lg font-bold mb-2">Upload Profile</h3>
                        <input type="file" id="photo" name="photo" accept="image/*" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
