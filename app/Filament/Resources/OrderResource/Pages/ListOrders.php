<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Pages\Actions;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            FilamentExportBulkAction::make('Export'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
