<?php
/* Página EditEmployee: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Actualizar Datos y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido actualizados y almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return null;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Actualizar Datos')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterSave()
    {
        Notification::make()
            ->title('Datos Actualizados')
            ->body('Se han actualizado los datos exitosamente.')
            ->success()
            ->send();
    }
}
