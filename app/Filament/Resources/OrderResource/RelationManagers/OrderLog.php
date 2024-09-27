<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends RelationManager
{
    protected static string $relationship = 'orderLogs';

    public static function getLabel(): ?string
    {
        return trans('ecommerce.order_logs.single');
    }

    public static function getModelLabel(): ?string
    {
        return trans('ecommerce.order_logs.single');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('ecommerce.order_logs.title');
    }

    protected static function getPluralModelLabel(): ?string
    {
        return trans('ecommerce.order_logs.title');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('user_id')
                ->hidden()
                ->default(auth()->user()->id)
                ->label(trans('ecommerce.order_logs.columns.user_id'))
                ->numeric(),
            Forms\Components\TextInput::make('status')
                ->default($this->getOwnerRecord()->status)
                ->hidden()
                ->label(trans('ecommerce.order_logs.columns.status'))
                ->maxLength(255),
            Forms\Components\Textarea::make('note')
                ->label(trans('ecommerce.order_logs.columns.note'))
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_closed')
                ->label(trans('ecommerce.order_logs.columns.is_closed')),
        ]); // TODO: Change the autogenerated stub
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\CreateAction::make()->using(function (array $data) {
                    $record = $this->getOwnerRecord();
                    $record->orderLogs()->create([
                        'user_id' => auth()->user()->id,
                        'status' => $record->status,
                        'note' => $data['note'],
                        'is_closed' => $data['is_closed'],
                    ]);

                    return $record;
                }),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->description(fn ($record) => $record->created_at->diffForHumans())
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(trans('ecommerce.order_logs.columns.status'))
                    ->state(fn ($record) => str($record->status)->ucfirst()->title()->toString())
                    ->description(fn ($record) => $record->note)
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(trans('ecommerce.order_logs.columns.user_id'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_closed')
                    ->label(trans('ecommerce.order_logs.columns.is_closed')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
