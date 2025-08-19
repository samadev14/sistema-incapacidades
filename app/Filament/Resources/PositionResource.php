<?php
/* Módulo Puestos de Trabajo: Genera un formulario con validaciones avanzadas, el cual se digita la información del nombre de los puesto de trabajo de los empleados. Al guardar la información en la base de datos del sistema, es mostrada automáticamente en una tabla, la cual contiene unos botones de acciones, que permiten al administrador del sistema consultar, editar y eliminar la información. */

namespace App\Filament\Resources;

use App\Filament\Resources\PositionResource\Pages;
use App\Models\Position;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PositionResource extends Resource
{
    protected static ?string $model = Position::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Puesto de Trabajo';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Puestos de Trabajo';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name_position')
                            ->label('Puesto de Trabajo')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ])
                    ->maxWidth('md'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('N°'),
                Tables\Columns\TextColumn::make('name_position')
                    ->label('Puesto de Trabajo')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->button()
                    ->color('danger')
                    ->successNotification(
                        Notification::make()
                            ->title('Puesto de Trabajo Eliminado')
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
            'index' => Pages\ListPositions::route('/'),
            'create' => Pages\CreatePosition::route('/create'),
            'view' => Pages\ViewPosition::route('/{record}'),
            'edit' => Pages\EditPosition::route('/{record}/edit'),
        ];
    }
}
