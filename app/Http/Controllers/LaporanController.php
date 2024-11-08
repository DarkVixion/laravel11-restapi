<?php

// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use App\Models\CLSR;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\TipeObservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // GET: /laporans
    public function index3()
    {
        // Get the start and end of the current week, with week starting on Saturday and ending on Friday
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SATURDAY);
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::FRIDAY);
    
        // Filter laporans to show only those created in the current customized week
        $laporans = Laporan::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
    
        // Modify each laporan to include the full image URL
        foreach ($laporans as $laporan) {
            if ($laporan->img) {
                $laporan->img_url = asset('storage/' . $laporan->img);
            }
        }
    
        return response()->json($laporans, 202);
    }
    
    public function index2()
{
    // Get the start and end of the current month
    $startOfMonth = Carbon::now()->startOfMonth();
    $endOfMonth = Carbon::now()->endOfMonth();

    // Filter laporans to show only those created in the current month
    $laporans = Laporan::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

    // Modify each laporan to include the full image URL
    foreach ($laporans as $laporan) {
        if ($laporan->img) {
            $laporan->img_url = asset('storage/' . $laporan->img);
        }
    }

    return response()->json($laporans, 202);
}

    
    public function index()
{
    $laporans = Laporan::all();

    // Modify each laporan to include the full image URL
    foreach ($laporans as $laporan) {
        if ($laporan->img) {
            $laporan->img_url = asset('storage/' . $laporan->img);
        }
    }

    return response()->json($laporans, 202);
}


public function show($id)
{
    $laporan = Laporan::findOrFail($id);

    // Add the full image URL to the response
    if ($laporan->img) {
        $laporan->img_url = asset('storage/' . $laporan->img);
    }

    return response()->json($laporan, 203);
}


    // POST: /laporans
    public function store(Request $request)
{
    // Validate the input fields
    $request->validate([
        'tanggal' => 'required|date',
        'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // 'nullable' means the image is optional
        'user_id' => 'required|exists:users,id',
        'lokasi_id' => 'required|exists:lokasis,id',
        'tipe_observasi_id' => 'required|exists:tipe_observasis,id',
        'kategori_id' => 'required|exists:kategoris,id',
        'clsr_id' => 'required|exists:clsrs,id',
        'nama_pegawai' => 'required|string',
        'email_pegawai' => 'required|string',
        'nama_fungsi' => 'required|string',
        'lokasi_spesifik' => 'required|string',
        'deskripsi_observasi' => 'required|string',
        'direct_action' => 'required|string',
        'non_clsr' => 'required|string',
        
    ]);

    // Initialize the path for the image
    $path = null;

    // Handle the image upload, if provided
    if ($request->hasFile('img')) {
        $image = $request->file('img');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Store the image in the 'public/images' directory
        $path = $image->storeAs('images', $imageName, 'public');
    }

    // Create a new Laporan record with or without the image path
    $laporan = Laporan::create([
        'tanggal' => $request->tanggal,
        'img' => $path, // Can be null if no image was uploaded
        'user_id' => $request->user_id,
        'lokasi_id' => $request->lokasi_id,
        'tipe_observasi_id' => $request->tipe_observasi_id,
        'kategori_id' => $request->kategori_id,
        'clsr_id' => $request->clsr_id,
        'nama_pegawai' => $request->nama_pegawai, 
        'email_pegawai' => $request->email_pegawai,
        'nama_fungsi' => $request->nama_fungsi,
        'lokasi_spesifik' => $request->lokasi_spesifik,
        'deskripsi_observasi' => $request->deskripsi_observasi,
        'direct_action' => $request->direct_action,
        'non_clsr'=> $request->non_clsr,
        
    ]);

    return response()->json(['laporan' => $laporan], 201);
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
        return response()->json($tipeobservasi,203);
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
        return response()->json($lokasis,203);
    }

    public function showCLSR()
    {
        $clsr = CLSR::all();
        return response()->json($clsr);
    }
    
    public function showCLSRID($id)
    {
        $clsr = CLSR::findOrFail($id);
        return response()->json($clsr,203);
    }
}