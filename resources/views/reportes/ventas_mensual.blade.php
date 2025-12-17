<h1>Reporte de ventas mensual</h1>

<form method="GET" action="{{ route('reporte.ventas.mensual') }}">
  <label>Año</label>
  <input type="number" name="anio" value="{{ $anio }}" min="2000" />

  <label>Mes</label>
  <input type="number" name="mes" value="{{ $mes }}" min="1" max="12" />

  <button type="submit">Ver reporte</button>
</form>

<hr>

<h2>Total del mes: ${{ number_format($totalMes, 2) }}</h2>

<h3>Por forma de pago</h3>
<ul>
  @foreach($porFormaPago as $row)
    <li>{{ $row->forma_pago }}: ${{ number_format($row->total, 2) }}</li>
  @endforeach
</ul>

<h3>Por tipo de cliente</h3>
<ul>
  @foreach($porTipoCliente as $row)
    <li>{{ $row->tipo_cliente }}: ${{ number_format($row->total, 2) }}</li>
  @endforeach
</ul>

<h3>Detalle de ventas</h3>
<table border="1" cellpadding="6">
  <thead>
    <tr>
      <th>Fecha</th>
      <th>Cliente</th>
      <th>Tipo</th>
      <th>Pago</th>
      <th>Importe</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ventas as $v)
      <tr>
        <td>{{ $v->fecha_venta }}</td>
        <td>{{ $v->nombre_cliente }}</td>
        <td>{{ $v->tipo_cliente }}</td>
        <td>{{ $v->forma_pago }}</td>
        <td>${{ number_format($v->importe, 2) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
