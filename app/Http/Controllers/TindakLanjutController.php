<?php

// app/Http/Controllers/TindakLanjutController.php

namespace App\Http\Controllers;

use App\Models\CLSR;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\TindakLanjut;
use App\Models\TipeObservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TindakLanjutController extends Controller
{
    // GET: /tindaklanjuts
    // app/Http/Controllers/TindakLanjutController.php


// app/Http/Controllers/TindakLanjutController.php


 // GET: /tindaklanjuts
 public function index()
 {
 // Apply the custom scope to the query, not the collection
    $tindakLanjuts = TindakLanjut::withOverdueCheck()->get();

 return response()->json($tindakLanjuts, 202);
 }

 public function index2(Request $request)
{
    // Get the status from the query parameters, expecting it as a single value or array
    $status = $request->query('status');

    // Convert single status to array for consistent handling
    if ($status && !is_array($status)) {
        $status = [$status];
    }

    // Get the start and end of the current month
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    // Fetch tindaklanjuts filtered by status and the current month
    $tindakLanjuts = TindakLanjut::query()
        ->when(!empty($status), function ($query) use ($status) {
            return $query->whereIn('status', $status);  // Use whereIn for single or multiple statuses
        })
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth]) // Filter by the current month
        ->get();

    return response()->json($tindakLanjuts, 202);
}

 

 public function index3(Request $request)
{
    // Get the status from the query parameters, expecting it as a single value or array
    $status = $request->query('status');

    // Convert single status to array for consistent handling
    if ($status && !is_array($status)) {
        $status = [$status];
    }

    // Determine the current week's start and end dates (Saturday to Friday)
    $now = Carbon::now();
    $startOfWeek = $now->copy()->startOfWeek(Carbon::SATURDAY);
    $endOfWeek = $now->copy()->endOfWeek(Carbon::FRIDAY);

    // Fetch tindaklanjuts filtered by status and within the custom week range
    $tindakLanjuts = TindakLanjut::query()
        ->when(!empty($status), function ($query) use ($status) {
            return $query->whereIn('status', $status);  // Use whereIn for single or multiple statuses
        })
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek]) // Apply week range filter
        ->get();

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
        'tipe_observasi_id' => 'required|string|max:50',
        'status' => 'required|string|max:50',
        'deskripsi' => 'required|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // updated to handle image upload
        'laporan_id' => 'required|exists:laporans,id',
        'lokasi_id' => 'required|string',
        'detail_lokasi' => 'required|string',
        'kategori_id' => 'required|string',
        'clsr_id' => 'required|string',
        'direct_action' => 'required|string',
        'non_clsr' => 'nullable|string',
    ]);

    // Handle image upload if provided
    if ($request->hasFile('img')) {
        $imagePath = $request->file('img')->store('images', 'public'); // stores in storage/app/public/images
        $validatedData['img'] = $imagePath;
    } else {
        $validatedData['img'] = null; // set to null if no image is provided
    }

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
        'follow_up' => 'nullable|string',  // Make follow_up nullable
    ]);

    // Update the status and tanggal_akhir
    $tindaklanjut->status = $request->status;
    $tindaklanjut->tanggal_akhir = $request->tanggal_akhir;
    
    // Only update follow_up if it's provided in the request
    if ($request->has('follow_up') && $request->follow_up !== null) {
        $tindaklanjut->follow_up = $request->follow_up;
    }       

    $tindaklanjut->save();

    return response()->json(['message' => 'Status and Tanggal Akhir updated successfully'], 200);
}

//Get: /TipeObservasi
public function showTipeObservasi()
{
    $tipe_observasi = TipeObservasi::all();
    return response()->json($tipe_observasi);
}
public function showTipeObservasiID($id)
{
    $tipeobservasi = TipeObservasi::findOrFail($id);
    return response()->json($tipeobservasi);
}
    //Get: /TipeObservasi
public function showKategori()
{
    $kategori = Kategori::all();
    return response()->json($kategori);
}

public function showKategoriID($id)
{
    $kategoriID = Kategori::findOrFail($id);
    return response()->json($kategoriID);
}

public function showLokasi()
{
    $lokasi = Lokasi::all();
    return response()->json($lokasi);
}
public function showLokasiID($id)
{
    $lokasis = Lokasi::findOrFail($id);
    return response()->json($lokasis);
}

public function showCLSR()
{
    $clsr = CLSR::all();
    return response()->json($clsr);
}

public function showCLSRID($id)
{
    $clsr = CLSR::findOrFail($id);
    return response()->json($clsr);
}


}