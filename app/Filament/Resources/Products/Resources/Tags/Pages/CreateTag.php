<?php

namespace App\Filament\Resources\Products\Resources\Tags\Pages;

use App\Filament\Resources\Products\Resources\Tags\TagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;
}
