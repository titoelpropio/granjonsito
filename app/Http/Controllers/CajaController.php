<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Caja;
use App\TipoCaja;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CajaRequest;
use DB;

class CajaController extends Controller
{
  
  function index(){
    return view('caja.index'); 
  }

	public function create(){
   $tipocaja=TipoCaja::lists('tipo','id');
    return view('caja.create',compact('tipocaja'));		
  }

  public function store(Request $request){
    try {
    DB::beginTransaction();
        $contador=DB::select("SELECT COUNT(*) as contador,id from caja WHERE Date_format(caja.fecha,'%Y/%M/%d')= Date_format(now(),'%Y/%M/%d') and id_tipo_caja=?", [$request->id_tipo_caja]);
        foreach ($contador as $key => $value) {
            $cont = $value->contador;
            $id = $value->id;
        }
        if ($cont==0) {
          if ($request->ajax()) {
            Caja::create($request->all());
            DB::commit();
            return response()->json($request->all());        
          }
        }
        else{
          if ($request->ajax()) {
            $caja= Caja::find($id);
            $caja->fill($request->all());
            $caja->save();   
            DB::commit();     
            return response()->json($request->all());
          }  
        }
    } catch (Exception $e) {
      DB::rollback();
    }
  }

    public function update(CajaRequest $request, $id) {
        if ($request->ajax()) {
            $actua = DB::table('caja')->where('id', $id)->update(['cantidad_caja' => $request->cantidad_caja, 'cantidad_maple' => $request->cantidad_maple, 'cantidad_huevo' => $request->cantidad_huevo, 'id_tipo_caja' => $request->id_tipo_caja, 'fecha' => $request->fecha]);
            return response()->json($request->all());
        }
    }

  public function edit($id){
      $caja=Caja::find($id);
      return view('caja.edit',['caja'=>$caja]);
  }

    public function listareportecajadiario($fecha_inicio){
        $otrocd=DB::select("SELECT Date_format(venta_caja.fecha,'%Y/%m/%d') as fecha,tipo_caja.tipo,SUM(detalle_venta.cantidad_caja) as cantidad,SUM(detalle_venta.subtotal_precio) as total from venta_caja,detalle_venta,tipo_caja WHERE venta_caja.id=detalle_venta.id_venta_caja and tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.fecha='".$fecha_inicio."' AND venta_caja.estado=1 GROUP BY tipo_caja.id
UNION
SELECT ('')as fecha,('total')as total,('')as cantidad,IFNULL(SUM(venta_caja.precio),0)AS total  from venta_caja WHERE estado=1 and fecha='".$fecha_inicio."'");
        return response()->json($otrocd);
    }

    public function lista_reporte_caja($fecha_inicio, $fecha_fin){  //LISTA DE LAS CAJAS
       $lista2=array();
       $lista=DB::select("SELECT date_format(caja.fecha,'%Y/%m/%d')as fechas FROM caja,tipo_caja WHERE caja.id_tipo_caja=tipo_caja.id AND caja.fecha BETWEEN date_format('".$fecha_inicio."','%Y/%m/%d') AND date_sub(date_format('".$fecha_fin."','%Y/%m/%d'),INTERVAL -1 day) GROUP BY fechas  ORDER BY fecha DESC,tipo_caja.id");
       for ($i=0; $i < count($lista) ; $i++) { 
            $lista2[$i]=DB::select("SELECT caja.id as id_caja,tipo_caja.id as id_tipo_caja, tipo_caja.tipo,caja.cantidad_caja,date_format(caja.fecha,'%Y/%m/%d')as fecha FROM caja,tipo_caja WHERE caja.id_tipo_caja=tipo_caja.id AND date_format(caja.fecha,'%Y/%m/%d')=date_format('".$lista[$i]->fechas."','%Y/%m/%d')  ORDER BY tipo_caja.id");   
       }
      return response()->json($lista2);
/*        $caja=DB::select("SELECT caja.id as id_caja,tipo_caja.id as id_tipo_caja, tipo_caja.tipo,caja.cantidad_caja,date_format(caja.fecha,'%Y/%m/%d')as fecha FROM caja,tipo_caja WHERE caja.id_tipo_caja=tipo_caja.id AND caja.fecha BETWEEN date_format('".$fecha_inicio."','%Y/%m/%d') AND date_sub(date_format('".$fecha_fin."','%Y/%m/%d'),INTERVAL -1 day)  ORDER BY fecha DESC,tipo_caja.id");
        return response()->json($caja);*/
    }
    
    public function lista_reporte_caja_total($fecha_inicio, $fecha_fin){ //LISTA PARA COMPARAR LAS CAJAS
        $caja=DB::select("SELECT caja.id as id_caja,tipo_caja.id as id_tipo_caja, tipo_caja.tipo,SUM(caja.cantidad_caja)as cantidad_caja FROM caja,tipo_caja WHERE caja.id_tipo_caja=tipo_caja.id AND caja.fecha BETWEEN date_format('".$fecha_inicio."','%Y/%m/%d') AND date_sub(date_format('".$fecha_fin."','%Y/%m/%d'),INTERVAL -1 day) GROUP BY tipo_caja.id ORDER BY tipo_caja.id");
        return response()->json($caja);
    }

    public function lista_reporte_maple($fecha_inicio, $fecha_fin){  //LISTA DE LOS MAPLES
       $lista2=array();
       $lista=DB::select("SELECT date_format(huevo.fecha,'%Y/%m/%d')as fechas FROM huevo,tipo_huevo WHERE huevo.id_tipo_huevo=tipo_huevo.id AND huevo.fecha BETWEEN date_format('".$fecha_inicio."','%Y/%m/%d') AND date_sub(date_format('".$fecha_fin."','%Y/%m/%d'),INTERVAL -1 day) GROUP BY fechas  ORDER BY fecha DESC,tipo_huevo.id");
       for ($i=0; $i < count($lista) ; $i++) { 
            $lista2[$i]=DB::select("SELECT huevo.id as id_huevo,tipo_huevo.id as id_tipo_huevo, tipo_huevo.tipo,huevo.cantidad_maple,huevo.cantidad_huevo,date_format(huevo.fecha,'%Y/%m/%d')as fecha FROM huevo,tipo_huevo WHERE huevo.id_tipo_huevo=tipo_huevo.id AND date_format(huevo.fecha,'%Y/%m/%d')=date_format('".$lista[$i]->fechas."','%Y/%m/%d')  ORDER BY tipo_huevo.id");   
       }
      return response()->json($lista2);
    }
    
    public function lista_reporte_maple_total($fecha_inicio, $fecha_fin){ //LISTA PARA COMPARAR LOS MAPLES
        $maple=DB::select("SELECT huevo.id as id_huevo,tipo_huevo.id as id_tipo_huevo, tipo_huevo.tipo,SUM(huevo.cantidad_maple)as cantidad_maple,SUM(huevo.cantidad_huevo)as cantidad_huevo FROM huevo,tipo_huevo WHERE huevo.id_tipo_huevo=tipo_huevo.id AND huevo.fecha BETWEEN date_format('".$fecha_inicio."','%Y/%m/%d') AND date_sub(date_format('".$fecha_fin."','%Y/%m/%d'),INTERVAL -1 day) GROUP BY tipo_huevo.id ORDER BY tipo_huevo.id");
        return response()->json($maple);
    }

    public function listareportecajatotal($fecha_inicio, $fecha_fin){
        $otroct=DB::select("SELECT tipo_caja.tipo,SUM(detalle_venta.cantidad_caja)as cantidad,SUM(detalle_venta.subtotal_precio)as total from venta_caja,detalle_venta,tipo_caja WHERE venta_caja.id=detalle_venta.id_venta_caja and tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND venta_caja.estado=1 GROUP BY tipo_caja.id
            UNION
            SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_caja.precio),0)AS total  from venta_caja WHERE estado=1 and fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
        return response()->json($otroct);
    }

    public function reporte() {
        return view('caja.reporte');
    }
    public function reportediario() {
        return view('caja.reportediario');
    }    
    public function lista_caja() {
        return view('caja.lista_caja');
    }
    public function comparar_cajas() {
        return view('caja.comparar_cajas');
    }
    public function lista_maple() {
        return view('caja.lista_maple');
    }
    public function comparar_maples() {
        return view('caja.comparar_maples');
    }    
}
