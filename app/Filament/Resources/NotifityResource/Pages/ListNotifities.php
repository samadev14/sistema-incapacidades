<?php
/* Página ListEmployees: Muestra en pantalla una tabla con todas las notificaciones enviadas al correo corporativo de los empleados. */

namespace App\Filament\Resources\NotifityResource\Pages;

use App\Filament\Resources\NotifityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotifities extends ListRecords
{
    protected static string $resource = NotifityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
