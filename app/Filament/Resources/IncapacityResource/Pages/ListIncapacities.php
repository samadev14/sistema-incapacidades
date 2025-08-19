<?php
/* Página ListIncapacities: Muestra en pantalla una tabla con todos los registros de las incapacidades de los empleados almacenadas en la base de datos del sistema. */

namespace App\Filament\Resources\IncapacityResource\Pages;

use App\Filament\Resources\IncapacityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncapacities extends ListRecords
{
    protected static string $resource = IncapacityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
