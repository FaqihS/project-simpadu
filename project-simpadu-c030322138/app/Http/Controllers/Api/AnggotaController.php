<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnggotaResource;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::all();
        return AnggotaResource::collection($anggota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:80',
            'email' => 'required|email|unique:anggotas',
            'usia' => 'numeric',
            'tgl_lahir' => 'string',
            'alamat' => 'string',
            'gender' => 'string',
            'status' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $anggota = Anggota::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'usia' => $request['usia'],
            'tgl_lahir' => $request['tgl_lahir'],
            'alamat' => $request['alamat'],
            'gender' => $request['gender'],
            'status' => $request['status'],
            'hobi' => $request['hobi']
        ]);

        return AnggotaResource::make($anggota);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $anggota= Anggota::findOrFail($id);
        if(!$anggota){
            return response()->json(['errors' => "Not Found"], 404);
        }

        return AnggotaResource::make($anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:80',
            'email' => [ 'email', Rule::unique('anggotas')->ignore($id), ],
            'usia' => 'numeric',
            'tgl_lahir' => 'string',
            'alamat' => 'string',
            'gender' => 'string',
            'status' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $anggota = Anggota::findOrFail($id);
        if(!$anggota){
            return response()->json(['errors' => "Not Found"], 404);
        }

        $anggota->update($request->only([
            'nama',
            'email',
            'usia' ,
            'tgl_lahir',
            'alamat' ,
            'gender' ,
            'status' ,
            'hobi'
        ]));



        return AnggotaResource::make($anggota);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota= Anggota::findOrFail($id);
        if(!$anggota){
            return response()->json(['errors' => "Not Found"], 404);
        }
        $anggota->delete();
        return response()->json(['message' => "Anggota deleted Successfully"], 203);
    }
}
