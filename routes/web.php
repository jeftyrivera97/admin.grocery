<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\GraficaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PintadoController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\TrabajoController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\FolioFacturaController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->name('/home');
Route::get('/index', [HomeController::class, 'index'])->name('/index');

Route::get('transaccion/abonar /{id_factura}', [TransaccionController::class, 'crear'])->name('transaccion/abonar');
Route::post('transaccion/guardar', [TransaccionController::class, 'guardar'])->name('transaccion/guardar');

Route::get('abrirCaja', [CajaController::class, 'guardar'])->name('abrirCaja');
Route::get('cajas/historial', [CajaController::class, 'historial'])->name('cajas/historial');

Route::post('buscarProducto', [ProductoController::class, 'buscar'])->name('buscarProducto');

Route::get('pedidos/crear /{id_compra}', [PedidoController::class, 'crear'])->name('pedidos/crear');
Route::post('crearPedido', [PedidoController::class, 'guardar'])->name('crearPedido');
Route::post('eliminarProducto /{id_pedido}', [PedidoController::class, 'eliminar'])->name('eliminarProducto');

Route::get('calculadora', [HomeController::class, 'conversor'])->name('calculadora');

Route::get('facturaImprimir /{id_factura}', [FacturaController::class, 'imprimir'])->name('facturaImprimir');
Route::post('/facturas/productos', [FacturaController::class, 'data'])->name('/facturas/productos');
Route::get('facturas/creditos', [FacturaController::class, 'facturasCredito'])->name('facturas/creditos');
Route::get('facturas/actualizar /{id_factura}', [FacturaController::class, 'actualizar'])->name('facturas/actualizar');
Route::post('/facturas/productos', [FacturaController::class, 'data'])->name('/facturas/productos');


//Graficas Varias
Route::post('ventas', [GraficaController::class, 'ventas'])->name('ventas');
Route::post('compras', [GraficaController::class, 'compras'])->name('compras');
Route::post('planillas', [GraficaController::class, 'planillas'])->name('planilla');
Route::post('gastos', [GraficaController::class, 'gastos'])->name('gastos');
Route::post('proveedores', [GraficaController::class, 'proveedores'])->name('proveedores');
Route::post('categoriasG', [GraficaController::class, 'categoriasG'])->name('categoriasG');


Route::get('producto-desactivar /{id_producto}', [ProductoController::class, 'desactivar'])->name('producto-desactivar');
Route::post('import-excel', [ProductoController::class, 'import'])->name('import-excel');


Route::post('/facturas/grafica', [GraficaController::class, 'facturas'])->name('/facturas/grafica');
Route::post('balanceAnual', [GraficaController::class, 'balanceAnual'])->name('balanceAnual');
Route::post('ingresosAnual', [GraficaController::class, 'ingresosAnual'])->name('ingresosAnual');
Route::post('egresosAnual', [GraficaController::class, 'egresosAnual'])->name('egresosAnual');
Route::post('ventasSemanal', [GraficaController::class, 'ventasSemanal'])->name('ventasSemanal');
Route::post('gastosSemanal', [GraficaController::class, 'gastosSemanal'])->name('gastosSemanal');
Route::post('gastosAnual', [GraficaController::class, 'gastosAnual'])->name('gastosAnual');
Route::post('comprasCategorias', [GraficaController::class, 'comprasCategorias'])->name('comprasCategorias');
Route::post('comprasProveedores', [GraficaController::class, 'comprasProveedores'])->name('comprasProveedores');
Route::post('comprasSemanal', [GraficaController::class, 'comprasSemanal'])->name('comprasSemanal');
Route::post('planillaSemanal', [GraficaController::class, 'planillaSemanal'])->name('planillaSemanal');
Route::post('planillaAnual', [GraficaController::class, 'planillaAnual'])->name('planillaAnual');

Route::get('reportes/pdf/ventas', [ReporteController::class, 'ventaPdf'])->name('reportes/pdf/ventas');
Route::get('reportes/pdf/compras', [ReporteController::class, 'compraPdf'])->name('reportes/pdf/compras');
Route::get('reportes/pdf/gastos', [ReporteController::class, 'gastoPdf'])->name('reportes/pdf/gastos');
Route::get('reportes/pdf/productos', [ReporteController::class, 'productoPdf'])->name('reportes/pdf/productos');
Route::get('reportes/pdf/balances', [ReporteController::class, 'balancePdf'])->name('reportes/pdf/balances');
Route::get('reportes/excel/compras', [ReporteController::class, 'compraExcel'])->name('reportes/excel/compras');
Route::get('compraRango.xlsx', [ReporteController::class, 'exportCompraExcel'])->name('compraRangoExcel');
Route::get('reportes/excel/ventas', [ReporteController::class, 'ventaExcel'])->name('reportes/excel/ventas');
Route::get('ventaRango.xlsx', [ReporteController::class, 'exportVentaExcel'])->name('ventaRangoExcel');
Route::get('balanceRango.pdf', [ReporteController::class, 'exportBalanceRango'])->name('balanceRangoExport');
Route::get('balanceComparativo.pdf', [ReporteController::class, 'exportBalanceComparativo'])->name('balanceComparativoExport');
Route::get('balanceCaja.pdf', [ReporteController::class, 'exportBalanceCaja'])->name('balanceCajaExport');
Route::get('declaracionComprasExport.pdf', [ReporteController::class, 'exportCompraDeclaracion'])->name('declaracionComprasExport');
Route::get('reportes/excel/facturas', [ReporteController::class, 'facturaExcel'])->name('reportes/excel/facturas');
Route::get('facturaRango.xlsx', [ReporteController::class, 'exportFacturaExcel'])->name('facturaRangoExcel');
Route::get('facturaCredito.pdf', [ReporteController::class, 'exportFacturaCredito'])->name('facturaCredito');
Route::get('productoActual.pdf', [ReporteController::class, 'exportProductoActual'])->name('productoActualExport');
Route::get('productoRango.pdf', [ReporteController::class, 'exportProductoRango'])->name('productoRangoExport');
Route::get('ventadelDia.pdf', [ReporteController::class, 'exportVentaDia'])->name('ventaDiaExport');
Route::get('ventaRango.pdf', [ReporteController::class, 'exportVentaRango'])->name('ventaRangoExport');
Route::get('compradelDia.pdf', [ReporteController::class, 'exportCompraDia'])->name('compraDiaExport');
Route::get('compraRango.pdf', [ReporteController::class, 'exportCompraRango'])->name('compraRangoExport');
Route::get('compraCredito.pdf', [ReporteController::class, 'exportCompraCredito'])->name('compraCreditoExport');
Route::get('gastodelDia.pdf', [ReporteController::class, 'exportGastoDia'])->name('gastoDiaExport');
Route::get('gastoRango.pdf', [ReporteController::class, 'exportGastoRango'])->name('gastoRangoExport');



Route::resource('ingreso', IngresoController::class);
Route::resource('cliente', ClienteController::class);
Route::resource('compra', CompraController::class);
Route::resource('empleado', EmpleadoController::class);
Route::resource('gasto', GastoController::class);
Route::resource('proveedor', ProveedorController::class);
Route::resource('credito', CreditoController::class);
Route::resource('transaccion', TransaccionController::class);
Route::resource('empresa', EmpresaController::class);
Route::resource('producto', ProductoController::class);
Route::resource('venta', VentaController::class);
Route::resource('planilla', PlanillaController::class);
Route::resource('factura', FacturaController::class);
Route::resource('caja', CajaController::class);
Route::resource('folio', FolioFacturaController::class);
