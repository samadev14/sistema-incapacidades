<?php
/* Página CreateEmployee: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Registrar Empleado y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que los registros han sido almacenados en la base de datos del sistema. */

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

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
                ->label('Registrar Empleado')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate()
    {
        Notification::make()
            ->title('Empleado Registrado')
            ->body('Se han guardado los datos exitosamente.')
            ->success()
            ->send();
    }
}
