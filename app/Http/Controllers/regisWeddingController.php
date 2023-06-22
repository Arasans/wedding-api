<?php

namespace App\Http\Controllers;

use App\Models\Istri;
use App\Models\Suami;
use App\Models\Wedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class regisWeddingController extends Controller
{
    public function index()
    {
        $data = Wedding::with('istriR', 'suamiR')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Succeed'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentDateTime = Carbon::now()->format('Ymd_His'); // Mendapatkan waktu saat ini dalam format Ymd_His
        $fotoKTPSuami = $request->file("foto_ktp_suami");
        $fotoKTPIstri = $request->file("foto_ktp_istri");

        // Menyimpan foto KTP suami dengan nama yang unik
        $namaFotoKTPSuami = $currentDateTime . '_' . Str::random(10) . '.' . $fotoKTPSuami->getClientOriginalExtension();
        $pathFotoKTPSuami = $fotoKTPSuami->storeAs('public/foto_ktp', $namaFotoKTPSuami);

        // Menyimpan foto KTP istri dengan nama yang unik
        $namaFotoKTPIstri = $currentDateTime . '_' . Str::random(10) . '.' . $fotoKTPIstri->getClientOriginalExtension();
        $pathFotoKTPIstri = $fotoKTPIstri->storeAs('public/foto_ktp', $namaFotoKTPIstri);

        $dataSuami = [
            "nik" => $request->get("nik_suami"),
            "nama" => $request->get("nama_suami"),
            "tgl_lahir" => $request->get("tgl_lahir_suami"),
            "tempat_lahir" => $request->get("tempat_lahir_suami"),
            "status_nikah" => $request->get("status_nikah_suami"),
            "pekerjaan" => $request->get("pekerjaan_suami"),
            "alamat" => $request->get("alamat_suami"),
            "kewarganegaraan" => $request->get("kewarganegaraan_suami"),
            "umur" => $request->get("umur_suami"),
            "agama" => $request->get("agama_suami"),
            "foto_ktp" => "storage/foto_ktp/$namaFotoKTPSuami"
        ];
        $dataIstri = [
            "nik" => $request->get("nik_istri"),
            "nama" => $request->get("nama_istri"),
            "tgl_lahir" => $request->get("tgl_lahir_istri"),
            "tempat_lahir" => $request->get("tempat_lahir_istri"),
            "status_nikah" => $request->get("status_nikah_istri"),
            "pekerjaan" => $request->get("pekerjaan_istri"),
            "alamat" => $request->get("alamat_istri"),
            "kewarganegaraan" => $request->get("kewarganegaraan_istri"),
            "umur" => $request->get("umur_istri"),
            "agama" => $request->get("agama_istri"),
            "foto_ktp" => "storage/foto_ktp/$namaFotoKTPIstri"
        ];


        $suami = Suami::create($dataSuami);
        $istri = Istri::create($dataIstri);

        $idSuami = $suami->id;
        $idIstri = $istri->id;

        $dataWedding = [
            "id_suamis" => $idSuami,
            "id_istris" => $idIstri,
            "nikah_di" => $request->get("nikah_di"),
            "jam_akad" => $request->get("jam_akad"),
            "alamat_lokasi" => $request->get("alamat_lokasi"),
        ];

        $data = Wedding::create($dataWedding);
        if ($data) {
            $response = [
                "success" => True,
                "message" => "Created"
            ];
        } else {
            $response = [
                "success" => False,
                "message" => "Fail",

            ];
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wedding  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Wedding $wedding)
    {
        $data = Wedding::with('istriR', 'suamiR')->find($wedding->id);

        if ($data) {
            $response = [
                "success" => true,
                "message" => "Success",
                "data" => $data
            ];
        } else {
            $response = [
                "success" => false,
                "message" => "Not Found"
            ];
        }

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wedding  $admin
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Wedding $admin)
    // {
    //     $cek = Wedding::find($admin->id);
    //     $cek->update($request->all());
    //     $response = [
    //         "success" => true,
    //         "message" => "Updated"
    //     ];
    //     return $response;
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wedding  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wedding $wedding)
    {
        $wedding->delete();
        $wedding->istriR()->delete();
        $wedding->suamiR()->delete();

        $response = [
            "success" => true,
            "message" => "Deleted"
        ];

        return $response;
    }
}
