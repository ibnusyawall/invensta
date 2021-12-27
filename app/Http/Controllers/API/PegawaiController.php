<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;

class PegawaiController extends BaseController
{
    /**
     * Handling role level user
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (Auth::user()->level_id != 1) {
                return response()->json(['message' => 'access denied.']);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();
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
        $hasFilled = $request->has(['nama_pegawai', 'nip', 'alamat', 'petugas_id']);
        $lastIndex = count(Pegawai::all()) + 1;

        if ($hasFilled) {
            $data = [
                'id' => $request->id ?: $lastIndex,
                'nama_pegawai' => $request->nama_pegawai,
                'nip' => $request->nip,
                'alamat' => $request->alamat,
                'petugas_id' => $request->petugas_id
            ];

            Pegawai::create($data);

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
        $data = Pegawai::where('id', $id)->first();

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
        $check = Pegawai::where('id', $id)->first();
        $hasAny = $request->hasAny(['nama_pegawai', 'nip', 'alamat', 'petugas_id']);
        if (!empty($check) && $hasAny) {
            $data = [
                'nama_pegawai' => $request->nama_pegawai ?: $check->nama_pegawai,
                'nip' => $request->nip ?: $check->nip,
                'alamat' => $request->alamat ?: $check->alamat,
                'petugas_id' => $request->petugas_id ?: $check->petugas_id
            ];

            Pegawai::where('id', $id)->update($data);

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
        Pegawai::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }
}
