<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    //custom icon bisa dicari di hero icon
    protected static ?string $navigationIcon = 'heroicon-o-user';
    
    //cara custom label
    protected static ?string $navigationLabel = 'Customer Custom Label';

    //cara custom slug/url
    protected static ?string $slug = 'this-is-custom-slug-customer';

    //cara custom group navigation
    protected static ?string $navigationGroup = 'Customer Group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_customer')->name('Name')->required()->placeholder('John Doe'),
                TextInput::make('nomor_customer')->name('Telphone Number')->numeric()->required()->placeholder('081234567890'),
                Textarea::make('alamat_customer')->name('Address')->required()->placeholder('Jl. Raya No. 1')->rows(10)->cols(20)->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('nama_customer')->sortable()->label('Name')->searchable(),
                TextColumn::make('nomor_customer')->sortable()->label('Telphone Number'),
                TextColumn::make('alamat_customer')->sortable()->label('Address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
