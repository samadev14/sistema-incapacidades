<?php
/* Página CreatePosition: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Registrar Puesto de Trabajo y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\PositionResource\Pages;

use App\Filament\Resources\PositionResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePosition extends CreateRecord
{
    protected static string $resource = PositionResource::class;

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
                ->label('Registrar Puesto de Trabajo')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Puesto de Trabajo Registrado')
            ->body('Se han guardado los datos exitosamente.')
            ->success()
            ->send();
    }
}
