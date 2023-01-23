<?php

namespace App\Filament\Resources\FrontImageResource\Pages;

use App\Filament\Resources\FrontImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFrontImage extends EditRecord
{
    protected static string $resource = FrontImageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
