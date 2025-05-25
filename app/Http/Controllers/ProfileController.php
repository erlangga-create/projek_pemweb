<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
{
    // Ambil data user yang login
    $user = auth()->user(); 
    return view('dashboard', compact('user'));
}

 public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'username' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required|string|max:20',
        ]);

        $user->update([
            'username' => $request->username,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }




    
    /**
     * Display a listing of the resource.
     */
    public function profileedit()
    {
        
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
        //
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

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

