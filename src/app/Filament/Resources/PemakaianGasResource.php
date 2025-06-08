<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianGasResource\Pages;
use App\Filament\Resources\PemakaianGasResource\RelationManagers;
use App\Models\PemakaianGas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Set;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Cache;
use App\Filament\Exports\PemakaianGasExporter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Grid;
use Carbon\Carbon;

class PemakaianGasResource extends Resource
{
    protected static ?string $model = PemakaianGas::class;

    protected static ?string $navigationGroupIcon = 'heroicon-o-rectangle-stack'; 
    protected static ?string $navigationGroup = 'Gas Rumah Kaca';
    protected static ?string $navigationLabel = 'Pemakaian Gas';

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

    /**
     * Cache and retrieve options for tipe_gases with formatted name
     */
    private static function getGasOptions(): array
    {
        return Cache::remember('tipe_gases_options', self::CACHE_DURATION, function () {
            return DB::table('tipe_gases')
                ->get(['id', 'name', 'kgs'])
                ->mapWithKeys(function ($gas) {
                    return [$gas->id => "{$gas->name} ({$gas->kgs} kg)"];
                })
                ->toArray();
        });
    }

    /**
     * Fetch kgs value for a given gas ID from cache or DB
     */
    private static function getKgsForGas($gasId)
    {
        if (!$gasId) return 0;

        $gases = Cache::remember('tipe_gases_data', self::CACHE_DURATION, function () {
            return DB::table('tipe_gases')->get(['id', 'kgs'])->keyBy('id')->toArray();
        });

        return $gases[$gasId]->kgs ?? 0;
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

                Forms\Components\Select::make('item_id')
                    ->label('Item')
                    ->searchable()
                    ->options(self::getGasOptions())
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                        $qty = $get('qty') ?? 1;
                        $kgs = self::getKgsForGas($state);
                        $set('kgs', $state ? $kgs * $qty : 0);
                    })
                    ->afterStateHydrated(function (Set $set, Get $get, $state) {
                        if ($state) {
                            $qty = $get('qty') ?? 1;
                            $kgs = self::getKgsForGas($state);
                            $set('kgs', $kgs * $qty);
                        }
                    }),

                Forms\Components\TextInput::make('qty')
                    ->label('Qty Tabung')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->default(1)
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                        $state = $state ?: 1;
                        $set('qty', $state);
                        $itemId = $get('item_id');
                        $kgs = self::getKgsForGas($itemId);
                        $set('kgs', $state * $kgs);
                    }),

                Forms\Components\TextInput::make('kgs')
                    ->label('Kgs')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated()
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
                Tables\Columns\TextColumn::make('tipeItem.name')
                    ->label('Item')
                    ->sortable(),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Qty Tabung')
                    ->numeric(),
                Tables\Columns\TextColumn::make('kgs')
                    ->label('Kgs')
                    ->numeric(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('whse')
                    ->label('Warehouse')
                    ->relationship('tipeWarehouse', 'name')
                    // ->searchable()
                    ->preload()
                    ->default(auth()->user()->whse)
                    ->columnSpan(1), // Menetapkan lebar kolom menjadi 1 dari 12


            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent) // Optional: Position filters above content
            ->filtersFormColumns(4) // Arrange filters in a row with 12 columns grid
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
                 Tables\Actions\CreateAction::make()
                    ->label('Tambah Data') // Rename "New" to "Tambah Data"
                    ->icon('heroicon-o-plus'), // Optional: Add an icon for visual appeal

                Tables\Actions\ExportAction::make()
                    ->exporter(PemakaianGasExporter::class)
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
            'index' => Pages\ListPemakaianGases::route('/'),
            'create' => Pages\CreatePemakaianGas::route('/create'),
            'edit' => Pages\EditPemakaianGas::route('/{record}/edit'),
        ];
    }
}
