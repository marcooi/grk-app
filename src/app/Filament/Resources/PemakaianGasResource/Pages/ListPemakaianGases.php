<?php

namespace App\Filament\Resources\PemakaianGasResource\Pages;

use App\Filament\Resources\PemakaianGasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemakaianGases extends ListRecords
{
    protected static string $resource = PemakaianGasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Data') // Rename "New" to "Tambah Data"
                ->icon('heroicon-o-plus'), // Optional: Add an icon for visual appeal
        ];
    }
}
