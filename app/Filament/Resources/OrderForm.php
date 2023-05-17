<?php

namespace App\Filament\Resources;

use Filament\Resources\Form as FilamentForm;
use Filament\Forms\Components\Component;
use App\Events\OrderStatusChanged;

class OrderForm extends FilamentForm
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->registerListeners([
            'status::change' => [
                function (Component $component, string $statePath, $newValue, $oldValue): void {
                    if ($component->isDisabled()) {
                        return;
                    }

                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }

                    // Handle status change
                    $this->handleStatusChange($oldValue, $newValue);
                },
            ],
        ]);
    }

    protected function handleStatusChange($oldValue, $newValue)
    {
        if ($newValue === 'completed' && $oldValue !== $newValue) {
            $order = $this->getModel();
            event(new OrderStatusChanged($order));
        }
    }
}
