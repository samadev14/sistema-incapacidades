<?php
/* Módulo Incapacidades: Genera un formulario con validaciones avanzadas, el cual por medio de un campo desplegable se consultan nombres y apellidos de los empleados y al seleccionar uno de los empleados se trae automáticamente la información completa del empleado, gracias a la relación que tiene el modelo Incapacity con el modelo Employee. Al guardar la información en la base de datos del sistema, es mostrada automáticamente en una tabla, la cual contiene unos botones de acciones, que permiten al administrador del sistema consultar por medio de filtros el estado y tipo de la incapacidad, editar y eliminar la información. */

namespace App\Filament\Resources;

use App\Filament\Resources\IncapacityResource\Pages;
use App\Models\Employee;
use App\Models\Incapacity;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IncapacityResource extends Resource
{
    protected static ?string $model = Incapacity::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return 'Incapacidad';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Incapacidades';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('employee_id')
                            ->label('Nombres y Apellidos del Empleado')
                            ->options(Employee::all()->pluck('full_name', 'id'))
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $employee = Employee::with(['position', 'healthcare'])->find($state);

                                if ($employee) {
                                    $set('id_employee', $employee->id_employee);
                                    $set('email_employee', $employee->email_employee);
                                    $set('position_id', $employee->position?->name_position);
                                    $set('healthcare_id', $employee->healthcare?->name_healthcare);
                                } else {
                                    $set('id_employee', null);
                                    $set('email_employee', null);
                                    $set('position_id', null);
                                    $set('healthcare_id', null);
                                }
                            }),
                        Forms\Components\TextInput::make('id_employee')
                            ->label('Número de Cédula')
                            ->disabled(),
                        Forms\Components\TextInput::make('email_employee')
                            ->label('Correo Electrónico Corporativo')
                            ->disabled(),
                        Forms\Components\TextInput::make('position_id')
                            ->label('Puesto de Trabajo')
                            ->disabled(),
                        Forms\Components\TextInput::make('healthcare_id')
                            ->label('Nombre de la EPS')
                            ->disabled(),
                        Forms\Components\Select::make('type_incapacity')
                            ->label('Tipo de Incapacidad')
                            ->options([
                                'Médica' => 'Médica',
                                'Accidente Laboral' => 'Accidente Laboral',
                                'Licencia de Maternidad' => 'Licencia de Maternidad',
                                'Licencia de Paternidad' => 'Licencia de Paternidad',
                                'Licencia de Vacaciones' => 'Licencia de Vacaciones',
                                'Otro' => 'Otro',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('description_incapacity')
                            ->label('Descripción de la Incapacidad')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Fecha Inicial')
                            ->nullable()
                            ->live(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label('Fecha Final')
                            ->nullable()
                            ->disabled(fn(Get $get) => !$get('start_date'))
                            ->live(),
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'Pendiente' => 'Pendiente',
                                'Activa' => 'Activa',
                                'Finalizada' => 'Finalizada',
                            ])->required()
                            ->default('Pendiente')
                            ->native(false)
                            ->live(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.full_name')
                    ->label('Nombres y Apellidos del Empleado')
                    ->searchable()
                    ->searchable(query: function (Builder $query, string $search) {
                        $query->orWhereHas('employee', function (Builder $employeeQuery) use ($search) {
                            $employeeQuery->whereRaw("CONCAT(name_employee, ' ', last_name_employee) LIKE ?", ["%{$search}%"]);
                        });
                    }),
                Tables\Columns\TextColumn::make('employee.id_employee')
                    ->label('Número de Cédula')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_incapacity')
                    ->label('Tipo de Incapacidad'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pendiente' => 'warning',
                        'Activa' => 'success',
                        'Finalizada' => 'danger',
                    })
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'Pendiente' => 'Pendiente',
                        'Activa' => 'Activa',
                        'Finalizada' => 'Finalizada',
                    ]),
                Tables\Filters\SelectFilter::make('type_incapacity')
                    ->label('Tipo de Incapacidad')
                    ->options([
                        'Médica' => 'Médica',
                        'Accidente Laboral' => 'Accidente Laboral',
                        'Licencia de Maternidad' => 'Licencia de Maternidad',
                        'Licencia de Paternidad' => 'Licencia de Paternidad',
                        'Licencia de Vacaciones' => 'Licencia de Vacaciones',
                        'Otro' => 'Otro',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button()
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->title('Incapacidad Eliminada')
                            ->body('Se han eliminado los datos exitosamente.')
                            ->success(),
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncapacities::route('/'),
            'create' => Pages\CreateIncapacity::route('/create'),
            'view' => Pages\ViewIncapacity::route('/{record}'),
            'edit' => Pages\EditIncapacity::route('/{record}/edit'),
        ];
    }
}
