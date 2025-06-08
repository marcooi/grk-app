<?php

namespace App\Filament\Resources\PemakaianSolarResource\Pages;

use App\Filament\Resources\PemakaianSolarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemakaianSolars extends ListRecords
{
    protected static string $resource = PemakaianSolarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
