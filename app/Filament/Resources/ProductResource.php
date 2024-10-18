<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Entities';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->placeholder('Enter the product code')
                    ->disabled(function ($record) {
                        return $record && $record->exists; // Check if $record is not null
                    }),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Enter the product name'),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->required()
                    ->placeholder('Enter the product quantity'),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->placeholder('Enter the product price'),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(\App\Models\Category::pluck('name', 'id')) // Manually load categories
                    ->required()
                    ->searchable()
                    ->placeholder('Select a category'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->weight(FontWeight::SemiBold)
                    ->description(fn (Product $product) => Str::limit($product->description, 60))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->alignRight()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('IDR', locale: 'id')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                // 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
