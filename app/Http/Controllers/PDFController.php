<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Galpon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use PDF;
use DB;
use Hash;

class PDFController extends Controller{

  public function __construct() {
     $this->middleware('auth');
     $this->middleware('admin');
     $this->middleware('auth',['only'=>'admin']);
  }

  public function getPDF(){
    $galpon=Galpon::all();
    $pdf=PDF::loadView('pdf.galpon',['galpon'=>$galpon]);
    return $pdf->stream('archivo.pdf');
  }

  //REPORTE DE LAS PONEDORAS
  public function reportegalpon($id_edad, $fecha_inicio, $fecha_fin, $sw){
  if ($id_edad == 0) {
      if ($sw == 0) {
          $galpon=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase,(0)as sw FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND fases.nombre='PONEDORA' GROUP BY edad.id ORDER BY id_fase DESC,galpon.numero");
      } else {
          $galpon=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 and postura_huevo.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) AND fases.nombre='PONEDORA' GROUP BY edad.id ORDER BY id_fase DESC,galpon.numero");
      }
  }
  else{
      if ($sw == 0) {
          $galpon=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase,(1)as sw FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND edad.id=".$id_edad." GROUP BY edad.id,fases.nombre ORDER BY id_fase DESC,galpon.numero");
      } else {
          $galpon=DB::select("SELECT fases_galpon.fecha_inicio,galpon.numero AS nombre,SUM(postura_huevo.cantidad_total)as cantidad_total,round(AVG(postura_huevo.postura_p))as postura_p,SUM(fases_galpon.total_muerta)as muertas,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 and postura_huevo.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) AND edad.id=".$id_edad." GROUP BY edad.id,fases.nombre ORDER BY id_fase DESC,galpon.numero");
      }
  }
    $pdf=\PDF::loadView('pdf.galponreporte',compact('galpon'));
    return   $pdf->stream();
  }

  //REPORTE DE LAS FASES
  public function reportefases($id_edad){ 
      if ($id_edad == 0) {
          $fase=DB::select("SELECT fases.nombre,fases_galpon.fecha_inicio,galpon.numero,SUM(fases_galpon.total_muerta)as total_muerta,edad.id,MAX(fases.nombre)as fase,MAX(fases.id)as id_fase,(0)as sw FROM galpon,edad,fases_galpon,fases,postura_huevo WHERE galpon.id=edad.id_galpon and edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND fases_galpon.id=postura_huevo.id_fases_galpon AND edad.estado=1 AND fases.nombre!='PONEDORA' AND fases_galpon.fecha_fin IS NULL  GROUP BY edad.id ORDER BY id_fase");
      }else{
          $fase=DB::select("SELECT fases_galpon.fecha_inicio,galpon.id as id_galpon,galpon.numero,edad.id as id_edad,fases.nombre,fases_galpon.total_muerta,(1)as sw FROM galpon,edad,fases_galpon,fases WHERE galpon.id=edad.id_galpon AND edad.id=fases_galpon.id_edad AND fases_galpon.id_fase=fases.id AND edad.estado=1 and fases.nombre!='PONEDORA' AND edad.id=".$id_edad." ORDER BY fases.numero DESC");
      }
    $pdf=\PDF::loadView('pdf.fasesreporte',compact('fase'));
    return   $pdf->stream();
  }

  //REPORTE PDF VENTA DE CAJAS DADA DOS FECHAS
  public function ReporteVentaCaja($fecha_inicio,$fecha_fin){
  if($fecha_inicio=='' &&  $fecha_fin==''){
  return response()->json("Error no hay datos");
   } 
        $inicio=$fecha_inicio;
        $fin=$fecha_fin;
        $venta_caja2 = DB::select("SELECT tipo_caja.tipo,SUM(detalle_venta.cantidad_caja)as cantidad,SUM(detalle_venta.subtotal_precio)as total from venta_caja,detalle_venta,tipo_caja WHERE venta_caja.id=detalle_venta.id_venta_caja and tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND venta_caja.estado=1 GROUP BY tipo_caja.id
              UNION
              SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_caja.precio),0)AS total  from venta_caja WHERE estado=1 and fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
     $pdf=\PDF::loadView('pdf.venta_caja_reporte',compact('venta_caja2','inicio','fin'));
         return   $pdf->stream();
  }

  //REPORTE PDF VENTA DE CAJA POR DIA
  public function ReporteVentaCajaDiario($fecha){
  if($fecha==''){
  return response()->json("Error no hay datos");
   } 
        $fech=$fecha;
        $venta_caja = DB::select("SELECT Date_format(venta_caja.fecha,'%Y/%m/%d') as fecha,tipo_caja.tipo,SUM(detalle_venta.cantidad_caja) as cantidad,SUM(detalle_venta.subtotal_precio) as total from venta_caja,detalle_venta,tipo_caja WHERE venta_caja.id=detalle_venta.id_venta_caja and tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.fecha='".$fecha."' AND venta_caja.estado=1 GROUP BY tipo_caja.id
    UNION
    SELECT ('')as fecha,('total')as total,('')as cantidad,IFNULL(SUM(venta_caja.precio),0)AS total  from venta_caja WHERE estado=1 and fecha='".$fecha."'");
     $pdf=\PDF::loadView('pdf.venta_caja_diara',compact('venta_caja','fech'));
         return   $pdf->stream();
  }


  //REPORTE PDF VENTA DE HUEVOS DADA DOS FECHAS
  public function ReporteVentaHuevo($fecha_inicio,$fecha_fin){
  if($fecha_inicio=='' &&  $fecha_fin==''){
  return response()->json("Error no hay datos");
   } 
        $inicio=$fecha_inicio;
        $fin=$fecha_fin;
        $venta_huevo = DB::select("SELECT tipo_huevo.tipo,SUM(detalle_venta_huevo.cantidad_maple) as cantidad,IFNULL(SUM(detalle_venta_huevo.subtotal_precio),0)as total from venta_huevo,detalle_venta_huevo,tipo_huevo WHERE
  venta_huevo.id=detalle_venta_huevo.id_venta_huevo and tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND venta_huevo.estado=1 GROUP BY tipo_huevo.id
    UNION
      SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_huevo.precio),0)AS total  from venta_huevo WHERE estado=1 and fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");
     $pdf=\PDF::loadView('pdf.venta_huevo_reporte',compact('venta_huevo','inicio','fin'));
         return   $pdf->stream();
  }

//REPORTE VENTA DE HUEVOS DIARIO
  public function ReporteVentaHuevoDiario($fecha){
  if($fecha==''){
  return response()->json("Error no hay datos");
   } 
        $fech=$fecha;
        $venta_huevo = DB::select("SELECT tipo_huevo.tipo,SUM(detalle_venta_huevo.cantidad_maple) as cantidad,IFNULL(SUM(detalle_venta_huevo.subtotal_precio),0)as total from venta_huevo,detalle_venta_huevo,tipo_huevo WHERE
  venta_huevo.id=detalle_venta_huevo.id_venta_huevo and tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.fecha='".$fecha."' AND venta_huevo.estado=1 GROUP BY tipo_huevo.id
    UNION
      SELECT ('total')as total,('')as cantidad,IFNULL(SUM(venta_huevo.precio),0)AS total  from venta_huevo WHERE estado=1 and fecha='".$fecha."'");
     $pdf=\PDF::loadView('pdf.venta_huevo_diario',compact('venta_huevo','fech'));
         return   $pdf->stream();
  }

  //REPORTE COMPRA DE ALIMENTO
  public function ReporteCompraAlimento($fecha_inicio,$fecha_fin){
    $inicio=$fecha_inicio;
    $fin=$fecha_fin;
    $compra = DB::select("SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) GROUP BY alimento.tipo
      UNION
      SELECT ('saldo')AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY)");
    $pdf=\PDF::loadView('pdf.compra_alimento',compact('compra','inicio','fin'));
     return   $pdf->stream();
  }

  //REPORTE DE EGRESO E INGRESO
  public function ReporteEgresoIngreso($fecha_inicio,$fecha_fin){
  if($fecha_inicio=='' &&  $fecha_fin==''){
  return response()->json("Error no hay datos");
   } 
        $inicio=$fecha_inicio;
        $fin=$fecha_fin;
        $egreso = DB::select("SELECT (categoria.nombre)as detalle,IFNULL(SUM(egreso_varios.precio),0)as total from egreso_varios,categoria WHERE categoria.id=egreso_varios.id_categoria and egreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' GROUP BY egreso_varios.id_categoria
      UNION
  SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as TOTAL from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) GROUP BY alimento.tipo");

        $ingreso=DB::select("SELECT (categoria.nombre)as detalle,IFNULL(SUM(ingreso_varios.precio),0)as total from ingreso_varios,categoria WHERE categoria.id=ingreso_varios.id_categoria and ingreso_varios.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' GROUP BY ingreso_varios.id_categoria      
          UNION
        SELECT CONCAT('VENTA DE MAPLES')AS detalle,SUM(venta_huevo.precio)as TOTAL from venta_huevo,tipo_huevo,detalle_venta_huevo WHERE tipo_huevo.id=detalle_venta_huevo.id_tipo_huevo and venta_huevo.id=detalle_venta_huevo.id_venta_huevo AND venta_huevo.estado=1 AND venta_huevo.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'
        UNION
  SELECT CONCAT('VENTA DE CAJAS')AS detalle,SUM(venta_caja.precio)as TOTAL from venta_caja,tipo_caja,detalle_venta WHERE tipo_caja.id=detalle_venta.id_tipo_caja and venta_caja.id=detalle_venta.id_venta_caja AND venta_caja.estado=1 AND venta_caja.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."'");

     $pdf=\PDF::loadView('pdf.egreso_ingreso',compact('egreso','ingreso','inicio','fin'));
         return   $pdf->stream();
  }

  //REPORTE CAJAS
  public function Reporte_Caja($fecha_inicio,$fecha_fin){
    $inicio=$fecha_inicio;
    $fin=$fecha_fin;
    $compra = DB::select("SELECT CONCAT('COMPRA DE GRANO DE TIPO ',' ',alimento.tipo)AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) GROUP BY alimento.tipo
      UNION
      SELECT ('saldo')AS detalle,IFNULL(SUM(compra.precio_compra),0)as total from silo,compra,alimento WHERE compra.id_silo=silo.id and silo.id_alimento=alimento.id  and compra.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY)");
    $pdf=\PDF::loadView('pdf.compra_alimento',compact('compra','inicio','fin'));
     return   $pdf->stream();
  }
}
