<?php
/* Página ViewEmployee: Contiene la siguiente función:

- getHeaderActions: Dibuja en la interfaz del sistema un botón para generar un documento PDF con el registro del empleado. */

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generatePDF')
                ->label('Generar PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->url(fn($record) => route('employees.pdf', $record))
                ->color('danger')
                ->openUrlInNewTab(),
        ];
    }
}
