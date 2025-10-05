<?php

namespace App\Filament\Resources\Products\Tables;

use App\Enums\ProductStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->formatStateUsing(fn (int $state): string => Number::currency($state / 100, precision: 0))
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('category.name'),
                TextColumn::make('tags.name'),
            ])
            ->defaultSort('name', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('Status'))
                    ->options(ProductStatusEnum::class),
                SelectFilter::make('category')
                    ->label(__('Category'))
                    ->relationship('category', 'name'),
                Filter::make('created_from')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label(__('Created from')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['created_from'], function (Builder $query, string $date) {
                            return $query->where('created_at', '>=', $date);
                        });
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators[] = Indicator::make(__('Created from').': '.Carbon::parse($data['created_from'])->isoFormat('MMM DD, YYYY'))
                                ->removeField('created_from');
                        }

                        return $indicators;
                    }),
                Filter::make('created_until')
                    ->schema([
                        DatePicker::make('created_until')
                            ->label(__('Created until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['created_until'], function (Builder $query, string $date) {
                            return $query->where('created_at', '<=', $date);
                        });
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_until'] ?? null) {
                            $indicators[] = Indicator::make(__('Created until').': '.Carbon::parse($data['created_until'])->isoFormat('MMM DD, YYYY'))
                                ->removeField('created_until');
                        }

                        return $indicators;
                    }),
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
