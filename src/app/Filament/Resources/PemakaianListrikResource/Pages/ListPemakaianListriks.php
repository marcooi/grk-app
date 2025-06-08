<?php

namespace App\Filament\Resources\PemakaianListrikResource\Pages;

use App\Filament\Resources\PemakaianListrikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemakaianListriks extends ListRecords
{
    protected static string $resource = PemakaianListrikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
