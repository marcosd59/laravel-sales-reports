@php
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    // Extraer año, mes y día de la fecha de la venta
    $fechaVenta = \Carbon\Carbon::parse($venta->fecha_venta);
    $anioActual = $fechaVenta->year;
    $mesActual = $fechaVenta->month;
    $diaActual = $fechaVenta->day;
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

@if(session('ok'))
    <div class="max-w-4xl mx-auto mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
        {{ session('ok') }}
    </div>
@endif

@if($errors->any())
    <div class="max-w-4xl mx-auto mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Editar venta</h1>

    <!-- Selector de mes y año -->
    <div class="mb-6 grid grid-cols-3 gap-4 items-end">
        <div>
            <label class="block text-sm font-semibold mb-2">Año</label>
            <select id="selectAnio" 
                    class="w-full border rounded px-3 py-2">
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $anioActual == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Mes</label>
            <select id="selectMes" 
                    class="w-full border rounded px-3 py-2">
                @foreach($meses as $num => $nombre)
                    <option value="{{ $num }}" {{ $mesActual == $num ? 'selected' : '' }}>
                        {{ $nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <span id="mesAnioDisplay" class="block text-sm font-semibold text-gray-600">
                {{ $meses[$mesActual] }} {{ $anioActual }}
            </span>
        </div>
    </div>

    <!-- Formulario de edición -->
    <form method="POST" action="{{ route('ingresos-ventas.update', $venta->id) }}" class="grid grid-cols-2 gap-4">
        @csrf
        @method('PUT')

        <input type="hidden" name="anio" id="anio" value="{{ $anioActual }}">
        <input type="hidden" name="mes" id="mes" value="{{ $mesActual }}">

        <div>
            <label class="block text-sm font-semibold">Día</label>
            <select name="dia" id="dia" class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione el día</option>
                @php
                    $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);
                @endphp
                @for($d = 1; $d <= $diasEnMes; $d++)
                    <option value="{{ $d }}" {{ $diaActual == $d ? 'selected' : '' }}>{{ $d }}</option>
                @endfor
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold">Cliente</label>
            <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente', $venta->nombre_cliente) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-semibold">Tipo cliente</label>
            <select name="tipo_cliente"
                    class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione</option>
                <option value="NACIONAL" {{ old('tipo_cliente', $venta->tipo_cliente) == 'NACIONAL' ? 'selected' : '' }}>NACIONAL</option>
                <option value="EXTRANJERO" {{ old('tipo_cliente', $venta->tipo_cliente) == 'EXTRANJERO' ? 'selected' : '' }}>EXTRANJERO</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold">Forma de pago</label>
            <select name="forma_pago"
                    class="w-full border rounded px-3 py-2" required>
                <option value="">Seleccione</option>
                <option value="EFECTIVO" {{ old('forma_pago', $venta->forma_pago) == 'EFECTIVO' ? 'selected' : '' }}>EFECTIVO</option>
                <option value="DEBITO" {{ old('forma_pago', $venta->forma_pago) == 'DEBITO' ? 'selected' : '' }}>DEBITO</option>
                <option value="CREDITO" {{ old('forma_pago', $venta->forma_pago) == 'CREDITO' ? 'selected' : '' }}>CREDITO</option>
            </select>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-semibold">Importe</label>
            <input type="number" step="0.01" name="importe" value="{{ old('importe', $venta->importe) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="col-span-2 flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Actualizar venta
            </button>
            <a href="{{ route('ingresos-ventas.create', ['anio' => $anioActual, 'mes' => $mesActual]) }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Cancelar
            </a>
        </div>
    </form>

</div>

<script>
    const meses = {
        1: 'Enero', 2: 'Febrero', 3: 'Marzo', 4: 'Abril',
        5: 'Mayo', 6: 'Junio', 7: 'Julio', 8: 'Agosto',
        9: 'Septiembre', 10: 'Octubre', 11: 'Noviembre', 12: 'Diciembre'
    };
    
    function actualizarDias() {
        const anio = parseInt(document.getElementById('selectAnio').value);
        const mes = parseInt(document.getElementById('selectMes').value);
        const diaSelect = document.getElementById('dia');
        const diaActual = parseInt(diaSelect.value) || {{ $diaActual }};
        
        // Actualizar campos ocultos
        document.getElementById('anio').value = anio;
        document.getElementById('mes').value = mes;
        
        // Actualizar display
        document.getElementById('mesAnioDisplay').textContent = meses[mes] + ' ' + anio;
        
        // Calcular días en el mes
        const diasEnMes = new Date(anio, mes, 0).getDate();
        
        // Guardar el día seleccionado
        const diaSeleccionado = diaActual;
        
        // Limpiar opciones
        diaSelect.innerHTML = '<option value="">Seleccione el día</option>';
        
        // Agregar días
        for (let d = 1; d <= diasEnMes; d++) {
            const option = document.createElement('option');
            option.value = d;
            option.textContent = d;
            if (d == diaSeleccionado && d <= diasEnMes) {
                option.selected = true;
            }
            diaSelect.appendChild(option);
        }
        
        // Si el día seleccionado es mayor que los días del mes, seleccionar el último día
        if (diaSeleccionado > diasEnMes) {
            diaSelect.value = diasEnMes;
        }
    }
    
    // Event listeners para los selectores
    document.getElementById('selectAnio').addEventListener('change', actualizarDias);
    document.getElementById('selectMes').addEventListener('change', actualizarDias);
</script>

</body>
</html>

