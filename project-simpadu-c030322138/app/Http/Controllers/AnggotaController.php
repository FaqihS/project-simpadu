<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = DB::table('anggotas')
            ->select(
                'id',
                'nama',
                'email',
                'usia',
                DB::raw('DATE_FORMAT(tgl_lahir, "%d %M %Y")as tgl_lahir'),
                'alamat',
                'gender',
                'status',
                'hobi'
            )
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('pages.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('pages.anggota.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnggotaRequest $request)
    {

        $hobi = array_values($request['hobi']);
        $shobi = implode(', ', $hobi);


        Anggota::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'usia' => $request['usia'],
            'tgl_lahir' => $request['tgl_lahir'],
            'alamat' => $request['alamat'],
            'gender' => $request['gender'],
            'status' => $request['status'],
            'hobi' => $shobi
        ]);

        return redirect(route('anggota.index'))->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('pages.anggota.edit')->with('anggota', $anggota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggotaRequest $request,  $id)
    {
        //
        $anggota = Anggota::findOrFail($id);
        $request['hobi'] = array_values($request['hobi']);
        $request['hobi'] = implode(', ', $request['hobi']);
        $validated = $request->validated();
        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success','Data Berhasil di Update');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Delete Anggota Successfully');
    }
}
