<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Inventaris;

class InventarisController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Inventaris::all();
        return $this->sendResponse(true, $data);
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
        $read = $this->onlyRead();

        if (!$read) {
            return response()->json(['message' => 'access denied.']);
        }

        $hasFilled = $request->has(['nama', 'kondisi', 'keterangan', 'jumlah', 'jenis_id', 'ruang_id', 'petugas_id']);
        $lastIndex = count(Inventaris::all()) + 1;

        if ($hasFilled) {
            $data = [
                'id' => $lastIndex,
                'nama' => $request->nama,
                'kondisi' => $request->kondisi,
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'tanggal_register' => date('Y-m-d H:i:s'),
                'kode_inventaris' => 'INVEN_'. date('Ymd_His'),
                'ruang_id' => $request->ruang_id,
                'jenis_id' => $request->jenis_id,
                'petugas_id' => $request->petugas_id
            ];

            Inventaris::create($data);

            return $this->sendResponse(true, $data);
        } else {
            return $this->wasWrong();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Inventaris::where('id', $id)->first();

        if (!empty($data)) {
            return $this->sendResponse(true, $data);
        } else {
            return $this->wasWrong();
        }
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
        $read = $this->onlyRead();

        if (!$read) {
            return response()->json(['message' => 'access denied.']);
        }

        $check = Inventaris::where('id', $id)->first();
        $hasAny = $request->hasAny(['nama', 'kondisi', 'keterangan', 'jumlah', 'ruang_id', 'jenis_id', 'petugas_id']);

        if (!empty($check) && $hasAny) {
            $data = [
                'nama' => $request->nama ?: $check->nama,
                'kondisi' => $request->kondisi ?: $check->kondisi,
                'keterangan' => $request->keterangan ?: $check->keterangan,
                'jumlah' => $request->jumlah ?: $check->jumlah,
                'ruang_id' => $request->ruang_id ?: $check->ruang_id,
                'jenis_id' => $request->jenis_id ?: $check->jenis_id,
                'petugas_id' => $request->petugas_id ?: $check->petugas_id
            ];

            Inventaris::where('id', $id)->update($data);

            return $this->sendResponse(true, $data);
        } else {
            return $this->wasWrong();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $read = $this->onlyRead();

        if (!$read) {
            return response()->json(['message' => 'access denied.']);
        }

        Inventaris::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function onlyRead()
    {
        if (Auth::user()->level_id != 1) {
            return false;
        }
        return true;
    }

    private function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }
}
