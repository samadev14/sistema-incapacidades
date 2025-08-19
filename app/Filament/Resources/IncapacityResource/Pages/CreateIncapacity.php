<?php
/* Página CreateIncapacity: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Registrar Incapacidad y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\IncapacityResource\Pages;

use App\Filament\Resources\IncapacityResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateIncapacity extends CreateRecord
{
    protected static string $resource = IncapacityResource::class;

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
                ->label('Registrar Incapacidad')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Incapacidad Registrada')
            ->body('Se han guardado los datos exitosamente.')
            ->success()
            ->send();
    }
}
