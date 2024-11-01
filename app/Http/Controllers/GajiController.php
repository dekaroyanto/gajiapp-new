<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gaji::with('karyawan');

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $gajis = $query->latest()->get();

        return view('gaji.index', compact('gajis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();

        return view('gaji.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'hadir' => 'required|integer',
            'izin' => 'nullable|integer',
            'sakit' => 'nullable|integer',
            'terlambat' => 'nullable|integer',
            'alpa' => 'nullable|integer',
            'gpokok' => 'required|numeric',
            'gjabatan' => 'nullable|numeric',
            'oprs' => 'nullable|numeric',
            'service' => 'nullable|numeric',
            'hp' => 'nullable|numeric',
            'insentif' => 'nullable|numeric',
            'angsuran' => 'nullable|numeric',
            'bpjs' => 'nullable|numeric',
            'kasbon' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ], [
            'karyawan_id.required' => 'Karyawan harus dipilih.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'hadir.required' => 'Jumlah hadir harus diisi.',
            'gpokok.required' => 'Gaji pokok harus diisi.',
            'total_gaji.required' => 'Total gaji harus diisi.',
        ]);

        // Ambil data karyawan
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        // Simpan data gaji
        Gaji::create([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'hadir' => $request->hadir ?? 0,
            'izin' => $request->izin ?? 0,
            'sakit' => $request->sakit ?? 0,
            'terlambat' => $request->terlambat ?? 0,
            'alpa' => $request->alpa ?? 0,
            'gpokok' => $request->gpokok ?? 0,
            'gjabatan' => $request->gjabatan ?? 0,
            'oprs' => $request->oprs ?? 0,
            'service' => $request->service ?? 0,
            'hp' => $request->hp ?? 0,
            'insentif' => $request->insentif ?? 0,
            'angsuran' => $request->angsuran ?? 0,
            'bpjs' => $request->bpjs ?? 0,
            'kasbon' => $request->kasbon ?? 0,
            'total_gaji' => $request->total_gaji ?? 0,
        ]);

        return redirect()->route('gaji.create')->with('success', 'Data gaji berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Mengambil data gaji dan semua karyawan untuk form
        $gaji = Gaji::findOrFail($id);
        $karyawans = Karyawan::all();

        return view('gaji.edit', compact('gaji', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'hadir' => 'required|integer',
            'izin' => 'nullable|integer',
            'sakit' => 'nullable|integer',
            'terlambat' => 'nullable|integer',
            'alpa' => 'nullable|integer',
            'gpokok' => 'required|numeric',
            'gjabatan' => 'nullable|numeric',
            'oprs' => 'nullable|numeric',
            'service' => 'nullable|numeric',
            'hp' => 'nullable|numeric',
            'insentif' => 'nullable|numeric',
            'angsuran' => 'nullable|numeric',
            'bpjs' => 'nullable|numeric',
            'kasbon' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ], [
            'karyawan_id.required' => 'Karyawan harus dipilih.',
            'tanggal.required' => 'Tanggal harus diisi.',
            'hadir.required' => 'Jumlah hadir harus diisi.',
            'gpokok.required' => 'Gaji pokok harus diisi.',
            'total_gaji.required' => 'Total gaji harus diisi.',
        ]);

        // Ambil data gaji berdasarkan ID
        $gaji = Gaji::findOrFail($id);
        $karyawan = Karyawan::findOrFail($request->karyawan_id);


        // Update data gaji
        $gaji->update([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'hadir' => $request->hadir ?? 0,
            'izin' => $request->izin ?? 0,
            'sakit' => $request->sakit ?? 0,
            'terlambat' => $request->terlambat ?? 0,
            'alpa' => $request->alpa ?? 0,
            'gpokok' => $request->gpokok ?? 0,
            'gjabatan' => $request->gjabatan ?? 0,
            'oprs' => $request->oprs ?? 0,
            'service' => $request->service ?? 0,
            'hp' => $request->hp ?? 0,
            'insentif' => $request->insentif ?? 0,
            'angsuran' => $request->angsuran ?? 0,
            'bpjs' => $request->bpjs ?? 0,
            'kasbon' => $request->kasbon ?? 0,
            'total_gaji' => $request->total_gaji ?? 0,
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mengambil data gaji berdasarkan ID dan menghapusnya
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus.');
    }

    public function rekapgaji()
    {
        return view('print.rekap');
    }

    public function filterByDate(Request $request)
    {
        $tanggal = $request->query('tanggal');
        $gajis = Gaji::with('karyawan')->whereDate('tanggal', $tanggal)->get();

        return response()->json($gajis);
    }

    // public function cetakrekap(Request $request)
    // {
    //     $tanggal = $request->query('tanggal');

    //     $gajis = Gaji::with('karyawan')->whereDate('tanggal', $tanggal)->get();

    //     if ($gajis->isEmpty()) {
    //         return redirect()->back()->with('error', 'Data tidak ditemukan untuk tanggal ini.');
    //     }

    //     $pdf = Pdf::loadView('print.cetakrekap', compact('gajis', 'tanggal'));

    //     return $pdf->stream("rekap-gaji-{$tanggal}.pdf", ['Attachment' => false]);
    // }

    public function cetakrekap(Request $request)
    {
        $tanggal = $request->query('tanggal');

        // Ambil data gaji berdasarkan tanggal
        $gajis = Gaji::with('karyawan')->whereDate('tanggal', $tanggal)->get();

        if ($gajis->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan untuk tanggal ini.');
        }

        return view('print.cetakrekap', compact('gajis', 'tanggal'));
    }
}
