<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    function index(Request $request)
    {
        // Total Users
        $totalUsers = User::count();

        // Total Uploads
        $totalUploads = Post::count();

        // Uploads This Month
        $uploadsThisMonth = Post::where('created_at', '>=', Carbon::now()->startOfMonth())
                                ->where('created_at', '<=', Carbon::now()->endOfMonth())
                                ->count();

        // Search query
        $userQuery = $request->input('user_query');
        $postQuery = $request->input('post_query');

        // Paginated users and posts with search functionality
        $users = User::when($userQuery, function ($query, $userQuery) {
            return $query->where('name', 'like', "%{$userQuery}%")
                         ->orWhere('email', 'like', "%{$userQuery}%");
        })->paginate(5);

        $posts = Post::when($postQuery, function ($query, $postQuery) {
            return $query->where('description', 'like', "%{$postQuery}%");
        })->paginate(2);

        return view('admin.index', compact('totalUsers', 'totalUploads', 'uploadsThisMonth', 'users', 'posts'));
    }
    function owner()
    {
        echo "Halo selamat datang di halaman owner ". Auth::user()->name; // Menampilkan nama user yang sedang login
        echo "<br><a href='/logout'>Logout</a>";
    }
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/profile'), $photoName);
            $data['photo'] = $photoName;

            // Optionally, delete the old photo if exists
            if ($user->photo) {
                $oldPhotoPath = public_path('images/profile/') . $user->photo;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        }

        $user->update($data);

        return redirect()->to('admin')->with('pesan', 'User updated successfully');
    }
 

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->view('admin.index')->with('pesan', 'User deleted successfully');
    }

    public function editPost(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->update([
                'description' => $request->input('description'),
                'image' => $imagePath,
            ]);
        } else {
            $post->update($request->only('description'));
        }

        return redirect()->to('admin')->with('pesan', 'Post updated successfully');
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return redirect()->view('admin.index')->with('pesan', 'Post deleted successfully');
    }
}
