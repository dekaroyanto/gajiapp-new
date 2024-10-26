<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil unique jabatan untuk dropdown
        $jabatan = Karyawan::select('jabatan')->distinct()->pluck('jabatan');

        // Query dasar
        $query = Karyawan::query();

        // Filter berdasarkan jabatan jika ada
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        // Ambil data karyawan dengan filter
        $karyawans = $query->get(); // Ubah variable menjadi karyawans sesuai view

        return view('karyawan.index', compact('karyawans', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'nama_jabatan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:karyawans,nik',
            'norek' => 'required|numeric|unique:karyawans,norek',
            'no_telp' => 'required|numeric|unique:karyawans,no_telp',
            'tgl_masuk' => 'required|date',
            'lama_kerja' => 'required|numeric',

        ], [
            'nama_karyawan.required' => 'Nama harus diisi',
            'nama_jabatan.required' => 'Jabatan harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'nik.required' => 'NIK harus diisi',
            'norek.required' => 'No Rekening harus diisi',
            'no_telp.required' => 'No Telepon harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'norek.unique' => 'No Rekening sudah terdaftar',
            'no_telp.unique' => 'No Telepon sudah terdaftar',
            'tgl_masuk.required' => 'Tgl. Masuk harus diisi',
            'lama_kerja.required' => 'Lama Kerja harus diisi',
        ]);

        $jabatan = $request->jabatan;
        $existingKaryawans = DB::table('karyawans')
            ->where('jabatan', $jabatan)
            ->count();

        $kode_jabatan = strtoupper($jabatan) . sprintf('%03d', $existingKaryawans + 1);

        Karyawan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $jabatan,
            'nama_jabatan' => $request->nama_jabatan,
            'kode_jabatan' => $kode_jabatan,
            'nik' => $request->nik,
            'norek' => $request->norek,
            'no_telp' => $request->no_telp,
            'tgl_masuk' => $request->tgl_masuk,
            'lama_kerja' => $request->lama_kerja,

        ]);

        return redirect()->route('karyawan.create')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'nama_jabatan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nik' => 'required|numeric|unique:karyawans,nik,' . $id,
            'norek' => 'required|numeric|unique:karyawans,norek,' . $id,
            'no_telp' => 'required|numeric|unique:karyawans,no_telp,' . $id,
            'tgl_masuk' => 'required|date',
            'lama_kerja' => 'required|numeric',
        ],  [
            'nama_karyawan.required' => 'Nama harus diisi',
            'nama_jabatan.required' => 'Jabatan harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'nik.required' => 'NIK harus diisi',
            'norek.required' => 'No Rekening harus diisi',
            'no_telp.required' => 'No Telepon harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'norek.unique' => 'No Rekening sudah terdaftar',
            'no_telp.unique' => 'No Telepon sudah terdaftar',
            'tgl_masuk.required' => 'Tgl. Masuk harus diisi',
            'lama_kerja.required' => 'Lama Kerja harus diisi',
        ]);

        // Temukan karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($id);

        // Jika jabatan berubah, kita buat kode jabatan baru
        if ($karyawan->jabatan !== $request->jabatan) {
            // Hitung jumlah karyawan dengan jabatan baru ini
            $existingKaryawanCount = Karyawan::where('jabatan', $request->jabatan)->count();

            // Buat kode jabatan baru
            $newKodeJabatan = strtolower($request->jabatan) . sprintf('%03d', $existingKaryawanCount + 1);
        } else {
            // Jika jabatan tidak berubah, tetap gunakan kode jabatan yang lama
            $newKodeJabatan = $karyawan->kode_jabatan;
        }

        // Update data karyawan
        $karyawan->nama_karyawan = $request->nama_karyawan;
        $karyawan->nama_jabatan = $request->nama_jabatan;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->kode_jabatan = $newKodeJabatan;
        $karyawan->nik = $request->nik;
        $karyawan->norek = $request->norek;
        $karyawan->no_telp = $request->no_telp;
        $karyawan->tgl_masuk = $request->tgl_masuk;
        $karyawan->lama_kerja = $request->lama_kerja;


        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $kode_jabatan_dihapus = $karyawan->kode_jabatan;
        $jabatan = $karyawan->jabatan;

        $karyawan->delete();

        $kode_urut_dihapus = intval(substr($kode_jabatan_dihapus, strlen($jabatan)));

        $karyawans_lainnya = Karyawan::where('jabatan', $jabatan)
            ->whereRaw("CAST(SUBSTRING(kode_jabatan, LENGTH(jabatan) + 1) AS UNSIGNED) > ?", [$kode_urut_dihapus])
            ->orderBy('kode_jabatan')
            ->get();

        foreach ($karyawans_lainnya as $karyawan_lain) {
            $kode_urut_baru = intval(substr($karyawan_lain->kode_jabatan, strlen($jabatan))) - 1;

            $karyawan_lain->kode_jabatan = strtoupper($jabatan) . sprintf('%03d', $kode_urut_baru);

            $karyawan_lain->save();
        }

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus dan kode jabatan telah diperbarui.');
    }
}
