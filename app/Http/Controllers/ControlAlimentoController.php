<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ControlAlimento;
use App\Alimento;
use App\RangoEdad;
use App\Galpon;
use App\Silos;
use App\Http\Requests;
use App\Http\Requests\ControlAlimentoRequest;
use Session;
use Redirect;
use DB;
use Hash;

class ControlAlimentoController extends Controller {
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }

   public function index() {
    $controlalimento = DB::select("SELECT control_alimento.id, rango_edad.id as id_edad, rango_temperatura.id as id_temperatura, alimento.id as id_alimento, alimento.tipo, control_alimento.cantidad,rango_edad.edad_min,rango_edad.edad_max,rango_temperatura.temp_min,rango_temperatura.temp_max FROM control_alimento,alimento,rango_edad,rango_temperatura WHERE control_alimento.id_temperatura=rango_temperatura.id and control_alimento.id_alimento=alimento.id AND control_alimento.id_edad=rango_edad.id and control_alimento.deleted_at IS NULL order by rango_edad.edad_min");
    $alimento =Alimento::where('estado',1)->lists('tipo','id');
    $edad = DB::select("select *from rango_edad where deleted_at IS NULL");
    $temperatura = DB::select("select *from rango_temperatura where deleted_at IS NULL");

        return view('controlalimento.index', compact('controlalimento','alimento',$alimento,'edad',$edad,'temperatura',$temperatura));
    }

    public function create() {
        return view('controlalimento.create');
    }

    public function store(ControlAlimentoRequest $request) {       
        $resultado=DB::select("SELECT * FROM control_alimento WHERE control_alimento.id_temperatura=".$request->id_temperatura. " and control_alimento.id_edad=".$request->id_edad." and control_alimento.deleted_at IS NULL");
        if (count($resultado)==0) {
            if ($request->ajax()) {
                $rango_temp=DB::table('control_alimento')->insert(['id_temperatura' => $request->id_temperatura, 'id_edad' => $request->id_edad,'cantidad' => $request->cantidad,'id_alimento' => $request->id_alimento]);
                 return response()->json($request->all()); 
        }
        }
        else  return response()->json(["mensaje"=>"NO SE PUEDE AGREGAR 1 EDAD Y 1 TEMPERATURA DEL MISMO TIPO"]);
    }

    public function edit($id) {
        $ControlAlimento = ControlAlimento::find($id);
        $galpon = Galpon::lists('numero', 'id');
        $silos = Silos::lists('nombre', 'id');
        return view('ControlAlimento.edit', compact('galpon', $galpon, 'silos', $silos), ['ControlAlimento' => $ControlAlimento]);
    }

    public function update($id, ControlAlimentoRequest $request) {
            $postura_huevo = PosturaHuevo::find($id);
            $postura_huevo->fill($request->all());
            $postura_huevo->save();
             return response()->json($request->all());
    }

    public function destroy($id) {
        
        $ControlAlimento = ControlAlimento::find($id);
        $ControlAlimento->delete();
        ControlAlimento::destroy($id);
        return response()->json($id);     
    }  

}
