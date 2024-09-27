<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return trans('ecommerce.group'); // TODO: Change the autogenerated stub
    }

    public static function getPluralLabel(): ?string
    {
        return trans('ecommerce.product.title');
    }

    public static function getNavigationLabel(): string
    {
        return trans('ecommerce.product.title'); // TODO: Change the autogenerated stub
    }

    public static function getLabel(): ?string
    {
        return trans('ecommerce.product.single'); // TODO: Change the autogenerated stub
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make(trans('ecommerce.product.tabs.details'))
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->columnSpanFull()
                                    ->searchable()
                                    ->options([
                                        'product' => 'Product',
                                        'digital' => 'Digital',
                                        'service' => 'Service',
                                    ])
                                    ->label(trans('ecommerce.product.columns.type'))
                                    ->default('product'),
                                Forms\Components\TextInput::make('name')
                                    ->label(trans('ecommerce.product.columns.name'))
                                    ->lazy()
                                    ->afterStateUpdated(fn (Forms\Get $get, Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($get('name'))))
                                    ->required(),
                                Forms\Components\TextInput::make('slug')
                                    ->label(trans('ecommerce.product.columns.slug'))
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('about')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.about')),
                                Forms\Components\TextInput::make('sku')
                                    ->default(uniqid())
                                    ->label(trans('ecommerce.product.columns.sku'))
                                    ->unique(Product::class, column: 'sku', ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('barcode')
                                    ->label(trans('ecommerce.product.columns.barcode'))
                                    ->unique(Product::class, column: 'barcode', ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('price')
                                    ->label(trans('ecommerce.product.columns.price'))
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('vat')
                                    ->label(trans('ecommerce.product.columns.vat'))
                                    ->numeric()
                                    ->prefix('$')
                                    ->default(0),
                                Forms\Components\TextInput::make('discount')
                                    ->label(trans('ecommerce.product.columns.discount'))
                                    ->numeric()
                                    ->live()
                                    ->prefix('%')
                                    ->default(0),
                                Forms\Components\DateTimePicker::make('discount_to')
                                    ->rule('after:now')
                                    ->hidden(fn (Forms\Get $get) => ! $get('discount'))
                                    ->label(trans('ecommerce.product.columns.discount_to')),
                                Forms\Components\Toggle::make('is_activated')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.is_activated')),
                                Forms\Components\Toggle::make('is_trend')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.is_trend')),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make(trans('ecommerce.product.tabs.prices'))
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Toggle::make('is_shipped')
                                    ->label(trans('ecommerce.product.columns.is_shipped')),
                                Forms\Components\Toggle::make('has_multi_price')
                                    ->live()
                                    ->label(trans('ecommerce.product.columns.has_multi_price')),
                                Forms\Components\Repeater::make('prices')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_multi_price'))
                                    ->label(trans('ecommerce.product.columns.prices'))
                                    ->itemLabel(fn (array $state): ?string => Str::title($state['for']) ?? null)
                                    ->collapsed()
                                    ->collapsible()
                                    ->cloneable()
                                    ->schema([
                                        Forms\Components\Select::make('for')
                                            ->searchable()
                                            ->live()
                                            ->options([
                                                'retail' => 'Retail',
                                                'wholesale' => 'Wholesale',
                                                'special' => 'Special',
                                                'items' => 'Items',
                                            ])
                                            ->default('retail')
                                            ->label(trans('ecommerce.product.columns.for'))
                                            ->columnSpanFull()
                                            ->required(),
                                        Forms\Components\TextInput::make('qty')
                                            ->hidden(fn (Forms\Get $get) => $get('for') !== 'items')
                                            ->label(trans('ecommerce.product.columns.qty'))
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('price')
                                            ->label(trans('ecommerce.product.columns.price'))
                                            ->required()
                                            ->numeric()
                                            ->prefix('$'),
                                        Forms\Components\TextInput::make('vat')
                                            ->label(trans('ecommerce.product.columns.vat'))
                                            ->numeric()
                                            ->prefix('$')
                                            ->default(0),
                                        Forms\Components\TextInput::make('discount')
                                            ->label(trans('ecommerce.product.columns.discount'))
                                            ->numeric()
                                            ->live()
                                            ->prefix('%')
                                            ->default(0),
                                        Forms\Components\DateTimePicker::make('discount_to')
                                            ->rule('after:now')
                                            ->hidden(fn (Forms\Get $get) => ! $get('discount'))
                                            ->label(trans('ecommerce.product.columns.discount_to')),
                                    ])->columns(3),
                            ]),
                        Forms\Components\Tabs\Tab::make(trans('ecommerce.product.tabs.stock'))
                            ->icon('heroicon-o-home-modern')
                            ->schema([
                                Forms\Components\Toggle::make('is_in_stock')
                                    ->label(trans('ecommerce.product.columns.is_in_stock')),
                                Forms\Components\Toggle::make('has_unlimited_stock')
                                    ->label(trans('ecommerce.product.columns.has_unlimited_stock')),
                                Forms\Components\Toggle::make('has_max_cart')
                                    ->columnSpanFull()
                                    ->live()
                                    ->label(trans('ecommerce.product.columns.has_max_cart')),
                                Forms\Components\TextInput::make('min_cart')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_max_cart'))
                                    ->label(trans('ecommerce.product.columns.min_cart'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('max_cart')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_max_cart'))
                                    ->label(trans('ecommerce.product.columns.max_cart'))
                                    ->numeric(),
                                Forms\Components\Toggle::make('has_stock_alert')
                                    ->columnSpanFull()
                                    ->live()
                                    ->label(trans('ecommerce.product.columns.has_stock_alert')),
                                Forms\Components\TextInput::make('min_stock_alert')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_stock_alert'))
                                    ->label(trans('ecommerce.product.columns.min_stock_alert'))
                                    ->numeric(),
                                Forms\Components\TextInput::make('max_stock_alert')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_stock_alert'))
                                    ->label(trans('ecommerce.product.columns.max_stock_alert'))
                                    ->numeric(),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make(trans('ecommerce.product.tabs.seo'))
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('feature_image')
                                    ->columnSpanFull()
                                    ->collection('feature_image')
                                    ->label(trans('ecommerce.product.columns.feature_image')),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                                    ->columnSpanFull()
                                    ->columns('gallery')
                                    ->multiple()
                                    ->reorderable()
                                    ->label(trans('ecommerce.product.columns.gallery')),
                                Forms\Components\Select::make('category_id')
                                    ->columnSpanFull()
                                    ->searchable()
                                    ->options(Category::query()
                                        ->where('for', 'product')
                                        ->where('type', 'category')
                                        ->pluck('name', 'id')
                                        ->toArray()
                                    )
                                    ->label(trans('ecommerce.product.columns.category_id')),
                                Forms\Components\Select::make('categories')
                                    ->relationship('categories')
                                    ->multiple()
                                    ->searchable()
                                    ->options(Category::query()
                                        ->where('for', 'product')
                                        ->where('type', 'category')
                                        ->pluck('name', 'id')
                                        ->toArray()
                                    )
                                    ->label(trans('ecommerce.product.columns.categories')),
                                Forms\Components\Select::make('tags')
                                    ->relationship('tags')
                                    ->multiple()
                                    ->searchable()
                                    ->options(Category::query()
                                        ->where('for', 'product')
                                        ->where('type', 'tag')
                                        ->pluck('name', 'id')
                                        ->toArray()
                                    )
                                    ->label(trans('ecommerce.product.columns.tags')),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.description')),
                                Forms\Components\RichEditor::make('details')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.details')),
                                Forms\Components\Textarea::make('keywords')
                                    ->columnSpanFull()
                                    ->label(trans('ecommerce.product.columns.keywords')),

                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make(trans('ecommerce.product.tabs.variation'))
                            ->icon('heroicon-o-cursor-arrow-ripple')
                            ->schema([
                                Forms\Components\Toggle::make('has_options')
                                    ->live()
                                    ->label(trans('ecommerce.product.columns.has_options')),
                                Forms\Components\Repeater::make('options')
                                    ->hidden(fn (Forms\Get $get) => ! $get('has_options'))
                                    ->label(trans('ecommerce.product.columns.options.title'))
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                                    ->collapsed()
                                    ->collapsible()
                                    ->cloneable()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label(trans('ecommerce.product.columns.options.name')),
                                        Forms\Components\Repeater::make('values')
                                            ->itemLabel(fn (array $state): ?string => $state['value'] ?? null)
                                            ->collapsed()
                                            ->collapsible()
                                            ->cloneable()
                                            ->label(trans('ecommerce.product.columns.options.values'))
                                            ->schema([
                                                Forms\Components\TextInput::make('value')
                                                    ->label(trans('ecommerce.product.columns.options.value'))
                                                    ->columnSpanFull(),
                                                Forms\Components\Toggle::make('has_custom_price')
                                                    ->label(trans('ecommerce.product.columns.options.has_custom_price'))
                                                    ->columnSpanFull()
                                                    ->live(),
                                                Forms\Components\Select::make('price_for')
                                                    ->label(trans('ecommerce.product.columns.options.price_for'))
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_custom_price'))
                                                    ->searchable()
                                                    ->live()
                                                    ->options([
                                                        'retail' => 'Retail',
                                                        'wholesale' => 'Wholesale',
                                                        'special' => 'Special',
                                                        'items' => 'Items',
                                                    ])
                                                    ->default('retail')
                                                    ->required(),
                                                Forms\Components\TextInput::make('qty')
                                                    ->hidden(fn (Forms\Get $get) => $get('price_for') !== 'items')
                                                    ->label(trans('ecommerce.product.columns.options.qty'))
                                                    ->required()
                                                    ->numeric(),
                                                Forms\Components\TextInput::make('price')
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_custom_price'))
                                                    ->label(trans('ecommerce.product.columns.options.price'))
                                                    ->required()
                                                    ->numeric()
                                                    ->default(0)
                                                    ->prefix('$'),
                                                Forms\Components\TextInput::make('vat')
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_custom_price'))
                                                    ->label(trans('ecommerce.product.columns.options.vat'))
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->default(0),
                                                Forms\Components\TextInput::make('discount')
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_custom_price'))
                                                    ->label(trans('ecommerce.product.columns.options.discount'))
                                                    ->numeric()
                                                    ->live()
                                                    ->prefix('%')
                                                    ->default(0),
                                                Forms\Components\DateTimePicker::make('discount_to')
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_custom_price'))
                                                    ->rule('after:now')
                                                    ->hidden(fn (Forms\Get $get) => ! $get('discount'))
                                                    ->label(trans('ecommerce.product.columns.options.discount_to')),
                                                Forms\Components\Toggle::make('has_color')
                                                    ->label(trans('ecommerce.product.columns.options.has_color'))
                                                    ->columnSpanFull()
                                                    ->live(),
                                                Forms\Components\ColorPicker::make('color')
                                                    ->label(trans('ecommerce.product.columns.options.color'))
                                                    ->hidden(fn (Forms\Get $get) => ! $get('has_color')),
                                            ])->columns(4),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('feature_image')
                    ->label(trans('ecommerce.product.columns.feature_image'))
                    ->square()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->collection('feature_image'),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn (Product $product) => Str::limit($product->about, 50))
                    ->label(trans('ecommerce.product.columns.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->state(fn (Product $product) => match ($product->type) {
                        'product' => 'Product',
                        'digital' => 'Digital',
                        'service' => 'Service',
                    })
                    ->color(fn (Product $product) => match ($product->type) {
                        'product' => 'primary',
                        'digital' => 'success',
                        'service' => 'warning',
                    })
                    ->icon(fn (Product $product) => match ($product->type) {
                        'product' => 'heroicon-s-shopping-cart',
                        'digital' => 'heroicon-s-cloud',
                        'service' => 'heroicon-s-cog',
                    })
                    ->label(trans('ecommerce.product.columns.type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('sku')
                    ->label(trans('ecommerce.product.columns.sku'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->state(fn (Product $product) => ($product->price + $product->vat) - $product->discount)
                    ->description(fn (Product $product) => '(Price:'.number_format($product->price, 2).'+VAT:'.number_format($product->vat).')-Discount:'.number_format($product->discount))
                    ->label(trans('ecommerce.product.columns.price'))
                    ->money(locale: 'en', currency: setting('site_currency'))
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_activated')
                    ->label(trans('ecommerce.product.columns.is_activated')),
                Tables\Columns\ToggleColumn::make('is_trend')
                    ->label(trans('ecommerce.product.columns.is_trend')),
                Tables\Columns\ToggleColumn::make('is_in_stock')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('ecommerce.product.columns.is_in_stock')),
                Tables\Columns\ToggleColumn::make('has_unlimited_stock')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('ecommerce.product.columns.has_unlimited_stock')),
                Tables\Columns\TextColumn::make('category.name')
                    ->badge()
                    ->label(trans('ecommerce.product.columns.category_id'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label(trans('ecommerce.product.filters.category_id'))
                    ->searchable()
                    ->options(Category::query()
                        ->where('for', 'product')
                        ->where('type', 'category')
                        ->pluck('name', 'id')
                        ->toArray()
                    ),
                Tables\Filters\SelectFilter::make('categories')
                    ->label(trans('ecommerce.product.filters.categories'))
                    ->searchable()
                    ->multiple()
                    ->relationship('categories', 'name')
                    ->options(Category::query()
                        ->where('for', 'product')
                        ->where('type', 'category')
                        ->pluck('name', 'id')
                        ->toArray()
                    ),
                Tables\Filters\SelectFilter::make('type')
                    ->label(trans('ecommerce.product.filters.type'))
                    ->searchable()
                    ->options([
                        'product' => 'Product',
                        'digital' => 'Digital',
                        'service' => 'Service',
                    ]),
                Tables\Filters\TernaryFilter::make('is_activated')
                    ->label(trans('ecommerce.product.filters.is_activated')),
                Tables\Filters\TernaryFilter::make('is_trend')
                    ->label(trans('ecommerce.product.filters.is_trend')),
                Tables\Filters\TernaryFilter::make('is_shipped')
                    ->label(trans('ecommerce.product.filters.is_shipped')),
                Tables\Filters\TernaryFilter::make('is_in_stock')
                    ->label(trans('ecommerce.product.filters.is_in_stock')),
                Tables\Filters\TernaryFilter::make('has_unlimited_stock')
                    ->label(trans('ecommerce.product.filters.has_unlimited_stock')),

            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::Modal)
            ->groups([
                Tables\Grouping\Group::make('type'),
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
            RelationManagers\ProductReviewManager::make(),
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