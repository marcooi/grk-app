<?php

namespace App\Filament\Resources\PemakaianListrikResource\Pages;

use App\Filament\Resources\PemakaianListrikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemakaianListrik extends EditRecord
{
    protected static string $resource = PemakaianListrikResource::class;

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
