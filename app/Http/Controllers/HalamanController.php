<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanController extends Controller
{
    function index ()
    {
        return view("halaman/index");
    }

    function tentang ()
    {
        return view("halaman.tentang");
    }

    function kontak()
    {
        $data = [
            'judul' => 'halaman kontak baru',
            'kontak' => [
                'email' => 'firman@gmail.com',
                'facebook' => 'firman'
                ]
            ];
        return view("halaman.kontak")->with($data);
    }
}
