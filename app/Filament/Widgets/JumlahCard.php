<?php

namespace App\Filament\Widgets;

use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class JumlahCard extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Jumlah Siswa', Siswa::count())
                ->description('Total jumlah siswa yang terdaftar')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('primary'),
            Card::make('Jumlah Guru', Guru::count())
                ->description('Total jumlah guru yang mengajar')
                ->descriptionIcon('heroicon-s-academic-cap')
                ->color('success'),
            Card::make('Jumlah Mapel', MataPelajaran::count())
                ->description('Total jumlah mata pelajaran')
                ->descriptionIcon('heroicon-s-book-open')
                ->color('warning'),
        ];
    }
}
