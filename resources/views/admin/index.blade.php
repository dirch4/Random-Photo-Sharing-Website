@extends('admin.layoutadmin.template')

@section('konten')
    <div id="content" class="content p-8 transition-all duration-300">
        <section id="dashboard">
            <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
            @include('alert.pesan')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-bold">Total Users</h2>
                    <p class="text-gray-600">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-bold">Total Uploads</h2>
                    <p class="text-gray-600">{{ $totalUploads }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <h2 class="text-xl font-bold">Uploads This Month</h2>
                    <p class="text-gray-600">{{ $uploadsThisMonth }}</p>
                </div>
            </div>
        </section>

        <section id="manage-users" class="mt-8">
            <h1 class="text-3xl font-bold mb-4">Manage Users</h1>
            <form method="GET" action="{{ url('/admin') }}" class="mb-4">
                <input type="text" name="user_query" value="{{ request('user_query') }}" placeholder="Search Users" class="p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">User ID</th>
                        <th class="py-2">Profile</th>
                        <th class="py-2">Nama</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Role</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 text-center">{{ $user->id }}</td>
                            <td class="py-2 item-center">
                                <img src="{{ url('images/profile/'.$user->photo) }}" alt="User Photo" class="w-10 h-10 rounded-full">
                            </td>
                            <td class="py-2 text-center">{{ $user->name }}</td>
                            <td class="py-2 text-center">{{ $user->email }}</td>
                            <td class="py-2 text-center">{{ $user->role }}</td>
                            <td class="py-2 text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                                <form onsubmit="return confirm('Yakin akan menghapus data?')" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->withQueryString()->links() }}
            </div>
        </section>

        <section id="manage-content" class="mt-8">
            <h1 class="text-3xl font-bold mb-4">Manage Content</h1>
            <form method="GET" action="{{ url('/admin') }}" class="mb-4">
                <input type="text" name="post_query" value="{{ request('post_query') }}" placeholder="Search Posts" class="p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($posts as $post)
                    <div class="card">
                        <img class="w-full rounded-lg" src="{{ url('images').'/'.$post->image }}" alt="Post Image">
                        <p>{{ $post->description }}</p>
                        <div class="buttons">
                            {{-- <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a> --}}
                            <form onsubmit="return confirm('Yakin akan menghapus data?')" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $posts->withQueryString()->links() }}
            </div>
        </section>
    </div>
@endsection
