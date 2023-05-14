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
          Card::make('Total Orders', \App\Models\Order::count())
            ->color('success')
            ->icon('heroicon-o-shopping-cart'),
          Card::make('Unshipped Orders', $unshippedOrders)
            ->color('danger')
            ->icon('heroicon-o-inbox'),
          Card::make('Total Customers', \App\Models\User::count())
            ->color('success')
            ->icon('heroicon-o-user'),
        ];
    }
}
