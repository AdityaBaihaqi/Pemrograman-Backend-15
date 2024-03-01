<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProduk;
use Illuminate\Support\Facades\Validator;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DIGUNAKAN UNTUK MENAMPILKAN DATA JENIS PRODUK
        $jenis_produk = JenisProduk::all();
        if (isset($jenis_produk)) {
            $hasil = [
                "message" => "Data Jenis Produk",
                "data" => $jenis_produk
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ditemukan",
                "data" => $jenis_produk
            ];
            return response()->json($fails, 404);
        }
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
        // DIGUNAKAN UNTUK MENAMBAHKAN DATA JENIS PRODUK
        $data = [
            'nama' => 'required|string|max:45',
        ];
        $validator = Validator::make($request->all(), $data);
        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Data Jenis Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $jenis_produk = new JenisProduk();
            $jenis_produk->nama = $request->input('nama');
            $jenis_produk->save();
            $success = [
                "message" => "Data Jenis Produk Berhasil Ditambahkan",
                "data" => $jenis_produk
            ];
            return response()->json($success, 200);
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // DIGUNAKAN UNTUK MENGUBAH DATA JENIS PRODUK
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:45',
        ]);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Mengubah Data Jenis Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        }

        $jenis_produk = JenisProduk::find($id);
        if (isset($jenis_produk)) {
            $jenis_produk->update($request->all());
            $success = [
                "message" => "Data Jenis Produk Berhasil Diubah",
                "data" => $jenis_produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DIGUNAKAN UNTUK MENGHAPUS DATA JENIS PRODUK
        $jenis_produk = JenisProduk::where('id', $id)->first();
        if (isset($jenis_produk)) {
            $jenis_produk->delete();
            $success = [
                "message" => "Data Jenis Produk Berhasil Dihapus",
                "data" => $jenis_produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Jenis Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        } 
    }
}
