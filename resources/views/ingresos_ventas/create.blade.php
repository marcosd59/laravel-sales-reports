@php
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar venta') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-6 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('ok'))
                <div class="max-w-4xl mx-auto mb-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('ok') }}
                </div>
            @endif

            <!-- Resumen de totales -->
            <div class="max-w-4xl mx-auto mb-4 sm:mb-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden"
                 x-data="{ open: false }">
                <!-- Header del acordeón (solo en móvil) -->
                <div class="sm:hidden flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <button @click="open = !open" 
                            class="flex-1 flex items-center justify-between text-left hover:bg-gray-50 dark:hover:bg-gray-700 transition active:bg-gray-100 dark:active:bg-gray-600 -m-4 p-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            Resumen de Ingresos - {{ $meses[$mes] }} {{ $anio }}
                        </h3>
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform duration-200 flex-shrink-0 ml-2" 
                             :class="{ 'rotate-180': open }" 
                             fill="none" 
                             stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Título y botón exportar en desktop -->
                <div class="hidden sm:flex items-center justify-between p-4 sm:p-6 pb-0 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Resumen de Ingresos - {{ $meses[$mes] }} {{ $anio }}
                    </h3>
                    <a href="{{ route('ingresos-ventas.exportar.pdf', ['anio' => $anio, 'mes' => $mes]) }}" 
                       class="flex items-center gap-2 bg-red-600 dark:bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition font-semibold text-sm shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exportar PDF
                    </a>
                </div>

                <!-- Botón exportar en móvil -->
                <div class="sm:hidden p-4 border-b border-gray-200 dark:border-gray-700">
                    <a href="{{ route('ingresos-ventas.exportar.pdf', ['anio' => $anio, 'mes' => $mes]) }}" 
                       class="flex items-center justify-center gap-2 w-full bg-red-600 dark:bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition font-semibold text-sm shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exportar PDF
                    </a>
                </div>
                
                <!-- Contenido del acordeón -->
                <div class="p-4 sm:p-6 pt-0 sm:pt-0"
                     x-show="open || window.innerWidth >= 640"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        <!-- NACIONAL -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-3 sm:p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                            <p class="text-xs sm:text-sm font-semibold text-blue-700 dark:text-blue-300 mb-2">NACIONAL</p>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Tarjeta Débito:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['DEBITO_NACIONAL'], 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Tarjeta Crédito:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['CREDITO_NACIONAL'], 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Efectivo:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['EFECTIVO_NACIONAL'], 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- EXTRANJERO -->
                        <div class="bg-green-50 dark:bg-green-900/20 p-3 sm:p-4 rounded-lg border border-green-200 dark:border-green-800">
                            <p class="text-xs sm:text-sm font-semibold text-green-700 dark:text-green-300 mb-2">EXTRANJERO</p>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Tarjeta Débito:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['DEBITO_EXTRANJERO'], 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Tarjeta Crédito:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['CREDITO_EXTRANJERO'], 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">Efectivo:</span>
                                    <span class="text-sm sm:text-base font-bold text-gray-900 dark:text-gray-100">${{ number_format($totales['EFECTIVO_EXTRANJERO'], 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- TOTAL GENERAL -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 sm:p-4 rounded-lg border border-gray-200 dark:border-gray-600 sm:col-span-2 lg:col-span-1">
                            <p class="text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">TOTAL GENERAL</p>
                            <div class="space-y-2">
                                @php
                                    $totalGeneral = array_sum($totales);
                                @endphp
                                <div class="flex justify-between items-center">
                                    <span class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100">Total:</span>
                                    <span class="text-lg sm:text-xl font-bold text-blue-600 dark:text-blue-400">${{ number_format($totalGeneral, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-sm">
                <!-- Selector de mes y año -->
                <form method="GET" action="{{ route('ingresos-ventas.create') }}" class="mb-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Año</label>
                            <select name="anio" onchange="this.form.submit()" 
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @for($y = 2025; $y <= 2030; $y++)
                                    <option value="{{ $y }}" {{ $anio == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Mes</label>
                            <select name="mes" onchange="this.form.submit()" 
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach($meses as $num => $nombre)
                                    <option value="{{ $num }}" {{ $mes == $num ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center">
                            <span class="block text-base font-semibold text-gray-800 dark:text-gray-200">
                                {{ $meses[$mes] }} {{ $anio }}
                            </span>
                        </div>
                    </div>
                </form>

                <!-- Formulario de registro -->
                <form method="POST" action="{{ route('ingresos-ventas.store') }}" class="space-y-4">
                    @csrf

                    <input type="hidden" name="anio" value="{{ $anio }}">
                    <input type="hidden" name="mes" value="{{ $mes }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Día</label>
                            <select name="dia" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Seleccione el día</option>
                                @php
                                    $diasEnMes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
                                @endphp
                                @for($d = 1; $d <= $diasEnMes; $d++)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Cliente</label>
                            <input type="text" name="nombre_cliente"
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Nombre del cliente"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Tipo cliente</label>
                            <select name="tipo_cliente"
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Seleccione</option>
                                <option value="NACIONAL">NACIONAL</option>
                                <option value="EXTRANJERO">EXTRANJERO</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Forma de pago</label>
                            <select name="forma_pago"
                                    class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Seleccione</option>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="DEBITO">DEBITO</option>
                                <option value="CREDITO">CREDITO</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700 dark:text-gray-300">Importe</label>
                        <input type="number" step="0.01" name="importe"
                               class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="0.00"
                               required>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-blue-600 dark:bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition font-semibold text-base shadow-md hover:shadow-lg">
                            Guardar venta
                        </button>
                    </div>
                </form>
            </div>

            <div class="max-w-4xl mx-auto mt-4 sm:mt-6 bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-sm">
                <h2 class="text-lg sm:text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">
                    Ventas registradas - {{ $meses[$mes] }} {{ $anio }}
                </h2>

                @if($ventas->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-600 dark:text-gray-400">Aún no has registrado ventas para este mes.</p>
                    </div>
                @else
                    <!-- Vista móvil: Cards -->
                    <div class="block sm:hidden space-y-3">
                        @foreach($ventas as $v)
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-200 dark:border-gray-600">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $v->nombre_cliente }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $v->fecha_venta }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-lg text-blue-600 dark:text-blue-400">${{ number_format($v->importe, 2) }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 mb-3 text-sm">
                                    <div>
                                        <span class="text-gray-500 dark:text-gray-400">Tipo:</span>
                                        <span class="text-gray-900 dark:text-gray-100 ml-1">{{ $v->tipo_cliente }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500 dark:text-gray-400">Pago:</span>
                                        <span class="text-gray-900 dark:text-gray-100 ml-1">{{ $v->forma_pago }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                    <a href="{{ route('ingresos-ventas.edit', $v->id) }}" 
                                       class="flex-1 bg-blue-600 dark:bg-blue-500 text-white text-center px-4 py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition font-medium">
                                        Editar
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('ingresos-ventas.destroy', $v->id) }}" 
                                          class="flex-1"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="anio" value="{{ $anio }}">
                                        <input type="hidden" name="mes" value="{{ $mes }}">
                                        <button type="submit" 
                                                class="w-full bg-red-600 dark:bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition font-medium">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Vista desktop: Tabla -->
                    <div class="hidden sm:block overflow-x-auto -mx-4 sm:mx-0">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pago</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Importe</th>
                                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($ventas as $v)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $v->fecha_venta }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $v->nombre_cliente }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $v->tipo_cliente }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $v->forma_pago }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-right text-blue-600 dark:text-blue-400">${{ number_format($v->importe, 2) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-center relative">
                                                <div class="relative inline-block">
                                                    <button onclick="toggleMenu({{ $v->id }})" 
                                                            class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-3 py-2 rounded-lg text-sm transition font-medium">
                                                        Opciones
                                                    </button>
                                                    <div id="menu-{{ $v->id }}" 
                                                         class="hidden absolute right-0 mt-1 w-36 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg z-10 overflow-hidden">
                                                        <a href="{{ route('ingresos-ventas.edit', $v->id) }}" 
                                                           class="block px-4 py-2 text-sm text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-600 transition">
                                                            Editar
                                                        </a>
                                                        <form method="POST" 
                                                              action="{{ route('ingresos-ventas.destroy', $v->id) }}" 
                                                              class="inline"
                                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="anio" value="{{ $anio }}">
                                                            <input type="hidden" name="mes" value="{{ $mes }}">
                                                            <button type="submit" 
                                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-600 transition">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleMenu(ventaId) {
            // Cerrar todos los menús abiertos
            document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                if (menu.id !== 'menu-' + ventaId) {
                    menu.classList.add('hidden');
                }
            });
            
            // Toggle del menú actual
            const menu = document.getElementById('menu-' + ventaId);
            menu.classList.toggle('hidden');
        }

        // Cerrar menús al hacer clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('[id^="menu-"]').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
    </script>
</x-app-layout>
