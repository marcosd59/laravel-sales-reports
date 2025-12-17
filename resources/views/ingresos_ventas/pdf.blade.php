<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas - {{ $meses[$mes] }} {{ $anio }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #333;
        }
        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            color: #666;
        }
        .resumen {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .resumen h2 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .resumen-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .resumen-item {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            vertical-align: top;
        }
        .resumen-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .resumen-box h3 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        .resumen-box.nacional {
            background-color: #e3f2fd;
            border-color: #90caf9;
        }
        .resumen-box.extranjero {
            background-color: #e8f5e9;
            border-color: #a5d6a7;
        }
        .resumen-box.total {
            background-color: #f5f5f5;
            border-color: #bdbdbd;
        }
        .resumen-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 11px;
        }
        .resumen-line.total-line {
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
        }
        .tabla {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }
        .tabla thead {
            background-color: #333;
            color: white;
        }
        .tabla th {
            padding: 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #333;
        }
        .tabla td {
            padding: 6px 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }
        .tabla tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .tabla tbody tr:hover {
            background-color: #f0f0f0;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #e3f2fd !important;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ventas Mensual</h1>
        <p>{{ $meses[$mes] }} {{ $anio }}</p>
    </div>

    <!-- Resumen de Ingresos -->
    <div class="resumen">
        <h2>Resumen de Ingresos</h2>
        <div class="resumen-grid">
            <div class="resumen-item">
                <div class="resumen-box nacional">
                    <h3>NACIONAL</h3>
                    <div class="resumen-line">
                        <span>Tarjeta Débito:</span>
                        <span>${{ number_format($totales['DEBITO_NACIONAL'], 2) }}</span>
                    </div>
                    <div class="resumen-line">
                        <span>Tarjeta Crédito:</span>
                        <span>${{ number_format($totales['CREDITO_NACIONAL'], 2) }}</span>
                    </div>
                    <div class="resumen-line">
                        <span>Efectivo:</span>
                        <span>${{ number_format($totales['EFECTIVO_NACIONAL'], 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="resumen-item">
                <div class="resumen-box extranjero">
                    <h3>EXTRANJERO</h3>
                    <div class="resumen-line">
                        <span>Tarjeta Débito:</span>
                        <span>${{ number_format($totales['DEBITO_EXTRANJERO'], 2) }}</span>
                    </div>
                    <div class="resumen-line">
                        <span>Tarjeta Crédito:</span>
                        <span>${{ number_format($totales['CREDITO_EXTRANJERO'], 2) }}</span>
                    </div>
                    <div class="resumen-line">
                        <span>Efectivo:</span>
                        <span>${{ number_format($totales['EFECTIVO_EXTRANJERO'], 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="resumen-item">
                <div class="resumen-box total">
                    <h3>TOTAL GENERAL</h3>
                    <div class="resumen-line total-line">
                        <span>Total:</span>
                        <span>${{ number_format(array_sum($totales), 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de Ventas -->
    <h2 style="font-size: 16px; margin-bottom: 10px; margin-top: 20px;">Lista de Ventas</h2>
    <table class="tabla">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Forma de Pago</th>
                <th class="text-right">Importe</th>
            </tr>
        </thead>
        <tbody>
            @if($ventas->isEmpty())
                <tr>
                    <td colspan="5" class="text-center" style="padding: 20px; color: #666;">
                        No hay ventas registradas para este período
                    </td>
                </tr>
            @else
                @foreach($ventas as $v)
                    <tr>
                        <td>{{ $v->fecha_venta }}</td>
                        <td>{{ $v->nombre_cliente }}</td>
                        <td>{{ $v->tipo_cliente }}</td>
                        <td>{{ $v->forma_pago }}</td>
                        <td class="text-right">${{ number_format($v->importe, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" class="text-right" style="font-weight: bold;">TOTAL:</td>
                    <td class="text-right" style="font-weight: bold;">${{ number_format($ventas->sum('importe'), 2) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Generado el {{ date('d/m/Y H:i:s') }}</p>
        <p>Total de registros: {{ $ventas->count() }}</p>
    </div>
</body>
</html>

