<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function index()
    {
        $data = Kamar::all();
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $kamar = Kamar::create($request->all());
        return $kamar;
    }

    public function update(Request $request, $id)
    {
        $kamar = kamar::where("id_kamar", $id)->update($request->all());

        return response()->json([
            "message" => "Update berhasil",
            "data" => $kamar
        ], 200);
    }

    public function destroy($id)
    {
        $table = Kamar::find($id);
        if($table){
            $table->delete();
            return ["message" => "Berhasil membongkar kamar"];
        }else{
            return ["message" => "Gagal"];
        }
    }

    public function show($id)
    {
        $kamar = Kamar::find($id);
        if($kamar){
            return response()->json([
                'status' => 200,
                'message' => "data berhasil dikirim",
                'data' => $kamar
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "kamar $id tidak ditemukan",
            ], 404);
        };
    }
}
