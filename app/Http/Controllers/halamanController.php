<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan data
        $data = halaman::orderBy('judul', 'asc')->get();
        return view('dashboard.halaman.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.halaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('isi', $request->isi);
        // bagian validasi/ validasi terlebih dahulu
        $request->validate(
            [
                'judul' => 'required',
                'isi' => 'required'
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
        );
        // membuat variable data yang isinya judul dan 'isi'
        // judul yang pertama mengambil dari tabel halaman/index, lalu diisikan dari judul di create
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi
        ];
        // simpan dengan memanggil model halaman
        halaman::create($data);

        // menampilkan pesan
        return redirect()->route('halaman.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // mengambil proses edit
        $data = halaman::where('id', $id)->first();
        return view('dashboard.halaman.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // bagian validasi/ validasi terlebih dahulu
        $request->validate(
            [
                'judul' => 'required',
                'isi' => 'required'
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
        );
        // membuat variable data yang isinya judul dan 'isi'
        // judul yang pertama mengambil dari tabel halaman/index, lalu diisikan dari judul di create
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi
        ];
        // melakukan proses update, yang di update data
        halaman::where('id', $id)->update($data);

        // menampilkan pesan
        return redirect()->route('halaman.index')->with('success', 'Berhasil melakuakan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        halaman::where('id', $id)->delete();
        return redirect()->route('halaman.index')->with('success', 'Berhasil melakuakan delete data');
    }
}
