<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController as BaseController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Level;

class LevelController extends BaseController
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
        $d = ['pegawai' => Auth::user()];
        $data = Level::all();
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
        $hasFilled = $request->has(['nama_level']);
        $lastIndex = count(Level::all()) + 1;

        if ($hasFilled) {
            $data = [
                'id' => $lastIndex,
                'nama_level' => $request->nama_level,
            ];

            Level::create($data);

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
        $data = Level::where('id', $id)->first();

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
        $check = Level::where('id', $id)->first();
        $hasAny = $request->hasAny(['nama_level']);
        if (!empty($check) && $hasAny) {
            $data = [
                'nama_level' => $request->nama_level ?: $check->nama_level,
            ];

            Level::where('id', $id)->update($data);

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
        Level::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }

    private function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }
}
