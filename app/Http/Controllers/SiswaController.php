<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::orderby('nomor_induk','desc')->paginate(5);
        return view('siswa/index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nomor_induk', $request->nomor_induk);
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->alamat);
        
        $request->validate([
            'nomor_induk' => 'required|numeric',
            'nama' => 'required',
            'alamat' => 'required',
            'foto'=> 'required|mimes:png,jpg,jpeg'
        ],[
            'nomor_induk.required' => 'Nomor Induk Wajib Di Isi',
            'nomor_induk.numeric' => 'Nomor Induk Wajib Di Isi Dengan Angka',
            'nama.required' => 'Nama Wajib Di Isi',
            'alamat.required' => 'Alamat Wajib Di Isi',
            'foto.required' => 'foto Wajib Di Isi',
            'foto.mimes' => 'foto Wajib berekstensi .png .jpg .jpeg'
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis').".". $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);

        $data = [
            'nomor_induk' => $request->input('nomor_induk'),
            'nama' => $request->input('nama'),
            'alamat'=> $request->input('alamat'),
            'foto'=> $foto_nama
        ];

        siswa::create($data);
        return redirect('siswa')->with('sukses','Berhasil Memasukan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = siswa::where('nomor_induk',$id)->first();
        return view('siswa/show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = siswa::where('nomor_induk', $id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required'
        ],[
            'nama.required' => 'Nama Wajib Di Isi',
            'alamat.required' => 'Alamat Wajib Di Isi'
        ]);
        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat')
        ];

        if($request->hasFile('foto')){
            $request->validate([
                'foto'=> 'mimes:png,jpg,jpeg'
            ],[
                'foto.mimes' => 'foto Wajib berekstensi .png .jpg .jpeg'
            ]);

            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis').".". $foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama); //menguppload fie baru

            $data_foto = siswa::where('nomor_induk', $id)->first();
            File::delete(public_path('foto') . '/' . $data_foto->foto);//menghapus file lama

            $data ['foto'] = $foto_nama;

        }

        siswa::where('nomor_induk', $id)->update($data);
        return redirect('/siswa')->with('sukses','berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = siswa::where('nomor_induk', $id)->first();
        File::delete(public_path('foto').'/'. $data->foto);

        siswa::where('nomor_induk', $id)->delete();
        return redirect('/siswa')->with('sukses','berhasil hapus data');
    }
}
