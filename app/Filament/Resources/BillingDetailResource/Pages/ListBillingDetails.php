<?php

namespace App\Filament\Resources\BillingDetailResource\Pages;

use App\Filament\Resources\BillingDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBillingDetails extends ListRecords
{
    protected static string $resource = BillingDetailResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
