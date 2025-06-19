<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Laporan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class StaffLaporanController extends Controller
{
    /**
     * Tampilkan daftar laporan setoran untuk staff.
     */
    public function index()
    {
        // Misal staff bisa melihat semua laporan, atau filter sesuai kebutuhan
        $laporan = Laporan::with(['user', 'suratRelasi'])
                    ->latest()
                    ->paginate(10);

        return view('laporan.index-staff', compact('laporan'));
    }

    /**
     * Tampilkan form tambah laporan untuk staff.
     */
    public function create()
    {
        $users = User::all();
        $surat = Surat::all();
        return view('laporan.create-staff', compact('users', 'surat'));
    }

    /**
     * Simpan laporan baru oleh staff.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'surat_id' => 'required|exists:surat,id',
            'ayat_halaman' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Laporan::create([
            'user_id' => $request->user_id,
            'surat_id' => $request->surat_id,
            'ayat_halaman' => $request->ayat_halaman,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit laporan untuk staff.
     */
    public function edit(Laporan $laporan)
    {
        $users = User::all();
        $surat = Surat::all();
        return view('laporan.edit-staff', compact('laporan', 'users', 'surat'));
    }

    /**
     * Update laporan oleh staff.
     */
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'surat_id' => 'required|exists:surat,id',
            'ayat_halaman' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $laporan->update([
            'user_id' => $request->user_id,
            'surat_id' => $request->surat_id,
            'ayat_halaman' => $request->ayat_halaman,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Hapus laporan oleh staff.
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('staff.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
