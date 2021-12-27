<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Detail_pinjam;

class DetailPinjamController extends BaseController
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
        $data = Detail_pinjam::all();
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
        $hasFilled = $request->has(['inventaris_id', 'peminjaman_id', 'jumlah']);
        $lastIndex = count(Detail_pinjam::all()) + 1;

        if ($hasFilled) {
            $data = [
                'id' => $lastIndex,
                'peminjaman_id' => $request->peminjaman_id,
                'inventaris_id' => $request->inventaris_id,
                'jumlah' => $request->jumlah
            ];

            Detail_pinjam::create($data);

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
        $check = Detail_pinjam::where('id', $id)->first();
        $hasAny = $request->hasAny(['inventaris_id', 'peminjaman_id', 'jumlah']);

        if (!empty($check) && $hasAny) {
            $password = !isset($request->password) ? $check->password : bcrypt($request->password);
            $data = [
                'inventaris_id' => $request->inventaris_id ?: $check->inventaris_id,
                'peminjaman_id' => $request->peminjaman_id ?: $check->peminjaman_id,
                'jumlah' => $request->jumlah ?: $check->jumlah,
            ];

            Detail_pinjam::where('id', $id)->update($data);

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
        Detail_pinjam::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }
}
