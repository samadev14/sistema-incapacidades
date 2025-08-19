<?php
/* Este archivo contiene la clase IncapacityChart, cuyo recurso se encarga de mostrar un gráfico de barras con los registros de las incapacidades laborales de los empleados por mes. La información se obtiene del modelo Incapacity, seleccionando las fechas de inicio y fin para filtrar los registros y se pinta en la vista utilizando el componente ChartWidget. */

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Incapacity;
use Carbon\Carbon;

class IncapacityChart extends ChartWidget
{
    public ?string $startDate = null;
    public ?string $endDate = null;

    protected function getData(): array
    {
        $start = $this->startDate ? Carbon::parse($this->startDate) : now()->subMonths(6);
        $end = $this->endDate ? Carbon::parse($this->endDate) : now();

        $data = Incapacity::whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy(fn($item) => $item->created_at->translatedFormat('F-Y'))
            ->map(fn($group) => $group->count());

        return [
            'datasets' => [
                [
                    'label' => 'N° Registros',
                    'data' => array_values($data->toArray()),
                ],
            ],
            'labels' => array_keys($data->toArray()),
        ];
    }
    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Resumen Mensual de Incapacidades Registradas',
                    'align' => 'center',
                    'font' => [
                        'size' => 16,
                        'weight' => 'bold',
                    ],
                    'padding' => [
                        'top' => 10,
                        'bottom' => 30,
                    ],
                ],
            ]
        ];
    }
}
