<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class statsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $unshippedOrders = \App\Models\Order::where('status', '!=', 'completed')->count();

        return [
          Card::make('Unshipped Orders', $unshippedOrders)
            ->description('Orders that have not been shipped yet')
            ->color('danger')
            ->icon('heroicon-o-inbox'),
        ];
    }
}
