<?php
/* Módulo Empleados: Genera un formulario con validaciones avanzadas, el cual se digita la información del empleado. Al guardar la información en la base de datos del sistema, es mostrada automáticamente en una tabla, la cual contiene unos botones de acciones, que permiten al administrador del sistema consultar, editar y eliminar la información del empleado. */

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Rules\UniqueFullNameEmployee;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return 'Empleado';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Empleados';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name_employee')
                            ->label('Nombres')
                            ->required()
                            ->maxLength(255)
                            ->rule(fn() => new UniqueFullNameEmployee(request()->route('record')?->id)),
                        Forms\Components\TextInput::make('last_name_employee')
                            ->label('Apellidos')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('id_employee')
                            ->label('Número de Cédula')
                            ->required()
                            ->numeric()
                            ->maxLength(10)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('email_employee')
                            ->label('Correo Electrónico Corporativo')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('position_id')
                            ->label('Puesto de Trabajo')
                            ->relationship('position', 'name_position')
                            ->required(),
                        Forms\Components\Select::make('healthcare_id')
                            ->label('Nombre de la EPS')
                            ->relationship('healthcare', 'name_healthcare')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_employee')
                    ->label('Nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name_employee')
                    ->label('Apellidos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_employee')
                    ->label('Número de Cédula')
                    ->numeric()
                    ->searchable(),
            ])
            ->filters([
                //
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
                            ->title('Empleado Eliminado')
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
