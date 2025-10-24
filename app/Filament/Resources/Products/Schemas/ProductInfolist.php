<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Number;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->inlineLabel(),
                TextEntry::make('price')
                    ->formatStateUsing(fn (int $state): string => Number::currency($state / 100, precision: 0))
                    ->inlineLabel(),
                IconEntry::make('is_active')
                    ->inlineLabel(),
                TextEntry::make('status')
                    ->badge()
                    ->inlineLabel(),
                TextEntry::make('description')
                    ->placeholder(__('No description.'))
                    ->columnSpanFull(),
            ]);
    }
}
