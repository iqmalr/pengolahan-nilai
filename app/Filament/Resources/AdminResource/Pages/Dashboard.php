<?php

namespace App\Filament\Resources\AdminResource\Pages;

// use App\Filament\Resources\AdminResource;
use App\Filament\Widgets\JumlahCard;
use Filament\Resources\Pages\Page;

class Dashboard extends Page
{
    // protected static string $resource = AdminResource::class;

    // protected static string $view = 'filament.resources.admin-resource.pages.dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    protected function getWidgets(): array
    {
        return [
            JumlahCard::class,
        ];
    }
}
