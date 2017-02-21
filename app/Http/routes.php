<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//USUARIO
Route::resource('usuario','UsuarioController');

//LISTA ALIMENTO
Route::resource('lista_alimento','ListaAlimentoController');

//TEMPERATURA
Route::resource('temperatura','TemperaturaController');
//LISTA EDAD DE VACUNA
Route::get('lista_id_edad','GalponController@lista_id_edad');
Route::get('lista_edad_cria','CriaRecriaController@lista_edad_cria');

//REPORTES
Route::get('/getPDF','PDFController@getPDF');
Route::get('GerenerarReporte/{id_edad}/{fechainicio}/{fechafin}/{sw}','PDFController@reportegalpon');
Route::get('GerenerarReporteFase/{id_edad}','PDFController@reportefases');

//REPORTES VENTAS DE CAJAS
Route::get('Reporte_Venta_Caja/{fecha_inicio}/{fecha_fin}','PDFController@ReporteVentaCaja');
Route::get('Reporte_Venta_Caja_Diario/{fecha}','PDFController@ReporteVentaCajaDiario');

//REPORTES VENTAS DE HUEVOS
Route::get('Reporte_Venta_Huevo/{fecha_inicio}/{fecha_fin}','PDFController@ReporteVentaHuevo');
Route::get('Reporte_Venta_Huevo_Diario/{fecha}','PDFController@ReporteVentaHuevoDiario');

//REPORTE COMPRA DE ALIMENTO
Route::get('Reporte_Compra_Alimento/{fecha_inicio}/{fecha_fin}','PDFController@ReporteCompraAlimento');

//REPORTES EGRESO E INGRESO
Route::get('Reporte_Egreso_Ingreso/{fecha_inicio}/{fecha_fin}','PDFController@ReporteEgresoIngreso');

//REPORTE LAS CAJAS Q SE ARMARON DADA DOS FECHAS
Route::get('Reporte_Caja/{fecha_inicio}/{fecha_fin}','PDFController@Reporte_Caja');

//Vacunas
Route::get('listavacuna','VacunaController@listavacuna');//lista de vacuna para el select en el modal del formulario vacunagalpon
Route::get('vacunagalpon','VacunaController@vacunagalpon');
Route::get('galponavacunar','VacunaController@galponavacunar');//lista de galpon a vacunar
Route::get('vacunaestado','VacunaController@cambiarestado');
Route::resource('vacuna','VacunaController');
Route::get('agregar_listavacuna/{id_edad}','VacunaController@agregar_listavacuna');//lista de vacuna para el select en el modal del formulario vacunagalpon
Route::get('lista_vacuna/{id_edad}','VacunaController@lista_vacuna');//lista de vacuna para el select en el modal del formulario vacunagalpon


//CONTROL VACUNAS
Route::resource('control_vacuna','ControlVacunaController');
Route::get('control_vacuna_2','ControlVacunaController@store_2');
Route::get('lista_control_vacuna','ControlVacunaController@lista_control_vacuna');
Route::get('ver_control_vacuna/{id_edad}','ControlVacunaController@ver_control_vacuna');
Route::get('select_control_vacuna_ponedora','ControlVacunaController@select_control_vacuna_ponedora');
Route::get('select_control_vacuna_fase','ControlVacunaController@select_control_vacuna_fase');
Route::get('verificar_consumo_vacuna/{id_control_vac}','GalponController@verificar_consumo_vacuna');

//CONSUMO VACUNAS
Route::resource("consumo_vacuna","ConsumoVacunaController");
Route::get("ver_consumo_vacuna","ConsumoVacunaController@index");
Route::get("lista_consumo_vacuna_emergente/{id_edad}","ConsumoVacunaController@lista_consumo_vacuna_emergente");


//CATEGORIA
Route::resource('categoria','CategoriaController');

//EGRESO
Route::resource('egreso','EgresoController');
Route::get('lista_egreso','EgresoController@lista_egreso'); //AUMENTE ESTA RUTA
Route::get('egreso_lista/{fecha_inicio}/{fecha_fin}','EgresoController@egreso_lista');
Route::get('actualizar_egreso/{id}','EgresoController@actualizar_egreso'); //AUMENTE ESTA RUTA
Route::get('select_egreso/{id}','EgresoController@select_egreso'); //AUMENTE ESTA RUTA

//INGRESO
Route::resource('ingreso','IngresoController');
Route::get('lista_ingreso','IngresoController@lista_ingreso'); //AUMENTE ESTA RUTA
Route::get('ingreso_lista/{fecha_inicio}/{fecha_fin}','IngresoController@ingreso_lista');
Route::get('actualizar_ingreso/{id}','IngresoController@actualizar_ingreso'); //AUMENTE ESTA RUTA
Route::get('select_ingreso/{id}','IngresoController@select_ingreso'); //AUMENTE ESTA RUTA


//compra
Route::resource('compra','CompraController');
Route::resource('reporte_compra','CompraController@reporte_compra');
Route::get('lista_reporte_compra/{fecha_inicio}/{fecha_fin}','CompraController@lista_reporte_compra');
Route::get('obtener_compra','CompraController@obtener_compra'); //AUMENTE ESTA RUTA
Route::get('lista_compra','CompraController@lista_compra'); //AUMENTE ESTA RUTA
Route::get('anular_compra/{fecha_inicio}/{fecha_fin}','CompraController@anular_compra'); //AUMENTE ESTA RUTA


//temperatura
Route::get('mostrar_tem','GalponController@mostrar_tem');
//traspaso
Route::resource('traspaso','TraspasoController');

//CAJA
Route::resource('caja','CajaController');
Route::resource('lista_caja','CajaController@lista_caja');//LISTA DE LAS CAJAS
Route::resource('comparar_cajas','CajaController@comparar_cajas');
Route::get('lista_reporte_caja/{fecha_inicio}/{fecha_fin}','CajaController@lista_reporte_caja');
Route::get('lista_reporte_caja_total/{fecha_inicio}/{fecha_fin}','CajaController@lista_reporte_caja_total');

Route::resource('lista_maple','CajaController@lista_maple');// LISTA DE LOS MAPLES 
Route::resource('comparar_maples','CajaController@comparar_maples');
Route::get('lista_reporte_maple/{fecha_inicio}/{fecha_fin}','CajaController@lista_reporte_maple');
Route::get('lista_reporte_maple_total/{fecha_inicio}/{fecha_fin}','CajaController@lista_reporte_maple_total');

//SOBRANTE
Route::resource('sobrante','SobranteController');

//RANGOS EDAD Y TEMPERATURA
/*Route::resource('rango','RangoController');
Route::resource('rango_edad','RangoController@store_edad');
Route::resource('rango_temperatura','RangoController@store_temperatura');
Route::resource('rango_edades','RangoController@rango_edades');
Route::resource('eliminar_edad','RangoController@destroy_edad');
Route::resource('eliminar_temperatura','RangoController@destroy_temperatura');*/
Route::resource('rango','RangoController');
Route::resource('rango_edad','RangoController@store_edad');
Route::resource('rango_temperatura','RangoController@store_temperatura');
Route::resource('rango_edades','RangoController@rango_edades');
Route::resource('eliminar_edad','RangoController@destroy_edad');
Route::resource('eliminar_temperatura','RangoController@destroy_temperatura');
Route::get('cargar_tabla_redad','RangoController@cargar_tabla_redad');
Route::get('cargar_tabla_rtemperatura','RangoController@cargar_tabla_rtemperatura');
Route::get('cargarDatosEdad/{id}','RangoController@cargarDatosEdad');
Route::get('cargarDatosTemp/{id}','RangoController@cargarDatosTemp');
Route::get('actualizarEdad','RangoController@actualizarEdad');
Route::get('actualizarTemperatura','RangoController@actualizarTemperatura');



//TIPO MAPLE
Route::resource('maple','MapleController');

//tipo caja
Route::resource('tipocaja','TipoCajaController');
Route::get('tipocaja_estado','TipoCajaController@cambiar_estado_tipo_caja');
Route::resource('reportecajadiario','CajaController@reportediario');
Route::resource('reportecaja','CajaController@reporte');
Route::get('listareportecajadiario/{fecha_inicio}','CajaController@listareportecajadiario');
Route::get('listareportecaja/{fecha_inicio}/{fecha_fin}','CajaController@listareportecaja');
Route::get('listareportecajatotal/{fecha_inicio}/{fecha_fin}','CajaController@listareportecajatotal');


//HUEVO DEPOSITO
Route::resource('huevodeposito','HuevoDepositoController');
Route::get('huevo_total_deposito','HuevoController@obtener_huevo_deposito');

//HUEVO
Route::resource('huevo','HuevoController');
Route::get('obtener_huevos/{tipe}','HuevoController@obtener_huevo');





//tipo huevo
Route::resource('tipohuevo','TipoHuevoController');
Route::get('tipohuevo_estado','TipoHuevoController@cambiar_estado_tipo_huevo');
Route::get('crear_tipo_huevo','TipoHuevoController@store');
Route::resource('reportehuevo','HuevoController@reporte');
Route::resource('reportehuevodiario','HuevoController@reportediario');
Route::get('listareportehuevodiario/{fecha_inicio}','HuevoController@listareportehuevodiario');
Route::get('listareportehuevo/{fecha_inicio}/{fecha_fin}','HuevoController@listareportehuevo');
Route::get('listareportehuevototal/{fecha_inicio}/{fecha_fin}','HuevoController@listareportehuevototal');


////Vacunas galpon
Route::resource('vacuna-galpon','VacunaGalponController');
Route::get('lista-vacuna-galpon','VacunaGalponController@lista_vacuna_galpon');

//FRONT CONTROLLER
Route::get('admin','FrontController@admin');

//GALPONES
Route::resource('listagalpon','GalponController@listagalpon');
Route::resource('galpon','GalponController');
Route::get('tipogalpon/{tipe}','GalponController@getgalpon');
Route::get('galponi','GalponController@update_galpon');
Route::get('lista_galpones_select','GalponController@lista_galpones');
Route::get('detalle_galpones/{id_edad}/{fecha_inicio}/{fecha_fin}/{sw}','GalponController@detalle_galpon');
Route::get('lista_fases_select','GalponController@lista_fases');
Route::get('detalle_fases/{id_edad}','GalponController@detalle_fases');
Route::get('actualizar_control_alimento','GalponController@actualizar_control_alimento');


Route::get('listareporte/{fecha_inicio}/{fecha_fin}','GalponController@listareporte');
Route::get('listareporte_aux/{fecha_inicio}/{fecha_fin}/{id_edad}','GalponController@listareporte_aux');

Route::resource('reporteponedoras','GalponController@reporte');
Route::resource('reporteponedoras_fases','GalponController@reporte_fase');
Route::resource('reporte_comparacion','GalponController@reporte_comparacion');

Route::get('vistagalpon','GalponController@vistagalpon');
Route::get('crear_galpon','GalponController@store');






Route::get('obtenerdadafecha','GalponController@obtenerdadafecha');
Route::get('obtenerdadafecha_cria','GalponController@obtenerdadafecha_cria');

//alimento cria recria
Route::get('capturasilocria','AlimentoCriaRecriaController@getsilocria');
Route::get('obtenercriasmuertasdadafecha','CriaRecriaController@obtenermuertas');

Route::get('capturapostura/{tipe}','PosturaHuevoController@getpostura');
Route::get('capturasilo','PosturaHuevoController@getsilo');


Route::resource('criarecria','CriaRecriaController');
Route::get('actualizar_control_alimento_cria','CriaRecriaController@actualizar_control_alimento_cria');


//login
Route::resource('/','LoginController');
Route::resource('login','LoginController@store');
Route::resource('logout','LoginController@logout');

//edad
Route::resource('edad','EdadController');
Route::resource('obtener_id_edad','EdadController@obtener_id_edad');

Route::get('crear_edad','EdadController@store_traspaso');
Route::get('edad1a/{tipe}','EdadController@updateedad');
Route::get('edadl', 'EdadController@getgalpon');
Route::get('edadl2/{tipe}', 'EdadController@getgalpon_actual');
Route::get('getgalpon_traspaso/{tipe1}/{tipe2}', 'EdadController@getgalpon_traspaso');

Route::get('listaedad', 'EdadController@listaedad');
Route::get('obtener_datos/{tipe}', 'EdadController@obtener_datos');

//FASES GALPON
Route::resource('fases_galpon','FasesGalponController');
Route::get('aumento_gallina/{tipe}','FasesGalponController@aumento_gallina');
Route::get('fases_galpon_update/{id_fg}','FasesGalponController@update2');
Route::get('dar_de_baja/{id_fg}','FasesGalponController@dar_de_baja');
Route::get('actualizar_fases/{id_fg}','GalponController@update3');
Route::get('obtener_fase/{tipe}', 'FasesGalponController@obtener_fases');

//alimento
Route::resource('alimento','AlimentoController');
Route::get('alimento_estado','AlimentoController@update_estado_alimento');

//CONSUMO ALIMENTO
Route::resource('consumo', 'ConsumoController');
Route::get('consumo_alimento', 'ConsumoController@consumo_alimento');
Route::get('lista_conusmo_alimento/{fecha_inicio}/{fecha_fin}', 'ConsumoController@lista_conusmo_alimento');
Route::GET('consumo_edit/{id}', 'ConsumoController@edit');
Route::GET('editar_consumo', 'ConsumoController@editar_consumo');
Route::GET('eliminar_consumo/{id_consumo}', 'ConsumoController@destroy');



//FASES 
Route::resource('fases','FasesController');

//trabajador
Route::resource('trabajador','TrabajadorController');

//SILO
Route::resource('silo','SilosController');
Route::get('silo_estado','SilosController@update_estado');

Route::resource('alimentop','PosturaHuevoController');
Route::resource('alimentocria','AlimentoCriaRecriaController');

//capturargalpon para traspaso
Route::get('capturagalponcria','TraspasoController@getgalponcria');
Route::get('capturagalponponedora','TraspasoController@getgalponponedora');

//prueba
Route::get('tipogalponcria/{tipe}','TraspasoController@chagegalponcria');

//REPORTE BALACE GENERAL
Route::resource('reportebalance','BalanceController@reporte');
Route::get('lista_balance_egreso/{fecha_inicio}/{fecha_fin}','BalanceController@lista_balance_egreso');
Route::get('lista_balance_ingreso/{fecha_inicio}/{fecha_fin}','BalanceController@lista_balance_ingreso');


//CANTIDAD_MAPLE
Route::resource('cantidadmaple','CantidadMapleController');
Route::get('dato_caja_acumulado/{tipe}','CantidadMapleController@obtener_datos_acumulado');
Route::get('dato_caja_diario/{tipe}','CantidadMapleController@obtener_datos_diario');
Route::get('dato_huevo_acumulado/{tipe}','CantidadMapleController@obtener_datos_huevo_acumulado');
Route::get('dato_huevo_diario/{tipe}','CantidadMapleController@obtener_datos_huevo_diario');

//CAJA DEPOSITO
Route::resource('cajadeposito','CajaDepositoController');
Route::resource('cajadeposito_admin','CajaDepositoController@index_admin');
Route::get('volver_cajas_detalle/{tipe}','CajaDepositoController@volver_cajas');
Route::get('caja_deposito','CajaDepositoController@caja_deposito');
Route::get('huevo_deposito','CajaDepositoController@huevo_deposito');


//VENTA CAJA
Route::resource('ventacaja','VentaCajaController');
Route::get('venta_caja_lista/{fecha_inicio}/{fecha_fin}','VentaCajaController@venta_caja_lista');
Route::resource('detalle_venta','DetalleVentaController');
Route::get('venta_baja','VentaCajaController@update_venta');
Route::get('dato_caja_acumulado_venta/{tipe}','VentaCajaController@obtener_datos_acumulado_venta');
Route::resource('detalleventa','DetalleVentaController');
Route::get('obtener_id_venta_ultimo','VentaCajaController@obtener_id_venta');
Route::get('lista_detalle_venta/{tipe}','DetalleVentaController@lista_detalle');
Route::get('lista_venta/{tipe}','DetalleVentaController@lista_venta');
Route::get('cantidad_caja/{tipe}','DetalleVentaController@cantidad_caja_deposito');

//HUEVO ACUMULADOS
Route::resource('huevoacumulado','HuevoAcumuladoController');
Route::get('obtener_huevo_acumulado','CantidadMapleController@obtener_huevo_acumulado');

//OBTENER CONTRASEÑA
Route::get('obtener_password','CajaDepositoController@obtener_contra');

//VENTA HUEVO
Route::resource('ventahuevo','VentaHuevoController');
Route::get('venta_huevo_lista/{fecha_inicio}/{fecha_fin}','VentaHuevoController@venta_huevo_lista');
Route::resource('detalleventahuevo','DetalleVentaHuevoController');
Route::get('dato_caja_acumulado_venta/{tipe}','VentaCajaController@obtener_datos_acumulado_venta');
Route::get('obtener_id_venta_huevo_ultimo','VentaHuevoController@obtener_id_venta_huevo');
Route::get('lista_detalle_venta_huevo/{tipe}','DetalleVentaHuevoController@lista_detalle_venta_huevo');
Route::get('lista_venta_huevo/{tipe}','DetalleVentaHuevoController@lista_venta_huevos');

//CONTROL ALIMENTO
Route::resource('controlalimento','ControlAlimentoController');
Route::get('lista_de_silos/{tipe}','GalponController@lista_de_silos');
Route::get('lista_de_silos_aux/{tipe}','GalponController@lista_de_silos_aux');


//VACUNA EMERGENTES
Route::resource('vacuna_emergente','VacunaEmegerteController');
Route::get('vacunae_emergente_estado','VacunaEmegerteController@cambiarestado');

//CONSUMO VACUNA EMERGENTES
Route::resource('consumo_vacuna_emergente','ConsumoVacunaEmergenteController');
