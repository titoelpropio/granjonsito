<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\PosturaHuevo;
use App\Galpon;
use App\Silo;
use App\Consumo;
use App\Alimento;
use Session;
use Redirect;
use App\Http\Requests\AlimentoCriaRecriaRequest;
use DB;

class AlimentoCriaRecriaController extends Controller {

    function index() {

        for ($i = 0; $i < 6; $i++) {
            $edad[$i] = 0;
            $cantidad_actual[$i] = 0;
        }
        $results = DB::select("select cantidad_actual, DATEDIFF( now(),fecha_inicio) as edad,nombre from edad,galpon where estado=1 and galpon.id=edad.id_galpon");
        foreach ($results as $key => $value) {
            $nombre = $value->nombre;
            switch ($nombre) {
                case $nombre == 'Galpon 17':
                    $edad[0] = $value->edad;
                    $cantidad_actual[0] = $value->cantidad_actual;
                    break;
                case $nombre == 'Galpon 18':
                    $edad[1] = $value->edad;
                    $cantidad_actual[1] = $value->cantidad_actual;
                    break;
                case $nombre == 'Galpon 19':
                    $edad[2] = $value->edad;
                    $cantidad_actual[2] = $value->cantidad_actual;
                    break;
                case $nombre == 'Galpon 20':
                    $edad[3] = $value->edad;
                    $cantidad_actual[3] = $value->cantidad_actual;
                    break;
                case $nombre == 'Galpon 21':
                    $edad[4] = $value->edad;
                    $cantidad_actual[4] = $value->cantidad_actual;
                    break;
                case $nombre == 'Galpon 22':
                    $edad[5] = $value->edad;
                    $cantidad_actual[5] = $value->cantidad_actual;
                    break;
            }
        }

//GRANO Q LE DA A TAL GALPON
$cantidad_c = array();
$tipo = array();
for ($i = 0; $i < 6; $i++) {
    $cantidad_c[$i] = 0;
    $tipo[$i] = "TIPO";
}       
        $resultsc = DB::select("SELECT galpon.nombre,sum(consumo.cantidad)as cantidad_c,tipo from galpon,silo,consumo,alimento,edad where galpon.id=consumo.id_galpon and consumo.id_silo=silo.id and alimento.id=silo.id_alimento and Date_format(consumo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and edad.id_galpon=galpon.id AND edad.estado=1 GROUP by galpon.nombre");
        foreach ($resultsc as $key => $value) {
           $nombre = $value->nombre;
            switch ($nombre) {
                case $nombre == 'Galpon 17':
                    $cantidad_c[0] = $value->cantidad_c;
                    $tipo[0] = $value->tipo;
                    break;
                case $nombre == 'Galpon 18':
                    $cantidad_c[1] = $value->cantidad_c;
                    $tipo[1] = $value->tipo;
                    break;
                case $nombre == 'Galpon 19':
                    $cantidad_c[2] = $value->cantidad_c;
                    $tipo[2] = $value->tipo;
                    break;
                case $nombre == 'Galpon 20':
                    $cantidad_c[3] = $value->cantidad_c;
                    $tipo[3] = $value->tipo;
                    break;
                case $nombre == 'Galpon 21':
                    $cantidad_c[4] = $value->cantidad_c;
                    $tipo[4] = $value->tipo;
                    break;
                case $nombre == 'Galpon 22':
                    $cantidad_c[5] = $value->cantidad_c;
                    $tipo[5] = $value->tipo;
                    break;      
            }
    }

//EL TOTAL DE OCNSUMO
for ($i = 0; $i < 3; $i++) {
    $alimentotg17[$i] = 0;
    $alimentotg18[$i] = 0;
    $alimentotg19[$i] = 0;
    $alimentotg20[$i] = 0;
    $alimentotg21[$i] = 0;
    $alimentotg22[$i] = 0;
}      
    $nombre = "";
    $cantidad_total = 0;

        $resultsct = DB::select("SELECT SUM(consumo.cantidad) as cantidad_total,alimento.tipo,galpon.nombre FROM consumo,silo,alimento,galpon,edad WHERE consumo.id_silo=silo.id and silo.id_alimento=alimento.id AND galpon.id=consumo.id_galpon and galpon.id=edad.id_galpon and edad.estado=1 group BY consumo.id_silo");
        foreach ($resultsct as $key => $value) {
            if ($value->nombre == "Galpon 17") {
                if ($value->tipo == "PRE") {
                    $alimentotg17[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J1") {
                    $alimentotg17[1] = $value->cantidad_total;
                }
                if ($value->tipo == "J2") {
                    $alimentotg17[2] = $value->cantidad_total;
                }
            }
            if ($value->nombre == "Galpon 18") {
                if ($value->tipo == "J1") {
                    $alimentotg18[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J2") {
                    $alimentotg18[1] = $value->cantidad_total;
                }
                if ($value->tipo == "J3") {
                    $alimentotg18[2] = $value->cantidad_total;
                }
            }
            if ($value->nombre == "Galpon 19") {
                if ($value->tipo == "J2") {
                    $alimentotg19[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J3") {
                    $alimentotg19[1] = $value->cantidad_total;
                }
            }
            if ($value->nombre == "Galpon 20") {
                if ($value->tipo == "PRE") {
                    $alimentotg20[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J1") {
                    $alimentotg20[1] = $value->cantidad_total;
                }
                if ($value->tipo == "J2") {
                    $alimentotg20[2] = $value->cantidad_total;
                }
            }
            if ($value->nombre == "Galpon 21") {
                if ($value->tipo == "J1") {
                    $alimentotg21[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J2") {
                    $alimentotg21[1] = $value->cantidad_total;
                }
                if ($value->tipo == "J3") {
                    $alimentotg21[2] = $value->cantidad_total;
                }
            }
            if ($value->nombre == "Galpon 22") {
                if ($value->tipo == "J2") {
                    $alimentotg22[0] = $value->cantidad_total;
                }
                if ($value->tipo == "J3") {
                    $alimentotg22[1] = $value->cantidad_total;
                }
            }
        }

        $resultsf = DB::select("SELECT curdate() as fecha"); //FECHA ACTUAL
        foreach ($resultsf as $key => $valuef) {
            $fecha = $valuef->fecha;
        }

        $posturahuevo = PosturaHuevo::paginate(10);
        return view('alimentocriarecria.index', compact(
        //FECHA ACTUAL
        'fecha', $fecha,
        //edades
        'edad', $edad,
        //CANTIDAD ACTUAL
        'cantidad_actual', $cantidad_actual,
        //TIPOS DE GRANOS
        'cantidad_c',$cantidad_c,'tipo',$tipo,  
        //TOTAL DE GRANO
      'alimentotg17',$alimentotg17,'alimentotg18',$alimentotg18,'alimentotg19',$alimentotg19,'alimentotg20',$alimentotg20,'alimentotg21',$alimentotg21,'alimentotg22',$alimentotg22
        ));
    }

    public function getsilocria(Request $request) {
        if ($request->ajax()) {
            $silo = DB::select("SELECT silo.id,silo.nombre,alimento.tipo from alimento,silo WHERE tipo_gallina=0 and silo.id_alimento=alimento.id
UNION
SELECT silo.id,silo.nombre,alimento.tipo from alimento,silo WHERE tipo_gallina=2 and silo.id_alimento=alimento.id");
            return response()->json($silo);
        }
    }

    public function create() {
        $posturahuev = Galpon::lists('nombre', 'id');
        return view('posturahuevo.create', compact('posturahuev'));
    }

    public function store(Request $request) {
        header('Content-type: application/json');
        $results = DB::select("select cantidad,nombre from silo where silo.id=?", [$request->id_silo]);
        foreach ($results as $key => $value) {
            $cantidad = $value->cantidad;
            $nombre = $value->nombre;
        }
        if ($cantidad < $request['cantidad']) {
            $mensaje[] = array("mensaje" => "NO ABASTASE LA CANTIDAD DESEADA EN EL " . $nombre);
        } else {
            Consumo::create([
                'id_galpon' => $request['id_galpon'],
                'id_silo' => $request['id_silo'],
                'cantidad' => $request['cantidad'],                            
            ]);
        return redirect('/alimentop')->with('message','Guardado Correctamente'); 
        }

        if ($cantidad < 500) {
            $mensaje[] = array("mensaje" => "EXITE POCA CANTIDAD DE GRANO EN EL " . $nombre);
        }
        return response()->json($mensaje);
    }

    public function edit($id) {
        $posturahuev = Galpon::lists('nombre', 'id');
        $posturahuevo = PosturaHuevo::find($id);
        return view('posturahuevo.edit', compact('posturahuev'), ['posturahuevo' => $posturahuevo]);
    }

    public function update($id, PosturaHuevoUpdateRequest $request) {
        $posturahuevo = PosturaHuevo::find($id);
        $posturahuevo->fill($request->all());
        $posturahuevo->save();
        Session::flash('message', 'Huevo Editado Correctamente');
        return Redirect::to('/posturahuevo');
    }

    public function destroy($id) {
        $posturahuevo = PosturaHuevo::find($id);
        $posturahuevo->delete();
        Session::flash('message', 'Huevo Eliminado Correctamente');
        return Redirect::to('/posturahuevo');
    }

    public function show() {
        
    }

}
