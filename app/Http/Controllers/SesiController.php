<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index()
    {
        echo view('login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'admin') {
                return redirect('admin');
            } else if (Auth::user()->role == 'owner') {
                return redirect('admin/owner');
            }else {
                return redirect('user');
            }
        } else {
            return redirect('')->withErrors('Username dan password yang dimasukan tidak sesuai!')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    function register()
    {
        return view('sesi.registrasi');
    }

    public function create(Request $request)
    {
        session()->flash('name', $request->name);;
        session()->flash('email', $request->email);;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi password tidak sama dengan password',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ];

        User::create($data);
        return redirect('/')->with('pesan', 'Registrasi berhasil, silahkan login!');
    }
}
