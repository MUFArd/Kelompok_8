<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    //
    public function getdata() {
        $data = DB::table('m_kelas')->get();
        return response()->json( $data);    
    }
}
