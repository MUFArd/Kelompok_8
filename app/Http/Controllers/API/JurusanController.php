<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Jurusancontroller extends Controller
{
    //
    public function getdata(){
    $data = db::table('m_jurusan')->get();
      return response()->json($data);
    }
}
