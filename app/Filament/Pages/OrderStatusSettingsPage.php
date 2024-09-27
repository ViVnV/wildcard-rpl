<?php

namespace App\Filament\Pages;

use App\Components\TypeColumn;
use App\Models\Type;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use TomatoPHP\FilamentIcons\Components\IconPicker;

class OrderStatusSettingsPage extends Page implements HasTable
{
    use InteractsWithTable;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected ?string $status = null;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'settings.status';

    public array $data = [];

    public function mount(): void
    {
        $types = [
            [
                'name' => [
                    'en' => 'Pending',
                    'ar' => 'قيد الانتظار',
                ],
                'key' => 'pending',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Prepared',
                    'ar' => 'تم التحضير',
                ],
                'key' => 'prepared',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Withdrew',
                    'ar' => 'تم السحب',
                ],
                'key' => 'withdrew',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Shipped',
                    'ar' => 'تم الشحن',
                ],
                'key' => 'shipped',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Delivered',
                    'ar' => 'تم التوصيل',
                ],
                'key' => 'delivered',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Part Delivered',
                    'ar' => 'تم التوصيل جزئياً',
                ],
                'key' => 'part-delivered',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Cancelled',
                    'ar' => 'تم الإلغاء',
                ],
                'key' => 'cancelled',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Refunded',
                    'ar' => 'تم الاسترجاع',
                ],
                'key' => 'refunded',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Done',
                    'ar' => 'تم الانتهاء',
                ],
                'key' => 'done',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
            [
                'name' => [
                    'en' => 'Paid',
                    'ar' => 'تم الدفع',
                ],
                'key' => 'paid',
                'icon' => 'heroicon-o-clock',
                'color' => 'danger',
            ],
        ];

        foreach ($types as $type) {
            $exists = Type::query()
                ->where('for', 'orders')
                ->where('type', 'status')
                ->where('key', $type['key'])
                ->first();
            if (! $exists) {
                $type['for'] = 'orders';
                $type['type'] = 'status';
                $exists = Type::create($type);
            }
        }
    }

    protected function getHeaderActions(): array
    {
        $tenant = Filament::getTenant();
        if ($tenant) {
            return [
                Action::make('back')->action(fn () => redirect()->route('filament.'.filament()->getCurrentPanel()->getId().'.pages.settings-hub', $tenant))->color('danger')->label(trans('filament-settings-hub::messages.back')),
            ];
        }

        return [
            Action::make('back')->action(fn () => redirect()->route('filament.'.filament()->getCurrentPanel()->getId().'.pages.settings-hub'))->color('danger')->label(trans('filament-settings-hub::messages.back')),
        ];

    }

    public function getTitle(): string
    {
        return trans('ecommerce.settings.status.title');
    }

    public function table(Table $table): Table
    {
        $localsTitle = [];
        foreach (config('filament-menus.locals') as $key => $local) {
            $localsTitle[] = TextInput::make($key)
                ->label($local[app()->getLocale()])
                ->required();
        }

        return $table->query(Type::query()->where('for', 'orders')->where('type', 'status'))
            ->paginated(false)
            ->columns([
                TypeColumn::make('key')
                    ->label(trans('ecommerce.settings.status.columns.status')),
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('edit')
                    ->label(trans('ecommerce.settings.status.action.edit'))
                    ->tooltip(trans('ecommerce.settings.status.action.edit'))
                    ->form([
                        KeyValue::make('name')
                            ->schema($localsTitle)
                            ->keyLabel(trans('ecommerce.settings.status.columns.language'))
                            ->editableKeys(false)
                            ->addable(false)
                            ->deletable(false)
                            ->label(trans('ecommerce.settings.status.columns.value')),
                        IconPicker::make('icon')->label(trans('ecommerce.settings.status.columns.icon')),
                        ColorPicker::make('color')->label(trans('ecommerce.settings.status.columns.color')),
                    ])
                    ->fillForm(fn ($record) => $record->toArray())
                    ->icon('heroicon-s-pencil-square')
                    ->iconButton()
                    ->action(function (array $data, Type $type) {
                        $type->update($data);
                        Notification::make()
                            ->title(trans('ecommerce.settings.status.action.notification'))
                            ->success()
                            ->send();
                    }),
            ]);
    }
}