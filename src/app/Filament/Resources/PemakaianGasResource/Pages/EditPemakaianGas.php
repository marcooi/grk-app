<?php

namespace App\Filament\Resources\PemakaianGasResource\Pages;

use App\Filament\Resources\PemakaianGasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemakaianGas extends EditRecord
{
    protected static string $resource = PemakaianGasResource::class;

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
