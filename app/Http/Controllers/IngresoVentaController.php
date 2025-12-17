<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IngresoVenta;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class IngresoVentaController extends Controller
{
    public function index(Request $request)
    {
        $query = IngresoVenta::query()->where('archivado', false);

        // filtros opcionales por mes/año
        if ($request->filled('anio')) $query->where('anio', $request->anio);
        if ($request->filled('mes'))  $query->where('mes', $request->mes);

        $ventas = $query->orderByDesc('fecha_venta')->paginate(15);

        return view('ingresos_ventas.index', compact('ventas'));
    }

    public function create(Request $request)
    {
        $anio = (int) $request->input('anio', date('Y'));
        $mes = (int) $request->input('mes', date('m'));

        // Validar que el mes esté en rango válido
        if ($mes < 1 || $mes > 12) {
            $mes = (int) date('m');
        }

        $ventas = IngresoVenta::query()
            ->where('archivado', false)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->orderBy('fecha_venta')
            ->get();

        // Calcular totales por forma de pago y tipo de cliente
        $totales = [
            'DEBITO_NACIONAL' => $ventas->where('forma_pago', 'DEBITO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'CREDITO_NACIONAL' => $ventas->where('forma_pago', 'CREDITO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'EFECTIVO_NACIONAL' => $ventas->where('forma_pago', 'EFECTIVO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'DEBITO_EXTRANJERO' => $ventas->where('forma_pago', 'DEBITO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
            'CREDITO_EXTRANJERO' => $ventas->where('forma_pago', 'CREDITO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
            'EFECTIVO_EXTRANJERO' => $ventas->where('forma_pago', 'EFECTIVO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
        ];

        return view('ingresos_ventas.create', compact('ventas', 'anio', 'mes', 'totales'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'anio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'mes' => ['required', 'integer', 'min:1', 'max:12'],
            'dia' => ['required', 'integer', 'min:1', 'max:31'],
            'nombre_cliente' => ['required', 'string', 'max:250'],
            'tipo_cliente' => ['required', 'in:NACIONAL,EXTRANJERO'],
            'forma_pago' => ['required', 'in:DEBITO,CREDITO,EFECTIVO'],
            'importe' => ['required', 'numeric', 'min:0'],
        ]);

        // Construir la fecha completa desde año, mes y día
        $fecha = sprintf('%04d-%02d-%02d', $data['anio'], $data['mes'], $data['dia']);
        
        // Validar que la fecha sea válida (ej: no 31 de febrero)
        if (!checkdate($data['mes'], $data['dia'], $data['anio'])) {
            return back()->withErrors(['dia' => 'La fecha seleccionada no es válida.'])->withInput();
        }

        $data['fecha_venta'] = $fecha;
        $data['anio'] = (int) $data['anio'];
        $data['mes'] = (int) $data['mes'];
        $data['usuario_creacion'] = 'sys';
        $data['usuario_actualizacion'] = 'sys';

        IngresoVenta::create($data);

        return redirect()->route('ingresos-ventas.create', ['anio' => $data['anio'], 'mes' => $data['mes']])
            ->with('ok', 'Venta registrada.');
    }

    public function edit(IngresoVenta $ingresos_venta)
    {
        return view('ingresos_ventas.edit', ['venta' => $ingresos_venta]);
    }

    public function update(Request $request, IngresoVenta $ingresos_venta)
    {
        $data = $request->validate([
            'anio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'mes' => ['required', 'integer', 'min:1', 'max:12'],
            'dia' => ['required', 'integer', 'min:1', 'max:31'],
            'nombre_cliente' => ['required', 'string', 'max:250'],
            'tipo_cliente' => ['required', 'in:NACIONAL,EXTRANJERO'],
            'forma_pago' => ['required', 'in:DEBITO,CREDITO,EFECTIVO'],
            'importe' => ['required', 'numeric', 'min:0'],
        ]);

        // Construir la fecha completa desde año, mes y día
        $fecha = sprintf('%04d-%02d-%02d', $data['anio'], $data['mes'], $data['dia']);
        
        // Validar que la fecha sea válida (ej: no 31 de febrero)
        if (!checkdate($data['mes'], $data['dia'], $data['anio'])) {
            return back()->withErrors(['dia' => 'La fecha seleccionada no es válida.'])->withInput();
        }

        $data['fecha_venta'] = $fecha;
        $data['anio'] = (int) $data['anio'];
        $data['mes'] = (int) $data['mes'];
        $data['usuario_actualizacion'] = 'sys';

        $ingresos_venta->update($data);

        return redirect()->route('ingresos-ventas.create', [
            'anio' => $data['anio'],
            'mes' => $data['mes']
        ])->with('ok', 'Venta actualizada.');
    }

    public function destroy(Request $request, IngresoVenta $ingresos_venta)
    {
        // En vez de borrar, lo archivamos (más seguro)
        $ingresos_venta->update(['archivado' => true, 'usuario_actualizacion' => 'sys']);

        // Si viene desde create, redirigir con los mismos parámetros
        if ($request->has('anio') && $request->has('mes')) {
            return redirect()->route('ingresos-ventas.create', [
                'anio' => $request->anio,
                'mes' => $request->mes
            ])->with('ok', 'Venta archivada.');
        }

        return redirect()->route('ingresos-ventas.index')->with('ok', 'Venta archivada.');
    }

    public function reporteMensual(Request $request)
    {
        $anio = $request->input('anio', date('Y'));
        $mes  = $request->input('mes', date('m'));

        $ventas = IngresoVenta::query()
            ->where('archivado', false)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->orderBy('fecha_venta')
            ->get();

        $totalMes = $ventas->sum('importe');

        $porFormaPago = IngresoVenta::query()
            ->selectRaw('forma_pago, SUM(importe) as total')
            ->where('archivado', false)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->groupBy('forma_pago')
            ->orderBy('forma_pago')
            ->get();

        $porTipoCliente = IngresoVenta::query()
            ->selectRaw('tipo_cliente, SUM(importe) as total')
            ->where('archivado', false)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->groupBy('tipo_cliente')
            ->orderBy('tipo_cliente')
            ->get();

        return view('reportes.ventas_mensual', compact(
            'anio', 'mes', 'ventas', 'totalMes', 'porFormaPago', 'porTipoCliente'
        ));
    }

    public function exportarPdf(Request $request)
    {
        $anio = (int) $request->input('anio', date('Y'));
        $mes = (int) $request->input('mes', date('m'));

        // Validar que el mes esté en rango válido
        if ($mes < 1 || $mes > 12) {
            $mes = (int) date('m');
        }

        $ventas = IngresoVenta::query()
            ->where('archivado', false)
            ->where('anio', $anio)
            ->where('mes', $mes)
            ->orderBy('fecha_venta')
            ->get();

        // Calcular totales
        $totales = [
            'DEBITO_NACIONAL' => $ventas->where('forma_pago', 'DEBITO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'CREDITO_NACIONAL' => $ventas->where('forma_pago', 'CREDITO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'EFECTIVO_NACIONAL' => $ventas->where('forma_pago', 'EFECTIVO')->where('tipo_cliente', 'NACIONAL')->sum('importe'),
            'DEBITO_EXTRANJERO' => $ventas->where('forma_pago', 'DEBITO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
            'CREDITO_EXTRANJERO' => $ventas->where('forma_pago', 'CREDITO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
            'EFECTIVO_EXTRANJERO' => $ventas->where('forma_pago', 'EFECTIVO')->where('tipo_cliente', 'EXTRANJERO')->sum('importe'),
        ];

        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $pdf = PDF::loadView('ingresos_ventas.pdf', compact('ventas', 'anio', 'mes', 'totales', 'meses'));
        
        $nombreArchivo = 'ventas_' . $meses[$mes] . '_' . $anio . '.pdf';
        
        return $pdf->download($nombreArchivo);
    }

}

