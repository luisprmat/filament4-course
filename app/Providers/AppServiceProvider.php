<?php

namespace App\Providers;

use Filament\Forms\Components\Field;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TextColumn::configureUsing(function (TextColumn $column) {
            $column->translateLabel();
        });

        Field::configureUsing(function (Field $field) {
            $field->translateLabel();
        });
    }
}
