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
use App\Http\Requests\PosturaHuevoCreateRequest;
use App\Http\Requests\PosturaHuevoUpdateRequest;
use DB;

class PosturaHuevoController extends Controller {

    function index() {
       
    }

    public function getpostura(Request $request, $tipe) {
        if ($request->ajax()) {
           
            $lista=DB::select("SELECT postura_p,date_format(fecha,'%d/%m/%Y') as fecha from postura_huevo,edad,galpon WHERE postura_huevo.fecha BETWEEN  DATE_SUB(curdate(),INTERVAL 5 DAY) AND now() and galpon.id=edad.id_galpon and estado=1 and postura_huevo.id_galpon=galpon.id and postura_huevo.id_galpon=".$tipe);
            return response()->json($lista);
        }
    }
  public function getsilo(Request $request) {
        if ($request->ajax()) {
            $silo = DB::select("SELECT silo.id,silo.nombre,alimento.tipo from alimento,silo WHERE tipo_gallina=1 and silo.id_alimento=alimento.id
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
