<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianSolarResource\Pages;
use App\Filament\Resources\PemakaianSolarResource\RelationManagers;
use App\Models\PemakaianSolar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Filament\Exports\PemakaianSolarExporter;

class PemakaianSolarResource extends Resource
{
    protected static ?string $model = PemakaianSolar::class;

    protected static ?string $navigationGroup = 'Gas Rumah Kaca';
    protected static ?string $navigationLabel = 'Pemakaian Solar';

    /**
     * Cache duration for dropdown options (in seconds, e.g., 1 hour)
     */
    private const CACHE_DURATION = 3600;
    
    /**
     * Cache and retrieve options for tipe_sections
     */
    private static function getSectionOptions(): array
    {
        return Cache::remember('tipe_sections_options', self::CACHE_DURATION, function () {
            return DB::table('tipe_sections')->pluck('name', 'id')->toArray();
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
                Forms\Components\Select::make('whse')
                    ->label('Warehouse')
                    ->relationship('tipeWarehouse', 'name')
                    ->preload()
                    ->default(auth()->user()->whse)
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\DatePicker::make('workdate')
                    ->label('Tanggal')
                    ->default(now())
                    ->required(),

                Forms\Components\Select::make('section_id')
                    ->label('Section/Bagian')
                    ->searchable()
                    ->options(self::getSectionOptions())
                    ->required(),

                Forms\Components\TextInput::make('qty')
                    ->label('Jumlah Solar (Liter)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->default(0),
                   
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('whse')
                    ->label('Lokasi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('workdate')
                    ->label('Tanggal')
                    ->dateTime('Y-m-d') // Format the date as needed
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipeSection.name')
                    ->label('Section/Bagian')
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Jumlah Solar (Liter)'),                    
            ])
            ->filters([
                 Tables\Filters\SelectFilter::make('whse')
                    ->label('Warehouse')
                    ->relationship('tipeWarehouse', 'name')
                    // ->searchable()
                    ->preload()
                    ->default(auth()->user()->whse),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent) // Optional: Position filters above content
            ->filtersFormColumns(3) // Arrange filters in a row with 3 columns grid
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            
            ])
              ->headerActions([
                Tables\Actions\ExportAction::make()
                    ->exporter(PemakaianSolarExporter::class)
                    ->label('Export Data')
                    ->columnMapping(false)
                    ->icon('heroicon-o-document-arrow-down')
            ]); 
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPemakaianSolars::route('/'),
            'create' => Pages\CreatePemakaianSolar::route('/create'),
            'edit' => Pages\EditPemakaianSolar::route('/{record}/edit'),
        ];
    }
}
