<?php
/* Página EditEmployee: Contiene las siguientes funciones:

- getHeaderActions: Dibuja en la interfaz del sistema los botones Ver y Eliminar. */

namespace App\Filament\Resources\NotifityResource\Pages;

use App\Filament\Resources\NotifityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotifity extends EditRecord
{
    protected static string $resource = NotifityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
