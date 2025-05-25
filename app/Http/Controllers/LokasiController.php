<?php

namespace App\Http\Controllers;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LokasiController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lokasi = Lokasi::where('user_id', auth()->id())->get();
        return view('lokasi', ['lokasi' => $lokasi]);

    }

    /**
     * Show the form for creating a new resource.
     */

     public function setDefault($id)
{
    $userId = auth()->id();

    // Reset all alamat to not default
    Lokasi::where('user_id', $userId)->update(['is_default' => false]);

    // Set selected alamat as default
    Lokasi::where('id', $id)->where('user_id', $userId)->update(['is_default' => true]);

    return redirect()->back()->with('success', 'Alamat default berhasil diperbarui.');
}
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $lokasi=Lokasi::create([
            'user_id' => auth()->id(),
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('lokasi')->with('success', 'Alamat berhasil ditambahkan!');
    }
    /**
     * Display the specified resource.
     */
    public function show(lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lokasi $lokasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
    ]);

    $lokasi = Lokasi::findOrFail($id);

    // Cek agar hanya pemilik alamat yang bisa update
    if ($lokasi->user_id === auth()->id()) {
        $lokasi->update([
            'alamat' => $request->alamat,
        ]);
    }

    return redirect()->route('lokasi')->with('success', 'Alamat berhasil diperbarui.');
}


public function destroy($id)
{
    $lokasi = Lokasi::findOrFail($id);

    // Cek agar hanya pemilik alamat yang bisa hapus
    if ($lokasi->user_id === auth()->id()) {
        $lokasi->delete();
    }

    return redirect()->route('lokasi')->with('success', 'Alamat berhasil dihapus.');
}

}