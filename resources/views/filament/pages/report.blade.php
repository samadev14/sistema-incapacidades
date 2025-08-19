{{-- Vista que contiene el widget de la gráfica de barras y el botón que permite descargar esa gráfica en formato PNG --}}
<x-filament::page>
    {{ $this->form }}

    {{-- Botón para descargar la imagen en formato PNG --}}
    <div class="mt-6">
        <button onclick="downloadChartAsImage()"
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Descargar Gráfica Como Imagen PNG
        </button>
    </div>

    {{-- Widget de la gráfica de barras --}}
    <div class="mt-6">
        @livewire(\App\Filament\Widgets\IncapacityChart::class)
    </div>

    {{-- Script que genera la imagen PNG de la gráfica de barras --}}
    <script>
        function downloadChartAsImage() {
            const canvas = document.querySelector('canvas');

            if (!canvas) {
                alert("No se encontró la gráfica.");
                return;
            }

            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'grafica_incapacidades.png';
            link.click();
        }
    </script>
</x-filament::page>
