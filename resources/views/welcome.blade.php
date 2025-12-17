<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sistema de Ventas Mensuales') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                @layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-blue-600:oklch(.546 .245 262.881);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-black:#000;--color-white:#fff;--spacing:.25rem;--text-sm:.875rem;--text-base:1rem;--text-lg:1.125rem;--text-xl:1.25rem;--text-2xl:1.5rem;--text-3xl:1.875rem;--text-4xl:2.25rem;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans)}@layer base{*,:after,:before{box-sizing:border-box;border:0 solid;margin:0;padding:0}html{line-height:1.5;font-family:var(--default-font-family)}body{line-height:inherit}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}button,input,select,textarea{font:inherit;color:inherit}}@layer utilities{.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.gap-2{gap:.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.gap-8{gap:2rem}.p-4{padding:1rem}.p-6{padding:1.5rem}.p-8{padding:2rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.px-8{padding-left:2rem;padding-right:2rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.py-3{padding-top:.75rem;padding-bottom:.75rem}.py-4{padding-top:1rem;padding-bottom:1rem}.mb-2{margin-bottom:.5rem}.mb-4{margin-bottom:1rem}.mb-6{margin-bottom:1.5rem}.mb-8{margin-bottom:2rem}.mt-8{margin-top:2rem}.mt-12{margin-top:3rem}.text-center{text-align:center}.text-sm{font-size:var(--text-sm)}.text-base{font-size:var(--text-base)}.text-lg{font-size:var(--text-lg)}.text-xl{font-size:var(--text-xl)}.text-2xl{font-size:var(--text-2xl)}.text-3xl{font-size:var(--text-3xl)}.text-4xl{font-size:var(--text-4xl)}.font-medium{font-weight:var(--font-weight-medium)}.font-semibold{font-weight:var(--font-weight-semibold)}.font-bold{font-weight:var(--font-weight-bold)}.rounded-lg{border-radius:var(--radius-lg)}.rounded-xl{border-radius:var(--radius-xl)}.bg-white{background-color:var(--color-white)}.bg-gray-50{background-color:var(--color-gray-50)}.bg-gray-100{background-color:var(--color-gray-100)}.bg-blue-600{background-color:var(--color-blue-600)}.bg-green-500{background-color:var(--color-green-500)}.text-white{color:var(--color-white)}.text-gray-600{color:var(--color-gray-600)}.text-gray-700{color:var(--color-gray-700)}.text-gray-900{color:var(--color-gray-900)}.shadow-sm{box-shadow:var(--shadow-sm)}.shadow-md{box-shadow:var(--shadow-md)}.shadow-lg{box-shadow:var(--shadow-lg)}.transition{transition-property:all;transition-timing-function:var(--default-transition-timing-function);transition-duration:var(--default-transition-duration)}.hover\:bg-blue-700:hover{background-color:var(--color-blue-600)}.hover\:shadow-lg:hover{box-shadow:var(--shadow-lg)}@media (min-width:768px){.md\:text-5xl{font-size:3rem}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.md\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.md\:px-12{padding-left:3rem;padding-right:3rem}.md\:py-16{padding-top:4rem;padding-bottom:4rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-900{background-color:var(--color-gray-900)}.dark\:bg-gray-800{background-color:var(--color-gray-800)}.dark\:text-white{color:var(--color-white)}.dark\:text-gray-300{color:var(--color-gray-300)}.dark\:text-gray-400{color:var(--color-gray-400)}}</style>
        @endif
        <script>
            // Inicializar dark mode
            (function() {
                const darkMode = localStorage.getItem('darkMode') === 'true' || 
                                (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
                if (darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-blue-600 dark:text-blue-400">Ventas Mensuales</h1>
                    </div>
                    <div class="flex items-center gap-4">
                    @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                            Dashboard
                        </a>
                    @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm hover:shadow-md">
                                    Registrarse
                            </a>
                        @endif
                    @endauth
                    </div>
                </div>
            </div>
                </nav>

        <!-- Hero Section -->
        <section class="py-12 md:py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white">
                        Gestiona tus Ventas Mensuales
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                        Sistema completo para registrar, organizar y analizar tus ingresos mensuales. 
                        Control total sobre tus ventas con reportes detallados y exportación a PDF.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ url('/ingresos-ventas/create') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transition">
                                Registrar Venta
                            </a>
                            <a href="{{ url('/ingresos-ventas') }}" class="px-8 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition border border-gray-200 dark:border-gray-700">
                                Ver Ventas
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transition">
                                Comenzar Ahora
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition border border-gray-200 dark:border-gray-700">
                                Iniciar Sesión
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-12 md:py-16 px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto">
                <h3 class="text-3xl font-bold text-center mb-12 text-gray-900 dark:text-white">
                    Características Principales
                </h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Registro de Ventas</h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            Registra fácilmente todas tus ventas con información detallada: cliente, tipo, forma de pago e importe.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Resumen de Ingresos</h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            Visualiza resúmenes completos por tipo de cliente (Nacional/Extranjero) y forma de pago.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-6 bg-gray-50 dark:bg-gray-900 rounded-xl shadow-sm hover:shadow-md transition">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Exportación a PDF</h4>
                        <p class="text-gray-600 dark:text-gray-400">
                            Genera reportes profesionales en PDF con toda la información de ventas y resúmenes mensuales.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        @guest
        <section class="py-12 md:py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <div class="bg-blue-600 dark:bg-blue-700 rounded-xl p-8 md:p-12 shadow-lg">
                    <h3 class="text-3xl font-bold text-white mb-4">
                        ¿Listo para comenzar?
                    </h3>
                    <p class="text-xl text-blue-100 mb-8">
                        Únete ahora y comienza a gestionar tus ventas de manera profesional y eficiente.
                    </p>
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:shadow-lg transition">
                        Crear Cuenta Gratis
                    </a>
                </div>
        </div>
        </section>
        @endguest

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto text-center">
                <p class="text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} Sistema de Ventas Mensuales. Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </body>
</html>
