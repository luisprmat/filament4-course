<?php

namespace App\Filament\Resources\Users\Resources\Orders\Pages;

use App\Filament\Resources\Users\Resources\Orders\OrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['price'] = $data['price'] / 100;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['price'] = $data['price'] * 100;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
