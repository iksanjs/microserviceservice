<?php
namespace App\Http\Controllers;
use App\Bengkel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class BengkelController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
       //
   }
  
    public function index()
    {
      $bengkels = Bengkel::all();
      return response()->json($bengkels);
    }

    public function create(Request $request)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
            'nama_bengkel' => 'required',
            'jenis_bengkel' => 'required',
            'alamat_bengkel' => 'required',
            'nomor_telepon' => 'required',
        ]);

        // Buat KontrakSewa baru dan simpan ke database dengan menggunakan id penyewa dan pemakai yang telah dibuat
        $bengkel = Bengkel::create([
            'nama_bengkel' => $request->nama_bengkel,
            'jenis_bengkel' => $request->jenis_bengkel,
            'alamat_bengkel' => $request->alamat_bengkel,
            'nomor_telepon' => $request->nomor_telepon,
            'status' => 'Proses Approval',
            'approval' => 'Proses Approval'
        ]);

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'Bengkel created successfully',
            'redirect_url' => 'http://localhost:8001/bengkels' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function show($id_bengkel)
    {
        $bengkel = Bengkel::find($id_bengkel);
        return response()->json($bengkel);
    }

    public function update(Request $request, $id_bengkel)
    {
        // Lakukan validasi input
        $validatedData = $this->validate($request, [
            'nama_bengkel' => 'required',
            'jenis_bengkel' => 'required',
            'alamat_bengkel' => 'required',
            'nomor_telepon' => 'required',
        ]);
        $bengkel = Bengkel::find($id_bengkel);
        $bengkel->nama_bengkel = $request->nama_bengkel;
        $bengkel->jenis_bengkel = $request->jenis_bengkel;
        $bengkel->alamat_bengkel = $request->alamat_bengkel;
        $bengkel->nomor_telepon = $request->nomor_telepon;
        $bengkel->approval = 'Proses Approval';
        $bengkel->save();
        return response()->json($bengkel);
    }

    public function approved($id_bengkel)
    {
        $bengkel = Bengkel::find($id_bengkel);
        $bengkel->approval = 'Approved';
        $bengkel->save();
        return response()->json($bengkel);
    }

    public function rejected(Request $request, $id_bengkel)
    {
        $bengkel = Bengkel::find($id_bengkel);
        $bengkel->keterangan = $request->keterangan;
        $bengkel->approval = 'Rejected';
        $bengkel->save();
        return response()->json($bengkel);
    }
}