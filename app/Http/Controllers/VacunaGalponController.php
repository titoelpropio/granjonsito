<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\VacunaGalpon;
use App\Http\Requests\VacunaGalponRequest;
use Session;
use Redirect;
use DB;
use Hash;

class VacunaGalponController extends Controller {
    public function __construct() {
         $this->middleware('auth');
         $this->middleware('admin');
         $this->middleware('auth',['only'=>'admin']);
    }

    function index() {
       $vacunagalpon = DB::select("select vacuna.nombre as vacuna, galpon.nombre as galpon, date_format(galpon_vacuna.fecha,'%m-%d-%Y') as fecha, galpon_vacuna.id from galpon, galpon_vacuna, vacuna where galpon.id=galpon_vacuna.id_galpon AND vacuna.id=galpon_vacuna.id_vacuna and date_format(galpon_vacuna.fecha,'%Y/%M/%d')=date_format(now(),'%Y/%M/%d')");
        return view('vacunagalpon.index', compact('vacunagalpon'));
    }

    public function create() {
        return view('vacuna.create');
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            VacunaGalpon::create([
                'id_galpon' => $request['id_galpon'],
                'id_vacuna' => $request['id_vacuna'],
            ]);
        }
        return response()->json(['mensaje' => 'GUARDADO CORRECTAMENTE']);
    }

    public function edit($id) {
        $vacuna = Vacuna::find($id);
        return view('vacuna.edit', compact('vacuna'));
    }

    public function vacunagalpon() {
        $vacuna = DB::select('select edad.edad,galpon.nombre as galpon,vacuna.nombre, vacuna.detalle,galpon.id as idgalpon,vacuna.id as idvacuna FROM galpon, edad,vacuna WHERE galpon.id=edad.id_galpon and edad.edad=vacuna.edad and vacuna.estado=1 and edad.estado=1');
        //$silo=paginate::make(DB::select($query),7);
        return view('vacuna.gaponavacunar', compact('vacuna'));
    }

    public function update($id, VacunaCreateRequest $request) {
        $vacuna->fill($request->all());
        $vacuna->save();
        return redirect('/vacuna')->with('message', 'MODIFICADO CORRECTAMENTE');
    }

    public function destroy($id) {
        $vacuna = Vacuna::find($id);
        $vacuna->delete();
        $vacuna::destroy($id);
        Session::flash('message', 'Vacuna Eliminada Correctamente');
        return Redirect::to('/vacuna');
    }

    public function lista_vacuna_galpon(Request $request) {
        $dias = DB::select("SELECT DATEDIFF('" . $request['fecha'] . "',now()) AS dias");
        foreach (  $dias as $key => $value){
          $dia=$value->dias;
        }
        if ($request->ajax()) {
            $resultado = DB::select("select g.nombre as galpon,edad.edad,v.nombre, v.detalle,g.id as idgalpon,v.id as idvacuna FROM galpon g, edad,vacuna v WHERE v.deleted_at is null and g.id=edad.id_galpon and edad.edad+". $dia . "=v.edad and v.estado=1 and edad.estado=1 and (not EXISTS(select * from galpon, galpon_vacuna, vacuna where v.id=galpon_vacuna.id_vacuna AND g.id=galpon.id and vacuna.id=galpon_vacuna.id_vacuna and date_format(galpon_vacuna.fecha,'%Y/%M/%d')=date_format(now(),'%Y/%M/%d')))");
            return response()->json($resultado);
        }
    }

}
