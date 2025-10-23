<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class ContactUs extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    public static function getNavigationLabel(): string
    {
        return __('Contact Us');
    }

    public function getHeading(): string
    {
        return __('Contact Us');
    }

    protected string $view = 'filament.pages.contact-us';
}
