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
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }

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

  public function reporte_compra() {
      return view('compra.reporte_compra_alimento');
  }

  public function lista_reporte_compra($fecha_inicio, $fecha_fin){
    $rep=DB::select("SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) GROUP BY alimento.tipo
      UNION
      SELECT ('saldo')AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY)");
      return response()->json($rep);
  }


}
