<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PemakaianListrikResource\Pages;
use App\Filament\Resources\PemakaianListrikResource\RelationManagers;
use App\Models\PemakaianListrik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\PemakaianListrikExporter;

class PemakaianListrikResource extends Resource
{
    protected static ?string $model = PemakaianListrik::class;

    protected static ?string $navigationGroup = 'Gas Rumah Kaca';
    protected static ?string $navigationLabel = 'Pemakaian Listrik';
    protected static ?string $navigationIcon = 'heroicon-o-bolt'; // Icon for the resource (representing electricity)
    protected static ?string $navigationGroupIcon = 'heroicon-o-cloud'; // Icon for the group (if supported)

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

                Forms\Components\TextInput::make('nama_gedung')
                    ->label('Nama Gedung / Kantor')
                    ->required(),

                Forms\Components\Select::make('skema_pembayaran')
                    ->label('Skema Pembayaran')
                    ->options([
                        'pasca_bayar' => 'Pasca Bayar',
                        'pra_bayar' => 'Pra Bayar',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('scope')
                    ->label('Scope')
                    ->required(),

                Forms\Components\TextInput::make('kwh')
                    ->label('KWH')
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
                Tables\Columns\TextColumn::make('nama_gedung')
                    ->label('Nama Gedung / Kantor')
                     ->sortable(),
                Tables\Columns\TextColumn::make('skema_pembayaran')
                    ->label('Skema Pembayaran')
                    ->sortable(),
                Tables\Columns\TextColumn::make('scope')
                    ->label('Scope')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kwh')
                    ->label('KWH')
                    ->numeric(),
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
                    ->exporter(PemakaianListrikExporter::class)
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
            'index' => Pages\ListPemakaianListriks::route('/'),
            'create' => Pages\CreatePemakaianListrik::route('/create'),
            'edit' => Pages\EditPemakaianListrik::route('/{record}/edit'),
        ];
    }
}
