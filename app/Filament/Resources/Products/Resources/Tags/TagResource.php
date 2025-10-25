<?php

namespace App\Filament\Resources\Products\Resources\Tags;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Resources\Tags\Pages\CreateTag;
use App\Filament\Resources\Products\Resources\Tags\Pages\EditTag;
use App\Filament\Resources\Products\Resources\Tags\Schemas\TagForm;
use App\Filament\Resources\Products\Resources\Tags\Tables\TagsTable;
use App\Models\Tag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $parentResource = ProductResource::class;

    public static function getModelLabel(): string
    {
        return __('filament/resources/tag.label');
    }

    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
