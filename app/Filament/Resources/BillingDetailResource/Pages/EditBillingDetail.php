<?php

namespace App\Filament\Resources\BillingDetailResource\Pages;

use App\Filament\Resources\BillingDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBillingDetail extends EditRecord
{
    protected static string $resource = BillingDetailResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
