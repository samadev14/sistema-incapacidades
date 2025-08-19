<?php
/* Página CreateUser: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Crear Usuario y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Crear Usuario')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Usuario Creado')
            ->body('Se han guardado los datos exitosamente.')
            ->success()
            ->send();
    }
}
