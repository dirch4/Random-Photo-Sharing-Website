<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memize</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
    <style>
        .sidebar {
            background-color: #d1aa89; 
            width: 0;
            transition: width 0.3s ease;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 50;
        }

        .sidebar.active {
            width: 250px;
        }

        .sidebar a {
            color: #473d3a; 
        }

        .dark-mode {
            background-color: #1a202c; 
            color: #e2e8f0; 
        }

        .dark-mode .sidebar {
            background-color: #2d3748; 
        }

        .dark-mode .sidebar a {
            color: #e2e8f0; 
        }

        .dark-mode .bg-white {
            background-color: #2d3748; 
        }

        .dark-mode .text-white {
            color: #e2e8f0; 
        }

        .dark-mode-toggle {
            background-color: #2d3748; 
            color: #e2e8f0; 
        }
    </style>
     @vite('resources/css/app.css')
</head>

<body >
    <!-- Header -->
    <header class="bg-gray-800 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-white text-lg font-bold ml-4">Memize</h1>
            </div>
            <button id="dark-mode-toggle" class="dark-mode-toggle py-2 px-4 bg-gray-700 text-white rounded hover:bg-gray-600 focus:outline-none focus:shadow-outline">Dark Mode</button>
        </div>
    </header>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar bg-gray-800 text-white transition-all duration-300">
        <div class="flex justify-between items-center py-4 px-8 bg-gray-800 text-white font-bold uppercase">
            <span>Dashboard</span>
            <button id="sidebar-close" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <ul class="mt-8">
            <li><a href="/user" class="block py-2 px-4 hover:bg-white">Beranda</a></li>
            <li><a href="/profile" class="block py-2 px-4 hover:bg-white">Profil</a></li>
            <li><a href="/user/upload" class="block py-2 px-4 hover:bg-white">Upload</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-4 hover:bg-white">
              Logout
            </a></li>
            
        </ul>
    </div>

    @yield('konten')

    {{-- <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script> --}}
    <script>
        function toggleComments(postId) {
            const imageCommentSection = document.getElementById(`image-comment-section-${postId}`);
            const commentSection = document.getElementById(`comment-section-${postId}`);
            const postImage = document.getElementById(`post-image-${postId}`);
            const smallPostImage = document.getElementById(`small-post-image-${postId}`);

            if (commentSection.classList.contains('hidden')) {
                imageCommentSection.classList.add('hidden');
                commentSection.classList.remove('hidden');
                smallPostImage.src = postImage.src;
            } else {
                imageCommentSection.classList.remove('hidden');
                commentSection.classList.add('hidden');
            }
        }

        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            if (sidebar.classList.contains('active')) {
                content.classList.add('ml-64');
            } else {
                content.classList.remove('ml-64');
            }
        });

        sidebarClose.addEventListener('click', () => {
            sidebar.classList.remove('active');
            content.classList.remove('ml-64');
        });

        const darkModeToggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>
