<?php

namespace App\Http\Controllers;
use App\Service;
use App\Bengkel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect; // Import class Redirect

class ServiceController extends Controller
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
        $services = Service::all();
        return response()->json($services);
    }

    public function create(Request $request)
    {
        // Validasi input dari form
        $validatedData = $this->validate($request, [
            'no_polisi' => 'required',
            'id_bengkel' => 'required',
            'km' => 'required',
            'km_selanjutnya' => 'required',
            'jenis_service' => 'required',
            'tanggal_penerima_service' => 'required|date',
            'tanggal_penyerahan_service' => 'required|date',
            'sparepart' => 'required|array',
            'harga' => 'required|array',
            'qty' => 'required|array',
            'keterangan_sparepart' => 'required|array',
            'harga_jasa' => 'required',
            'total_harga_service' => 'required',
        ]);

        // Konversi array menjadi string
        $sparepart = json_encode($validatedData['sparepart']);
        $harga = json_encode($validatedData['harga']);
        $qty = json_encode($validatedData['qty']);
        $keterangan_sparepart = json_encode($validatedData['keterangan_sparepart']);

        // Simpan data service ke database
        Service::create([
            'no_polisi' => $validatedData['no_polisi'],
            'id_bengkel' => $validatedData['id_bengkel'],
            'km' => $validatedData['km'],
            'km_selanjutnya' => $validatedData['km_selanjutnya'],
            'jenis_service' => $validatedData['jenis_service'],
            'tanggal_penerima_service' => $validatedData['tanggal_penerima_service'],
            'tanggal_penyerahan_service' => $validatedData['tanggal_penyerahan_service'],
            'sparepart' => $sparepart,
            'harga' => $harga,
            'qty' => $qty,
            'keterangan_sparepart' => $keterangan_sparepart,
            'harga_jasa' => $validatedData['harga_jasa'],
            'total_harga_service' => $validatedData['total_harga_service'],
            'approval' => 'Proses Approval',
        ]);

        // Return URL halaman frontend Laravel sebagai bagian dari respons JSON
        return response()->json([
            'message' => 'Service created successfully',
            'redirect_url' => 'http://localhost:8001/services' // Ganti dengan URL halaman frontend
        ], 201);
    }

    public function show($id_service)
    {
        $service = Service::findOrFail($id_service);
        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'no_polisi' => 'required',
            'id_kontraksewa' => 'required',
            // tambahkan validasi untuk field lainnya
        ]);

        // Update data service
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('service.index')->with('success', 'Data service berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->with('success', 'Data service berhasil dihapus.');
    }

    public function approved($id_service)
    {
        $service = Service::find($id_service);
        $service->approval = 'Approved';
        $service->save();
        return response()->json($service);
    }

    public function rejected(Request $request, $id_service)
    {
        $service = Service::find($id_service);
        $service->keterangan = $request->keterangan;
        $service->approval = 'Rejected';
        $service->save();
        return response()->json($service);
    }
}
