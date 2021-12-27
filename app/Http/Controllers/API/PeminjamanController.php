<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Peminjaman;
use App\Pegawai;
use App\Petugas;

class PeminjamanController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->level_id == 3) {
            $id = Petugas::where('id', $user->id)->first()->pegawai[0]->id;
            $data = Peminjaman::where('pegawai_id', $id)->get();

            return $this->sendResponse(true, $data);
        }

        $data = Peminjaman::all();

        return $this->sendResponse(true, $data, $user->level_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $level = $this->level();

        if ($level != 3) return response()->json(['message' => 'Unauthenticated.']);

        $lastIndex = count(Peminjaman::all()) + 1;

        $pegawai_id = Petugas::where('id', Auth::user()->id)->first()->pegawai[0]->id;

        $data = [
            'id' => $lastIndex,
            'tanggal_pinjam' => date('Y-m-d H:m:s'),
            'tanggal_kembali' => $request->tanggal_kembali ?: date('Y-m-d H:m:s', strtotime('1 days')),
            'status_peminjaman' => 'waitlist',
            'pegawai_id' => $pegawai_id
        ];

        Peminjaman::create($data);

        return $this->sendResponse(true, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Peminjaman::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function level()
    {
        return Auth::user()->level_id;
    }
}
