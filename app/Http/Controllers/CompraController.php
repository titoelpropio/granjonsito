<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Compra;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CompraRequest;
use DB;
use Hash;
class CompraController extends Controller
{
  /*public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }*/

  function index(){
     $silo=DB::select("SELECT silo.id,silo.nombre,silo.capacidad,silo.cantidad,alimento.tipo,silo.cantidad_minima from silo,alimento WHERE silo.id_alimento=alimento.id and silo.estado=1");
     return view('compra.index',compact('silo',$silo));
  }
  
  public function create(){
    return view('compra.create');   
  }

  public function store(CompraRequest $request){     
    if ($request->ajax()) {
         Compra::create($request->all());
        // return redirect('/compra')->with('message','GUARDADO CORRECTAMENTE');  
         return response()->json($request->all());
    }  
  }

  public function update(CompraRequest $request,$id){
    $compra= Compra::find($id);
    $compra->fill($request->all());
    $compra->save();
    return redirect('/compra')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $compra=Compra::find($id);
      return view('compra.edit',['compra'=>$compra]);
  }

  public function destroy(Request $request) {
      $id=$request->get('id_compra');
      $compra = Compra::find($id);
      $compra->delete();
      Compra::destroy($id);
      return redirect('/lista_compra')->with('message','ANULADO CORRECTAMENTE');  
      //return response()->json($id);
  }


  public function reporte_compra() {
      return view('compra.reporte_compra_alimento');
  }

  public function lista_reporte_compra($fecha_inicio, $fecha_fin){
    $rep=DB::select("SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) AND compra.deleted_at IS NULL GROUP BY alimento.tipo
      UNION
      SELECT ('saldo')AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) and compra.deleted_at IS NULL");
      return response()->json($rep);
  }

  public function obtener_compra(){ //AUMENTE ESTA CONSULTA
    $compra=DB::select("SELECT *from silo WHERE silo.estado=1");
      return response()->json($compra);
  }

  public function lista_compra() {
      return view('compra.anular_compra');
  }

  public function anular_compra($fecha_inicio,$fecha_fin){ 
     $comrpa=DB::select("SELECT silo.id as id_silo,compra.id as id_compra,alimento.id as id_alimento,silo.nombre as nombre_silo,silo.capacidad,silo.cantidad,alimento.nombre,alimento.tipo,compra.precio_compra,compra.cantidad_total,compra.fecha from compra,silo,alimento WHERE silo.id_alimento=alimento.id AND compra.id_silo=silo.id AND Date_format(compra.fecha,'%Y/%M/%d') BETWEEN Date_format('".$fecha_inicio."','%Y/%M/%d') and Date_format('".$fecha_fin."','%Y/%M/%d')  and compra.deleted_at is null");
      /*"SELECT silo.id as id_silo,compra.id as id_compra,alimento.id as id_alimento,silo.nombre as nombre_silo,silo.capacidad,silo.cantidad,alimento.nombre,alimento.tipo,compra.precio_compra,compra.cantidad_total,compra.fecha from compra,silo,alimento WHERE silo.id_alimento=alimento.id AND compra.id_silo=silo.id AND Date_format(compra.fecha,'%Y/%M/%d')=Date_format('".$fecha."','%Y/%M/%d') and compra.deleted_at is null");*/
      return response()->json($comrpa);
  }
}
