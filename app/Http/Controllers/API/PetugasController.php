<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Petugas;

class PetugasController extends BaseController
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
        $data = Petugas::all();
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
        $hasFilled = $request->has(['nama_petugas', 'username', 'password', 'level_id']);
        $lastIndex = count(Petugas::all()) + 1;

        if ($hasFilled) {
            $data = [
                'id' => $lastIndex,
                'nama_petugas' => $request->nama_petugas,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'level_id' => $request->level_id
            ];

            Petugas::create($data);

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
        $data = Petugas::where('id', $id)->first();

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
        $check = Petugas::where('id', $id)->first();
        $hasAny = $request->hasAny(['nama_petugas', 'username', 'password', 'level_id']);
        if (!empty($check) && $hasAny) {
            $password = !isset($request->password) ? $check->password : bcrypt($request->password);
            $data = [
                'nama_petugas' => $request->nama_petugas ?: $check->nama_petugas,
                'username' => $request->username ?: $check->username,
                'password' => $password,
                'level_id' => $request->level_id ?: $check->level_id
            ];

            Petugas::where('id', $id)->update($data);

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
        Petugas::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }
}
