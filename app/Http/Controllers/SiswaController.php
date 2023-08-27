<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    function index()
    {
        return "saya controller index";
    }

    function detail($id)
    {
        return "saya controller diri detail $id";
    }
}
