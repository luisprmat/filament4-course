<?php

namespace App\Filament\Accountant\Resources\Orders\Pages;

use App\Filament\Accountant\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
