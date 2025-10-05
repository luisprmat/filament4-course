<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductStatusEnum: string implements HasColor, HasLabel
{
    case IN_STOCK = 'In Stock';
    case SOLD_OUT = 'Sold Out';
    case COMING_SOON = 'Coming Soon';

    public function getLabel(): string
    {
        $translateKey = str($this->value)->snake()->value;

        return __("filament/resources/product.status.{$translateKey}");
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN_STOCK => 'success',
            self::SOLD_OUT => 'danger',
            self::COMING_SOON => 'warning',
        };
    }
}
