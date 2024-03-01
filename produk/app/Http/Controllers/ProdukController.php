<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DIGUNAKAN UNTUK MENAMPILKAN DATA PRODUK
        $produk = Produk::all();
        if (isset($produk)) {
            $hasil = [
                "message" => "Data Produk",
                "data" => $produk
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Ditemukan",
                "data" => $produk
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
        // DiGUNAKAN UNTUK MENAMBAHKAN DATA PRODUK
        $data = [
            'nama' => 'required|string|max:45',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'idjenis' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $data);
        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Data Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $produk = new Produk();
            $produk->nama = $request->input('nama');
            $produk->stok = $request->input('stok');
            $produk->harga = $request->input('harga');
            $produk->idjenis = $request->input('idjenis');
            $produk->save();
            $success = [
                "message" => "Data Produk Berhasil Ditambahkan",
                "data" => $produk
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
        // DIGUNAKAN UNTUK MENGUBAH DATA PRODUK
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:45',
            'stok' => 'integer',
            'harga' => 'integer',
            'idjenis' => 'integer'
        ]);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Mengubah Data Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        }

        $produk = Produk::find($id);
        if (isset($produk)) {
            $produk->update($request->all());
            $success = [
                "message" => "Data Produk Berhasil Diubah",
                "data" => $produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DIGUNAKAN UNTUK MENGHAPUS DATA PRODUK
        $produk = Produk::where('id', $id)->first();
        if (isset($produk)) {
            $produk->delete();
            $success = [
                "message" => "Data Produk Berhasil Dihapus",
                "data" => $produk
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                "message" => "Data Produk Tidak Ditemukan",
            ];
            return response()->json($fails, 404);
        }  
    }
}
