<?php

namespace App\Filament\Exports;

use App\Models\PemakaianListrik;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PemakaianListrikExporter extends Exporter
{
    protected static ?string $model = PemakaianListrik::class;

    public static function getColumns(): array
    {
        return [
            // ExportColumn::make('id')
            //     ->label('ID'),
            ExportColumn::make('whse'),
            ExportColumn::make('workdate'),
            ExportColumn::make('nama_gedung'),
            ExportColumn::make('skema_pembayaran'),
            ExportColumn::make('scope'),
            ExportColumn::make('kwh'),
            ExportColumn::make('created_by'),
            ExportColumn::make('updated_by'),
            // ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pemakaian listrik export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
