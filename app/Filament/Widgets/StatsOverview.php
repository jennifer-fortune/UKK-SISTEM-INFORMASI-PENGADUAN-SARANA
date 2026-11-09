<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Menunggu',
                Pengaduan::where('status', 'Menunggu')->count()
            )
                ->description('Pengaduan yang belum ditangani')
                ->color('warning'),

            Stat::make(
                'Proses',
                Pengaduan::where('status', 'Proses')->count()
            )
                ->description('Pengaduan sedang ditangani')
                ->color('info'),

            Stat::make(
                'Selesai',
                Pengaduan::where('status', 'Selesai')->count()
            )
                ->description('Pengaduan telah diselesaikan')
                ->color('success'),
        ];
    }
}