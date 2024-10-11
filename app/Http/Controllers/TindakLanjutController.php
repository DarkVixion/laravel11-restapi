<?php

// app/Http/Controllers/TindakLanjutController.php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    // GET: /tindaklanjuts
    public function index()
    {
    // Apply the custom scope to the query, not the collection
    $tindakLanjuts = TindakLanjut::withOverdueCheck()->get();

    return response()->json($tindakLanjuts, 202);
    }


    // GET: /tindaklanjuts/{id}
    public function show($id)
    {
        $tindakLanjut = TindakLanjut::findOrFail($id);
        return response()->json($tindakLanjut,203);
    }

    // POST: /tindaklanjuts
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'tipe' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'img' => 'nullable|string|max:255',
            'laporan_id' => 'required|exists:laporans,id',
        ]);

        $tindakLanjut = TindakLanjut::create($validatedData);

        return response()->json($tindakLanjut, 201);
    }

    public function updateStatusAndTanggalAkhir(Request $request, $id)
    {
    $tindaklanjut = Tindaklanjut::find($id);

    if (!$tindaklanjut) {
        return response()->json(['message' => 'Tindaklanjut not found'], 404);
    }

    $request->validate([
        'status' => 'required|string',
        'tanggal_akhir' => 'required|date',
    ]);

    // Update the status and tanggal_akhir
    $tindaklanjut->status = $request->status;
    $tindaklanjut->tanggal_akhir = $request->tanggal_akhir;
    $tindaklanjut->save();

    return response()->json(['message' => 'Status and Tanggal Akhir updated successfully'], 200);
    }


}