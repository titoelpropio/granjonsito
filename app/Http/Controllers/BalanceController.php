<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Balance;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BalanceRequest;
use DB;
use Hash;
class BalanceController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }
  
  function index(){
     $silo=DB::select("SELECT silo.id,silo.nombre,silo.capacidad,silo.cantidad,alimento.tipo from silo,alimento WHERE silo.id_alimento=alimento.id");
     return view('Balance.index',compact('silo',$silo));
  }
  
  public function create(){
    return view('Balance.create');   
  }

  public function store(BalanceRequest $request){     
        $verificar=Balance::create([
          'precio_Balance' => $request['precio_Balance'],
          'cantidad_total' => $request['cantidad_total'],
          'id_silo' => $request['id_silo'],]);
        if ($verificar!==null) {
          return redirect('/Balance')->with('message','GUARDADO CORRECTAMENTE');  
        } 
  }

  public function update(BalanceRequest $request,$id){
    $Balance= Balance::find($id);
    $Balance->fill($request->all());
    $Balance->save();
    return redirect('/Balance')->with('message','MODIFICADO CORRECTAMENTE');  
  }

  public function edit($id){
      $Balance=Balance::find($id);
      return view('Balance.edit',['Balance'=>$Balance]);
  }

  public function reporte() {
      return view('balance.reporte');
  }

  public function lista_balance_egreso($fecha_inicio, $fecha_fin){
    $egreso=DB::select("SELECT (categoria.nombre)as detalle,IFNULL(SUM(egreso_varios.precio),0)as total from egreso_varios,categoria WHERE categoria.id=egreso_varios.id_categoria and egreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' and egreso_varios.deleted_at IS NULL GROUP BY egreso_varios.id_categoria
    UNION
SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) AND compra.deleted_at IS NULL GROUP BY alimento.tipo
UNION
SELECT 'CONSUMO DE VACUNAS'AS vacunas, IFNULL(SUM(precio),0)AS precio FROM consumo_vacuna WHERE Date_format(consumo_vacuna.fecha,'%Y/%m/%d') BETWEEN Date_format('".$fecha_inicio."','%Y/%m/%d') AND Date_format('".$fecha_fin."','%Y/%m/%d')
UNION
SELECT 'CONSUMO DE VACUNAS EMERGENTES', IFNULL(SUM(precio),0)AS precio FROM consumo_emergente WHERE Date_format(consumo_emergente.fecha,'%Y/%m/%d') BETWEEN Date_format('".$fecha_inicio."','%Y/%m/%d') AND Date_format('".$fecha_fin."','%Y/%m/%d')"

);
      return response()->json($egreso);
  }

  public function lista_balance_ingreso($fecha_inicio, $fecha_fin){
      $ingreso=DB::select("SELECT (categoria.nombre)as detalle,IFNULL(SUM(ingreso_varios.precio),0)as total from ingreso_varios,categoria WHERE categoria.id=ingreso_varios.id_categoria and ingreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND ingreso_varios.deleted_at IS NULL GROUP BY ingreso_varios.id_categoria      
        UNION
      SELECT CONCAT('VENTA DE MAPLES')AS detalle,SUM(venta_huevo.precio)as TOTAL from venta_huevo,tipo_huevo,detalle_venta_huevo WHERE tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.id=detalle_venta_huevo.id_venta_huevo AND venta_huevo.estado=1 AND venta_huevo.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'
      UNION
SELECT CONCAT('VENTA DE CAJAS')AS detalle,SUM(venta_caja.precio)as TOTAL from venta_caja,tipo_caja,detalle_venta WHERE tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.id=detalle_venta.id_venta_caja AND venta_caja.estado=1 AND venta_caja.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
      return response()->json($ingreso);
      /*
      SELECT CONCAT('VENTA DE MAPLES')AS detalle,IFNULL(SUM(venta_huevo.precio),0)as TOTAL from venta_huevo,tipo_huevo,detalle_venta_huevo WHERE tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.id=detalle_venta_huevo.id_venta_huevo AND venta_huevo.estado=1 AND venta_huevo.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'
      UNION
SELECT CONCAT('VENTA DE CAJAS')AS detalle,IFNULL(SUM(venta_caja.precio),0)as TOTAL from venta_caja,tipo_caja,detalle_venta WHERE tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.id=detalle_venta.id_venta_caja AND venta_caja.estado=1 AND venta_caja.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
      */
  }

}
//EGRESO
//SELECT ('COMPRA DE GRANO')as detalle,SUM(compra.precio_compra)as total FROM compra WHERE compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_ADD('".$fecha_fin."',INTERVAL 1 DAY)