<?php
/* Página CreateHealthcare: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Registrar EPS y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\HealthcareResource\Pages;

use App\Filament\Resources\HealthcareResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateHealthcare extends CreateRecord
{
    protected static string $resource = HealthcareResource::class;

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
                ->label('Registrar EPS')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('EPS Registrada')
            ->body('Se han guardado los datos exitosamente.')
            ->success()
            ->send();
    }
}
