@extends('layout.aplikasi')

@section('konten')
<h1>{{ $judul }}</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus sunt praesentium odio corporis perferendis aliquam. Nisi est adipisci, consequuntur repellendus, voluptatibus explicabo, vitae iusto quos repellat maxime quod sapiente quam.</p>
<p><ul><li>
    email : {{ $kontak['email'] }}
</li>
<li>fb : {{ $kontak ['facebook'] }}</li>

</ul></p>

@endsection