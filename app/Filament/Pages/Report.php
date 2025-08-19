<?php
/* Módulo Reportes Estadísticos: Genera reportes en archivos PDF e imágenes PNG el resumen de registros de incapacidades por meses, a partir de la selección de una fecha inicial y una fecha final. Este módulo cuenta con las siguientes funciones:

- getDataTable(): Función que obtiene los registros de incapacidades por mes a partir de la fecha de su creación en la base de datos. Los datos son extraídos del modelo Incapacity.

- getHeaderActions(): Función que crea un botón para descargar el documento PDF del reporte.

- exportPDF(): Función que genera el documento PDF con los datos obtenidos de la función getDataTable y los carga en la vista pdf.report_incapacities para su descarga. */

namespace App\Filament\Pages;

use App\Models\Incapacity;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Get;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Report extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.report';

    protected static ?int $navigationSort = 6;

    protected static ?string $title = 'Reporte Mensual de Incapacidades';

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationLabel(): string
    {
        return 'Reportes Estadísticos';
    }

    public ?string $startDate = null;
    public ?string $endDate = null;

    protected function getFormSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    DatePicker::make('startDate')
                        ->label('Seleccione una Fecha Inicial')
                        ->live()
                        ->afterStateUpdated(fn() => $this->dispatch('filtrarFechas', startDate: $this->startDate, endDate: $this->endDate)),

                    DatePicker::make('endDate')
                        ->label('Seleccione una Fecha Final')
                        ->live()
                        ->afterStateUpdated(fn() => $this->dispatch('filtrarFechas', startDate: $this->startDate, endDate: $this->endDate))
                        ->disabled(fn(Get $get) => !$get('startDate')),
                ])
                ->columns(2),
        ];
    }

    public function getDataTable(): array
    {
        $start = Carbon::parse($this->startDate, 'America/Bogota')->startOfDay();
        $end = Carbon::parse($this->endDate, 'America/Bogota')->endOfDay();

        $registers = Incapacity::whereBetween('created_at', [$start, $end])->get();

        $data = $registers
            ->groupBy(fn($item) => $item->created_at->translatedFormat('F-Y'))
            ->map(fn($items) => $items->count())
            ->toArray();

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generatePDF')
                ->label('Generar Informe en PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(fn() => $this->exportPDF())
        ];
    }

    public function exportPDF(): StreamedResponse
    {
        $data = $this->getDataTable();

        $pdf = Pdf::loadView('pdf.report_incapacities', [
            'data' => $data,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'reporte_estadistico.pdf'
        );
    }
}
