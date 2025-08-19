<?php
/* Página ViewIncapacity: Muestra en pantalla la información detallada del registro de incapacidad del empleado. Además, contiene la siguiente función:

- getHeaderActions: Dibuja en la interfaz del sistema un botón para generar un documento PDF con el registro de la incapacidad del empleado. */

namespace App\Filament\Resources\IncapacityResource\Pages;

use App\Filament\Resources\IncapacityResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewIncapacity extends ViewRecord
{
    protected static string $resource = IncapacityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generatePDF')
                ->label('Generar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn($record) => route('incapacities.pdf', $record))
                ->color('danger')
                ->openUrlInNewTab(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Información del Empleado')
                    ->schema([
                        TextEntry::make('employee.full_name')
                            ->label('Nombres y Apellidos del Empleado:'),
                        TextEntry::make('employee.id_employee')
                            ->label('Número de Cédula:')
                            ->numeric(),
                        TextEntry::make('employee.email_employee')
                            ->label('Correo Electrónico Corporativo:'),
                        TextEntry::make('employee.position.name_position')
                            ->label('Puesto de Trabajo:'),
                        TextEntry::make('employee.healthcare.name_healthcare')
                            ->label('Nombre de la EPS:'),
                    ])
                    ->columns(2),

                Section::make('Información de la Incapacidad')
                    ->schema([
                        TextEntry::make('type_incapacity')
                            ->label('Tipo de Incapacidad:'),
                        TextEntry::make('description_incapacity')
                            ->label('Descripción de la Incapacidad:'),
                        TextEntry::make('start_date')
                            ->label('Fecha Inicial:')
                            ->date(),
                        TextEntry::make('end_date')
                            ->label('Fecha Final:')
                            ->date(),
                        TextEntry::make('status')
                            ->label('Estado:'),
                    ])
                    ->columns(2),
            ]);
    }
}
