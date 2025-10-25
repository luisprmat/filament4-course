<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class TotalRevenueStats extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make(__('Revenue Today'),
                Number::currency(Order::where('created_at', '>=', now()->startOfDay())->sum('price') / 100, precision: 0)),
            Stat::make(__('Revenue :count Days', ['count' => 7]),
                Number::currency(Order::where('created_at', '>=', now()->subDays(7)->startOfDay())->sum('price') / 100, precision: 0)),
            Stat::make(__('Revenue :count Days', ['count' => 30]),
                Number::currency(Order::where('created_at', '>=', now()->subDays(30)->startOfDay())->sum('price') / 100, precision: 0)),
        ];
    }
}
