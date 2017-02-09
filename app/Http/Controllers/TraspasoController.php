<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Traspaso;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TraspasoRequest;
use DB;

class TraspasoController extends Controller
{
	function index(){
     return view('traspaso.index');
	}
  
	public function create(){
    return view('traspaso.create');		
  }

  public function getgalponcria(Request $request) {
        if ($request->ajax()) {
            $galponcria = DB::select("SELECT galpon.id,galpon.nombre,edad.edad from edad,galpon WHERE edad.id_galpon=galpon.id and edad.estado=1 and galpon.id>=17 ORDER by galpon.id");
            return response()->json($galponcria);
        }
  }

  public function getgalponponedora(Request $request) {
        if ($request->ajax()) {
            $galponponedora = DB::select("SELECT DISTINCT galpon.id,galpon.nombre FROM galpon WHERE (NOT EXISTS (SELECT * FROM edad WHERE edad.id_galpon=galpon.id and estado=1)) and galpon.id<=16");
            return response()->json($galponponedora);
        }
    }

    public function chagegalponcria(Request $request, $tipe) {
        if ($request->ajax()) {
          $cont = DB::select("SELECT id,edad,cantidad_actual,fecha_inicio from edad WHERE  estado=1 and id_galpon=".$tipe);
            return response()->json($cont);
        }
    }

}


