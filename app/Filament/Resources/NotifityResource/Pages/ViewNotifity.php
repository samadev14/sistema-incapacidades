<?php
/* Página ViewNotifity: Muestra en pantalla la información detallada de la notificación enviada al correo corporativo del empleado. */

namespace App\Filament\Resources\NotifityResource\Pages;

use App\Filament\Resources\NotifityResource;
use Carbon\Carbon;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewNotifity extends ViewRecord
{
    protected static string $resource = NotifityResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Información de la Notificación Enviada')
                    ->schema([
                        TextEntry::make('employee.full_name')
                            ->label('Nombres y Apellidos del Empleado:'),
                        TextEntry::make('created_at')
                            ->label('Fecha y Hora de Envío:')
                            ->formatStateUsing(
                                fn($state) => Carbon::parse($state)
                                    ->timezone('America/Bogota')
                                    ->format('d/m/Y h:i A')
                            ),
                        TextEntry::make('message')
                            ->label('Mensaje:'),
                    ])
                    ->columns(2),
            ]);
    }
}
