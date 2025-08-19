<?php
/* Módulo Notificaciones: Genera un formulario con validaciones avanzadas, el cual por medio de un campo desplegable se consultan nombres y apellidos de los empleados y al seleccionar uno de los empleados se trae automáticamente el correo electrónico corporativo del empleado, gracias a la relación que tiene el modelo Notifity con el modelo Employee. Al enviar la notificación por correo electrónico, la información queda almacenada en la base de datos del sistema y el administrador puede consultar y eliminar dicha información. */

namespace App\Filament\Resources;

use App\Filament\Resources\NotifityResource\Pages;
use App\Models\Employee;
use App\Models\Notifity;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class NotifityResource extends Resource
{
    protected static ?string $model = Notifity::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?int $navigationSort = 5;

    public static function getModelLabel(): string
    {
        return 'Notificación';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Notificaciones';
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
                                $employee = Employee::find($state);

                                if ($employee) {
                                    $set('email_employee', $employee->email_employee);
                                } else {
                                    $set('email_employee', null);
                                }
                            }),
                        Forms\Components\TextInput::make('email_employee')
                            ->label('Correo Electrónico Corporativo')
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->label('Mensaje')
                            ->required()
                            ->columnSpanFull(),
                    ])
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
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha y Hora de Envío')
                    ->formatStateUsing(function ($state) {
                        return Carbon::parse($state)
                            ->timezone('America/Bogota')
                            ->format('d/m/Y h:i A');
                    })
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button()
                    ->color('info'),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->title('Notificación Eliminada')
                            ->body('Se han eliminado los datos exitosamente.')
                            ->success()
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
            'index' => Pages\ListNotifities::route('/'),
            'create' => Pages\CreateNotifity::route('/create'),
            'view' => Pages\ViewNotifity::route('/{record}'),
            'edit' => Pages\EditNotifity::route('/{record}/edit'),
        ];
    }
}
