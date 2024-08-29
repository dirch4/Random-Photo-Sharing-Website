<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Memize</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }

        .sidebar {
            background-color: #2d3748;
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
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #f4f4f9;
            display: block;
        }

        .sidebar a:hover {
            background-color: #575e75;
        }

        .content {
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 250px;
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

<body>
    <header class="bg-gray-800 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-white text-lg font-bold ml-4">Memize Admin</h1>
            </div>
            <button id="dark-mode-toggle" class="dark-mode-toggle py-2 px-4 bg-gray-700 text-white rounded hover:bg-gray-600 focus:outline-none focus:shadow-outline">Dark Mode</button>
        </div>
    </header>

    <div id="sidebar" class="sidebar">
        <div class="flex justify-between items-center py-4 px-8 bg-gray-800 text-white font-bold uppercase">
            <span>Dashboard</span>
            <button id="sidebar-close" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <a href="/admin">Dashboard</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-4 hover:bg-white">
            Logout
          </a>
    </div>

    @yield('konten')

     <!-- Include Tailwind CSS -->
     <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
     <script>
         const sidebarToggle = document.getElementById('sidebar-toggle');
         const sidebarClose = document.getElementById('sidebar-close');
         const sidebar = document.getElementById('sidebar');
         const content = document.getElementById('content');
         const darkModeToggle = document.getElementById('dark-mode-toggle');
         const body = document.body;
 
         sidebarToggle.addEventListener('click', () => {
             sidebar.classList.toggle('active');
             if (sidebar.classList.contains('active')) {
                 content.classList.add('shifted');
             } else {
                 content.classList.remove('shifted');
             }
         });
 
         sidebarClose.addEventListener('click', () => {
             sidebar.classList.remove('active');
             content.classList.remove('shifted');
         });
 
         darkModeToggle.addEventListener('click', () => {
             body.classList.toggle('dark-mode');
         });
 
         document.addEventListener('DOMContentLoaded', () => {
             const totalUsers = 1234;
             const totalUploads = 5678;
             const uploadsThisMonth = 150;
 
             document.getElementById('total-users').textContent = totalUsers;
             document.getElementById('total-uploads').textContent = totalUploads;
             document.getElementById('uploads-this-month').textContent = uploadsThisMonth;
         });
     </script>
      @vite('resources/js/app.js')
 </body>
 
 </html>
 