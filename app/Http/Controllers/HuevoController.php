<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Huevo;
use App\TipoHuevo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\HuevoRequest;
use DB;

class HuevoController extends Controller{

  function index(){}

	public function create(){
   $tipohuevo=TipoHuevo::lists('tipo','id');
    return view('huevo.create',compact('tipohuevo'));		
  }

  public function store(Request $request){
  try {
  DB::beginTransaction();
  $contador=DB::select("SELECT COUNT(*)as contador,id from huevo WHERE Date_format(huevo.fecha,'%Y/%M/%d')=Date_format(now(),'%Y/%M/%d') and id_tipo_huevo=?", [$request->id_tipo_huevo]);
          foreach ($contador as $key => $value) {
              $cont = $value->contador;
              $id = $value->id;
          }
      if ($cont==0) {
        if ($request->ajax()) {
          Huevo::create($request->all());
          DB::commit();
          return response()->json($request->all());
        }
      }
      else{
        if ($request->ajax()) {
          $huevo= Huevo::find($id);
          $huevo->fill($request->all());
          $huevo->save();
          DB::commit();
          return response()->json($request->all());        
        }
      }
     } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function update(CajaRequest $request,$id){
    $huevo= Huevo::find($id);
    $huevo->fill($request->all());
    $huevo->save();
        return response()->json($request->all());
  }

  public function edit($id){
      $huevo=Huevo::find($id);
      return view('huevo.edit',['huevo'=>$huevo]);
  }

  public function obtener_huevo(Request $request, $tipe) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT huevo.id_tipo_huevo,huevo.cantidad FROM tipo_huevo th,huevo WHERE th.id=huevo.id_tipo_huevo AND Date_format(huevo.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and huevo.id_tipo_huevo=".$tipe);
          return response()->json($dato);
      }
  }

  public function obtener_huevo_deposito(Request $request) {
      if ($request->ajax()) {
        $dato = DB::select("SELECT SUM(huevo_deposito.cantidad_huevo)as cantidad FROM huevo_deposito");
          return response()->json($dato);
      }
  }

  public function listareportehuevodiario($fecha_inicio){
    $lista=DB::select("SELECT tipo_huevo.tipo,SUM(detalle_venta_huevo.cantidad_maple) as cantidad,IFNULL(SUM(detalle_venta_huevo.subtotal_precio),0)as total from venta_huevo,detalle_venta_huevo,tipo_huevo WHERE venta_huevo.id=detalle_venta_huevo.id_venta_huevo and tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.fecha='".$fecha_inicio."' AND venta_huevo.estado=1 GROUP BY tipo_huevo.id
    UNION
    SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_huevo.precio),0)AS total  from venta_huevo WHERE estado=1 and fecha='".$fecha_inicio."'");
    return response()->json($lista);
  }

  public function listareportehuevo($fecha_inicio, $fecha_fin){
      $lista=DB::select("SELECT Date_format(huevo.fecha,'%Y/%m/%d')as fecha,tipo_huevo.tipo,huevo.cantidad,huevo.total from huevo,tipo_huevo WHERE huevo.id_tipo_huevo=tipo_huevo.id and huevo.fecha BETWEEN '".$fecha_inicio."' and '".$fecha_fin."' order by huevo.fecha,tipo_huevo.tipo");
      return response()->json($lista);
  }

  public function listareportehuevototal($fecha_inicio, $fecha_fin){
    $lista=DB::select("SELECT tipo_huevo.tipo,SUM(detalle_venta_huevo.cantidad_maple) as cantidad,IFNULL(SUM(detalle_venta_huevo.subtotal_precio),0)as total from venta_huevo,detalle_venta_huevo,tipo_huevo WHERE venta_huevo.id=detalle_venta_huevo.id_venta_huevo and tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND venta_huevo.estado=1 GROUP BY tipo_huevo.id
      UNION
      SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_huevo.precio),0)AS total  from venta_huevo WHERE estado=1 and fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
      return response()->json($lista);
  }

  public function reporte() {
      return view('huevo.reporte');
  }

  public function reportediario() {
      return view('huevo.reportediario');
  }
}
