<?php

namespace App\Filament\Resources\PemakaianSolarResource\Pages;

use App\Filament\Resources\PemakaianSolarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemakaianSolar extends EditRecord
{
    protected static string $resource = PemakaianSolarResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

     protected function mutateFormDataBeforeUpdate(array $data): array
    {
        // Menambahkan ID pengguna yang sedang login
        $data['updated_by'] = auth()->user()->name;

        return $data;
    }
}
