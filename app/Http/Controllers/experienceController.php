<?php

namespace App\Http\Controllers;

use App\Models\riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class experienceController extends Controller
{




    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // sebutkan tipe experience dengan where
        $data = riwayat::where('tipe', 'experience')->orderBy('tgl_akhir', 'desc')->get();
        return view('dashboard.experience.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('info1', $request->info1);
        Session::flash('tgl_mulai', $request->tgl_mulail);
        Session::flash('tgl_akhir', $request->tgl_akhir);
        Session::flash('isi', $request->isi);
        // bagian validasi/ validasi terlebih dahulu
        $request->validate(
            [
                'judul' => 'required',
                // nama perusahaan
                'info1' => 'required',
                'tgl_mulai' => 'required',
                'isi' => 'required'
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
        );
        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'tipe' => 'experience',
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi
        ];
        // simpan dengan memanggil model halaman
        riwayat::create($data);

        // menampilkan pesan
        return redirect()->route('experience.index')->with('success', 'Berhasil menambahkan data experience');
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
        $data = riwayat::where('id', $id)->where('tipe', 'experience')->first();
        return view('dashboard.experience.edit')->with('data', $data);
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
                'info1' => 'required',
                'tgl_mulai' => 'required',
                'isi' => 'required'
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai waib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
        );
        // membuat variable data yang isinya judul dan 'isi'
        // judul yang pertama mengambil dari tabel halaman/index, lalu diisikan dari judul di create
        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'tgl_mulai' => $request->tgl_mulai,
            'isi' => $request->isi
        ];
        // melakukan proses update, yang di update data
        riwayat::where('id', $id)->update($data);

        // menampilkan pesan
        return redirect()->route('experience.index')->with('success', 'Berhasil melakuakan update data experience');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        riwayat::where('id', $id)->where('tipe', 'experience')->delete();
        return redirect()->route('experience.index')->with('success', 'Berhasil melakuakan delete data experience');
    }
}
