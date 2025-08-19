<?php
/* Página CreateNotifity: Contiene las siguientes funciones:

- getFormActions: Dibuja en la interfaz del sistema los botones Enviar Notificación y Cancerlar la acción.

- afterCreate: Dibuja en la interfaz del sistema una notificación indicando que la notificación ha sido enviada al correo corporativo del empleado. */

namespace App\Filament\Resources\NotifityResource\Pages;

use App\Filament\Resources\NotifityResource;
use App\Mail\NotifityMailable;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateNotifity extends CreateRecord
{
    protected static string $resource = NotifityResource::class;

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
                ->label('Enviar Notificación')
                ->color('success'),

            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('danger'),
        ];
    }

    protected function afterCreate(): void
    {
        Mail::to($this->record->employee->email_employee)
            ->send(new NotifityMailable($this->record));

        Notification::make()
            ->title('Notificación Enviada')
            ->body('La notificación ha sido enviada al correo corporativo del empleado.')
            ->success()
            ->send();
    }
}
