<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $post = Post::with('user')->latest()->get();
        return view('user.index', compact('post'));
    }

    public function viewupload()
    {
        return view('user.upload');
    }

    public function upload(Request $request){

        FacadesSession::flash('title', $request->title);
        FacadesSession::flash('description', $request->description);


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'title.required' => 'Judul harus diisi',
            'description.required' => 'Deskripsi harus diisi',
            'photo.required' => 'Foto harus diisi',
            'photo.image' => 'Foto harus berupa gambar',
            'photo.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'photo.max' => 'Foto maksimal berukuran 2MB',
        ]);

        $foto_file = $request->file('photo');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('images'), $foto_nama);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $foto_nama,
            'user_id' => Auth::user()->id
        ];

        Post::create($data);
        

        return redirect('/user/upload')->with('pesan', 'Post berhasil diupload');
    }

  

    public function updateProfile(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user(); // Pastikan Anda mendapatkan user yang sedang login

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('images/profile'), $photoName);

            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/images/profile/'.$user->photo);
            }

            // Simpan nama file foto baru di basis data
            $user->photo = $photoName;
        }
        $user->save();

        return redirect()->back()->with('pesan', 'Profile photo updated successfully.');
    }
}
