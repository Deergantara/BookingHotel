<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeKamar;

class KamarController extends Controller
{
    /**
     * Menyimpan tipe kamar yang dipilih user ke session
     */
    public function pilihKamar(Request $request, $id)
    {
        // Cari tipe kamar berdasarkan ID
        $tipeKamar = TipeKamar::findOrFail($id);

        // Simpan tipe kamar ke session
        session([
            'selected_room' => [
                'id' => $tipeKamar->id,
                'nama' => $tipeKamar->nama_tipe,
                'harga' => $tipeKamar->harga,
            ]
        ]);

        // Redirect balik ke halaman show dengan pesan sukses
        return redirect()->back()->with('success', 'Tipe kamar telah dipilih!');
    }

    /**
     * Menampilkan halaman pesan sekarang
     */
    public function pesanSekarang()
    {
        // Ambil data tipe kamar dari session
        $selectedRoom = session('selected_room');

        return view('property.pesan', compact('selectedRoom'));
    }
}
