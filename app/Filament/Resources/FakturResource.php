<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FakturResource\Pages;
use App\Filament\Resources\FakturResource\RelationManagers;
use App\Models\Customer;
use App\Models\Faktur;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FakturResource extends Resource
{
    protected static ?string $model = Faktur::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_faktur')->required()->label('Nomor Faktur')
                ,
                TextInput::make('kode_customer')->required()->label('Kode Customer')
                ,
                DatePicker::make('tanggal_faktur')->required()->label('Nomor Faktur')
                ,
                Select::make('customer_id')->relationship('customers', 'nama_customer') 
                ,
                Repeater::make('details')
                    ->relationship('details')
                    ->schema([
                        Select::make('barang_id')->relationship('barangs', 'nama_barang'),
                        TextInput::make('diskon'),
                        TextInput::make('nama_barang'),
                        TextInput::make('qty'),
                        TextInput::make('harga'),
                        TextInput::make('subtotal'),
                        TextInput::make('hasil_qty'),

                    ])
                ,
                Textarea::make('keterangan_faktur')
                ,
                TextInput::make('total')->required()
                ,
                TextInput::make('nominal_charge')->required()
                ,
                TextInput::make('charge')->required()
                ,
                TextInput::make('total_final')->required()
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_faktur')->sortable(),
                TextColumn::make('kode_customer')->sortable(),
                TextColumn::make('tanggal_faktur')->sortable(),
                TextColumn::make('customers.nama_customer')->sortable(),
                TextColumn::make('total')->sortable(),
                TextColumn::make('total_final')->sortable(),
                TextColumn::make('charge')->sortable(),
                TextColumn::make('nominal_charge')->sortable(),
                TextColumn::make('keterangan_faktur')->sortable(),
                
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFakturs::route('/'),
            'create' => Pages\CreateFaktur::route('/create'),
            'edit' => Pages\EditFaktur::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
