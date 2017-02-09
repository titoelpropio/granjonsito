<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\VentaCaja;
use App\DetalleVenta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DetalleVentaRequest;
use DB;
use Hash;

class DetalleVentaController extends Controller
{
  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
      $this->middleware('auth',['only'=>'admin']);
  }
  
  function index(){
    $caja_deposito=DB::select("SELECT caja_deposito.id_tipo_caja,tipo_caja.tipo,caja_deposito.cantidad_caja,(caja_deposito.cantidad_maple)as cant_maple,tipo_caja.cantidad_maple from caja_deposito,tipo_caja WHERE caja_deposito.id_tipo_caja=tipo_caja.id order by tipo_caja.id");
     $tipo_caja=DB::select("SELECT tipo_caja.id,tipo_caja.tipo,tipo_caja.color,tipo_caja.cantidad_maple,maple.cantidad,tipo_caja.precio FROM tipo_caja,maple WHERE tipo_caja.id_maple=maple.id");

     return view('detalleventa.index',compact('tipo_caja','caja_deposito'));
  }

	public function create(){
    return view('detalleventa.create');		
  }

  public function store(Request $request){
      DetalleVenta::create($request->all());
      return response()->json($request->all());
  }

  public function update(Request $request,$id){
    if ($request->ajax()) {
        $actua = DB::table('detalle_venta')->where('id', $id)->update(['id_venta_caja' => $request->id_venta_caja, 'id_tipo_caja' => $request->id_tipo_caja, 'cantidad_caja' => $request->cantidad_caja, 'subtotal_precio' => $request->subtotal_precio]);
        return response()->json($request->all());
    }
  }

  public function edit($id){
      $DetalleVenta=DetalleVenta::find($id);
      return view('DetalleVenta.edit',['DetalleVenta'=>$DetalleVenta]);
  }

    public function lista_detalle($tipe){
        $datos=DB::select("SELECT dv.id,dv.id_tipo_caja,dv.id_venta_caja,dv.cantidad_caja,dv.subtotal_precio,tc.tipo from detalle_venta dv,tipo_caja tc WHERE dv.id_tipo_caja=tc.id  AND dv.id_venta_caja=".$tipe);
        return response()->json($datos);
    }

    public function lista_venta($tipe){
        $datos=DB::select("SELECT vc.id,vc.fecha,vc.precio from venta_caja vc WHERE vc.id=".$tipe);
        return response()->json($datos);
    }

    public function cantidad_caja_deposito($tipe){
      $datos=DB::select("SELECT caja_deposito.cantidad_caja,caja_deposito.cantidad_maple FROM caja_deposito WHERE caja_deposito.id_tipo_caja=".$tipe);
      return response()->json($datos);
  }
}