@extends('layouts.app')

    @section('konten')
    <!-- Content -->
    <div id="content" class="p-8 transition-all duration-300 ml-0">
        <h1 class="text-2xl font-bold mb-4">Beranda</h1>
        <div id="alert-5" class="flex items-center p-4 rounded-lg bg-gray-50 dark:bg-gray-800 mb-3" role="alert">
            <svg class="flex-shrink-0 w-4 h-4 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-300">
              Selamat Datang {{ Auth::user()->name }} . Semoga Harimu senin terus!
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close">
              <span class="sr-only">Dismiss</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
            </button>
          </div>

        <!-- Postingan -->
        @foreach ($post as $posts)
            <div id="post-container-{{ $posts->id }}" class="bg-slate-100 dark:bg-gray-800 dark:text-gray-200 rounded-lg shadow-md p-6 mb-4">
                <div class="flex items-center mb-4">
                    <img class="w-10 h-10 rounded-full" src="{{ url('images').'/profile/'.$posts->user->photo }}" alt="User Avatar">
                    <div class="ml-4">
                        <h2 class="text-lg font-semibold">{{ $posts->user->name }}</h2>
                        {{-- {{ $posts->created_at->diffForHumans() }} --}}
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $posts->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-800 dark:text-gray-200 mb-4">{{ $posts->description }}</p>
                <div id="image-comment-section-{{ $posts->id }}" class="mb-4">
                    <img id="post-image-{{ $posts->id }}" class="w-full rounded-lg" src="{{ url('images').'/'.$posts->image }}" alt="Posting Image">
                </div>
                <div id="comment-section-{{ $posts->id }}" class="hidden flex-col mb-4">
                    <div class="flex">
                        <img id="small-post-image-{{ $posts->id }}" class="w-1/3 rounded-lg mr-4" src="https://via.placeholder.com/150x150" alt="Posting Image">
                        <div class="w-2/3 max-h-48 overflow-y-auto">
                            <livewire:comments :model="$posts"/>
                        </div>
                    </div>
                   
                </div>
                <div class="flex items-center mt-4">
                    <button onclick="toggleComments({{ $posts->id }})" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-500 mr-4">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v9a2 2 0 01-2 2h-6a2 2 0 01-2-2v-9a2 2 0 012-2h2m0-4h.01M12 12h.01M12 16h.01"></path>
                        </svg>
                        Komentar
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        @endsection

    