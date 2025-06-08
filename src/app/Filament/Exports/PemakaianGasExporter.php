<?php

namespace App\Filament\Exports;

use App\Models\PemakaianGas;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PemakaianGasExporter extends Exporter
{
    protected static ?string $model = PemakaianGas::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('id')
            //     ->label('ID'),
            ExportColumn::make('whse'),
            ExportColumn::make('workdate'),
            ExportColumn::make('tipeSection.name')
                ->label('Section'),
            ExportColumn::make('tipeItem.name')
                ->label('Item Name'),
            ExportColumn::make('qty'),
            ExportColumn::make('kgs'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            // ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pemakaian gas export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
