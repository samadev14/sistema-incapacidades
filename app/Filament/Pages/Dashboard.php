<?php
/* Página que muestra el panel de control del Sistema de Gestión de Incapacidades Laborales */

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $title = 'Panel De Control';
}
