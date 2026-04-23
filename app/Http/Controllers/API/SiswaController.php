<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    //
    public function getdata(){
        $data = DB::table('m_siswa')->get();
        return response()->json($data);
    }
}
