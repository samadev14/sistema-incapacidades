<?php
/* Módulo EPS: Genera un formulario con validaciones avanzadas, el cual se digita la información del nombre de una Entidad Promotora de Salud, conocidas como EPS. Al guardar la información en la base de datos del sistema, es mostrada automáticamente en una tabla, la cual contiene unos botones de acciones, que permiten al administrador del sistema consultar, editar y eliminar la información. */

namespace App\Filament\Resources;

use App\Filament\Resources\HealthcareResource\Pages;
use App\Models\Healthcare;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HealthcareResource extends Resource
{
    protected static ?string $model = Healthcare::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'EPS';
    }

    public static function getPluralModelLabel(): string
    {
        return 'EPS';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name_healthcare')
                            ->label('Nombre de la EPS')
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
                Tables\Columns\TextColumn::make('name_healthcare')
                    ->label('Nombre de la EPS')
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
                            ->title('EPS Eliminada')
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
            'index' => Pages\ListHealthcares::route('/'),
            'create' => Pages\CreateHealthcare::route('/create'),
            'view' => Pages\ViewHealthcare::route('/{record}'),
            'edit' => Pages\EditHealthcare::route('/{record}/edit'),
        ];
    }
}
