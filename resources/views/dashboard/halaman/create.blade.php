@extends('dashboard.layout')

@section('konten')
    <div class="pb-3"><a href="{{ route('halaman.index') }}" class="btn btn-secondary">> kembali</a></div>

    <form action="{{ route('halaman.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            {{-- value diambil dari halamancontroller(Session), begitu juga dengan isi --}}
            <input type="text" class="form-control" name="judul" id="judul" aria-describedby="helpId"
                placeholder="Judul" value="{{ Session::get('judul') }}" />
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi</label>
            <textarea name="isi" id="isi" rows="5" class="form-control summernote">{{ Session::get('isi') }}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">SIMPAN</button>
    </form>
@endsection
