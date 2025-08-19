<?php
/* Este archivo contiene la clase IndicatorsStats, cuyo recurso se encarga de mostrar un widget de indicadores con el total de incapacidades activas, pendientes, finalizadas y registradas en el sistema. Toda esta información se obtiene del modelo Incapacity. */

namespace App\Filament\Widgets;

use App\Models\Incapacity;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IndicatorsStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Activas', Incapacity::where('status', 'Activa')->count())
                ->description('Total de Incapacidades Activas')
                ->descriptionIcon('heroicon-s-check-circle', IconPosition::Before)
                ->color('success'),

            Stat::make('Pendientes', Incapacity::where('status', 'Pendiente')->count())
                ->description('Total de Incapacidades Pendientes')
                ->descriptionIcon('heroicon-s-clock', IconPosition::Before)
                ->color('warning'),

            Stat::make('Finalizadas', Incapacity::where('status', 'Finalizada')->count())
                ->description('Total de Incapacidades Finalizadas')
                ->descriptionIcon('heroicon-s-x-circle', IconPosition::Before)
                ->color('danger'),

            Stat::make('Registradas', Incapacity::count())
                ->description('Total de Incapacidades Registradas')
                ->descriptionIcon('heroicon-s-clipboard', IconPosition::Before)
                ->color('primary'),
        ];
    }
}
