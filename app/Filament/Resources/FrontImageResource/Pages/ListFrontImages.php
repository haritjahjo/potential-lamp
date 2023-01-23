<?php

namespace App\Filament\Resources\FrontImageResource\Pages;

use App\Filament\Resources\FrontImageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFrontImages extends ListRecords
{
    protected static string $resource = FrontImageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
