<?php

namespace App\Http\Controllers;

use App\Models\riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class educationController extends Controller
{



    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        // sebutkan tipe education dengan where
        $data = riwayat::where('tipe', 'education')->orderBy('tgl_akhir', 'desc')->get();
        return view('dashboard.education.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('info1', $request->info1);
        Session::flash('info2', $request->info2);
        Session::flash('info3', $request->info3);
        Session::flash('tgl_mulai', $request->tgl_mulail);
        Session::flash('tgl_akhir', $request->tgl_akhir);
        // bagian validasi/ validasi terlebih dahulu
        $request->validate(
            [
                'judul' => 'required',
                // nama perusahaan
                'info1' => 'required',
                'tgl_mulai' => 'required',
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
            ]
        );
        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'info2' => $request->info2,
            'info3' => $request->info3,
            'tipe' => 'education',
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
        ];
        // simpan dengan memanggil model halaman
        riwayat::create($data);

        // menampilkan pesan
        return redirect()->route('education.index')->with('success', 'Berhasil menambahkan data education');
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
        $data = riwayat::where('id', $id)->where('tipe', 'education')->first();
        return view('dashboard.education.edit')->with('data', $data);
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
                'info2' => 'required',
                'info3' => 'required',
                'tgl_mulai' => 'required',
            ],
            // menambahkan custom pesan
            [
                'judul.required' => 'Judul wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai waib diisi',
            ]
        );
        // membuat variable data yang isinya judul dan 'isi'
        // judul yang pertama mengambil dari tabel halaman/index, lalu diisikan dari judul di create
        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'info2' => $request->info2,
            'info3' => $request->info3,
            'tgl_mulai' => $request->tgl_mulai,

        ];
        // melakukan proses update, yang di update data
        riwayat::where('id', $id)->update($data);

        // menampilkan pesan
        return redirect()->route('education.index')->with('success', 'Berhasil melakuakan update data education');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        riwayat::where('id', $id)->where('tipe', 'education')->delete();
        return redirect()->route('education.index')->with('success', 'Berhasil melakuakan delete data education');
    }
}
