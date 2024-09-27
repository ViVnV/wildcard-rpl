<?php

namespace App\Filament\Resources\AccountResource\Forms;

use App\Models\Type;
use Filament\Forms;
use Filament\Forms\Form;
use TomatoPHP\FilamentHelpers\Contracts\FormBuilder;

class AccountsForm extends FormBuilder
{
    public function form(Form $form): Form
    {
        $components = collect();

        $components->push(
            Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                ->alignCenter()
                ->collection('avatar')
                ->avatar()
                ->columnSpan(2)
                ->hiddenLabel()
                ->label(trans('account.accounts.coulmns.avatar'))
        );

        $components->push(
            Forms\Components\TextInput::make('name')
                ->label(trans('account.accounts.coulmns.name'))
                ->columnSpan(2)
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label(trans('account.accounts.coulmns.email'))
                ->required(fn (Forms\Get $get) => $get('loginBy') === 'email')
                ->email()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->label(trans('account.accounts.coulmns.phone'))
                ->required(fn (Forms\Get $get) => $get('loginBy') === 'phone')
                ->tel()
                ->maxLength(255)
        );

        $components->push(
            Forms\Components\Textarea::make('address')
                ->label(trans('account.accounts.coulmns.address'))
                ->columnSpanFull()
        );

        $components->push(
            Forms\Components\Select::make('type')
                ->label(trans('account.accounts.coulmns.type'))
                ->searchable()
                ->required()
                ->options(Type::query()->where('for', 'accounts')->where('type', 'type')->pluck('name', 'key')->toArray())
                ->default('account')
        );

        $components->push(
            Forms\Components\Toggle::make('is_active')
                ->columnSpan(2)
                ->label(trans('account.accounts.coulmns.is_active'))
                ->default(false)
                ->required()
        );

        $components = $components->merge([
            Forms\Components\Toggle::make('is_login')->default(false)
                ->columnSpan(2)
                ->label(trans('account.accounts.coulmns.is_login'))
                ->live(),
            Forms\Components\TextInput::make('password')
                ->label(trans('account.accounts.coulmns.password'))
                ->confirmed()
                ->hidden(fn (Forms\Get $get) => ! $get('is_login') || $get('id') !== null)
                ->password()
                ->maxLength(255),
            Forms\Components\TextInput::make('password_confirmation')
                ->label(trans('account.accounts.coulmns.password_confirmation'))
                ->hidden(fn (Forms\Get $get) => ! $get('is_login') || $get('id') !== null)
                ->password()
                ->maxLength(255),
        ]);

        return $form->schema($components->toArray());
    }
}
