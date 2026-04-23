<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    //
    public function getdata(){
      $data = DB::table('m_guru')->get();
      return response()->json($data);
    }
}
