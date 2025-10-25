<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use App\Filament\Tables\CategoriesTable;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Wizard::make()->steps([
                    Step::make(__('Main data'))
                        // ->description(__('Required fill by all users.'))
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Product Name'))
                                ->required()
                                ->columnSpanFull()
                                ->disabledOn('edit')
                                // ->live(onBlur: true)
                                // ->afterStateUpdated(function (Set $set, ?string $state) {
                                //     $set('slug', str()->slug($state));
                                // })
                                ->unique(),
                            // TextInput::make('slug')
                            //     ->required(),
                            TextInput::make('price')
                                ->required()
                                ->prefix('$')
                                ->rule('numeric'),
                        ]),
                    Step::make(__('Additional data'))
                        ->schema([
                            Select::make('status')
                                ->options(ProductStatusEnum::class)
                                ->required(),
                            Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple(),
                            ModalTableSelect::make('category_id')
                                ->relationship('category', 'name')
                                ->tableConfiguration(CategoriesTable::class),
                        ]),
                ]),
            ]);
    }
}
