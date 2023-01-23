<?php

namespace App\Filament\Resources\FrontImageResource\Pages;

use App\Filament\Resources\FrontImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFrontImage extends CreateRecord
{
    protected static string $resource = FrontImageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
