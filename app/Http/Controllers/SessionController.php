<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index()
    {
        return view("sesi/index");
    }

    function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' =>'required',
            'password' => 'required'
        ],[
            'email.required' => 'email Wajib Di Isi',
            "password.required" => 'Password wajib Di Isi'
        ]);//validasi

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('siswa')->with('sukses', 'Berhasil Login');
        }else {
            return redirect('sesi')->withErrors('Username dan passwor tidak valid');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('sesi')->with('sukses', 'berhasil logout');
    }

    function register()
    {
        return view('sesi/register');
    }

    function create(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required'
        ],[
            'name.required' => 'Nama Wajib Di Isi',
            'email.required' => 'email Wajib Di Isi',
            'email.email' => 'silahkan masukan email yang valid',
            'email.unique' => 'email dah ado, masukan yang lain',
            "password.required" => 'password wajib di isi',
            "password.min" => 'password minimal 6 kaakter'
        ]);//validasi

        $data= [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make ($request->password)
        ];
        User::create($data);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('siswa')->with('sukses', Auth::user()->name . '      Berhasil Login');
        }else {
            return redirect('sesi')->withErrors('Username dan passwor tidak valid');
        }
    }
}
