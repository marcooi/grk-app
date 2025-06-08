<?php

namespace App\Filament\Resources\PemakaianGasResource\Pages;

use App\Filament\Resources\PemakaianGasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePemakaianGas extends CreateRecord
{
    protected static string $resource = PemakaianGasResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Menambahkan ID pengguna yang sedang login
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;

        return $data;
    }
}
