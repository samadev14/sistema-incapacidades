<?php
/* Página ListHealthcares: Muestra en pantalla una tabla con todos los registros de los nombres de las EPS almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\HealthcareResource\Pages;

use App\Filament\Resources\HealthcareResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHealthcares extends ListRecords
{
    protected static string $resource = HealthcareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
