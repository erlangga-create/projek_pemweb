<?php

namespace App\Http\Controllers;
use App\Models\lokasi;
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
    }

    /**
     * Show the form for creating a new resource.
     */
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

        $lokasi=lokasi::create([
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
   public function update(Request $request)
{
    $user = Auth::user();
    $user->username = $request->username;
    $user->tanggal_lahir = $request->tanggal_lahir;
    $user->nomor_telepon = $request->nomor_telepon;
    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}

public function destroy()
{
    $user = Auth::user();
    Auth::logout();
    $user->delete();

    return redirect('/')->with('success', 'Akun berhasil dihapus.');
}
}