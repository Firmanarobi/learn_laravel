@extends('layout/aplikasi')

@section('konten')
    <div class="w-50 text-center border rounded px-3 py-3 mx-auto">
        <h1>Selamat Datang Di Website Burik</h1>
        <p>Silahkan Login Atau Register Untuk Memasuki Website Kami Yang Berbayar</p>
        <a href="/sesi" class="btn btn-primary btn-lg">LOGIN</a>
        <a href="/sesi/register" class="btn btn-success btn-lg">REGISTER</a>
    </div>
@endsection