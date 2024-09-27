<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Type;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class OrderPaymentMethodChart extends ChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return trans('ecommerce.widget.payment'); // TODO: Change the autogenerated stub
    }

    protected function getData(): array
    {
        $query = Order::query()->groupBy('payment_method')->selectRaw('count(*) as count, payment_method');
        $paymentMethods = Type::query()->where('for', 'orders')
            ->where('type', 'payment_methods')
            ->get();

        return [
            'labels' => $paymentMethods->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Source',
                    'data' => $query->get()->whereIn('payment_method', $paymentMethods->pluck('key')->toArray())->pluck('count')->toArray(),
                    'backgroundColor' => $paymentMethods->pluck('color')->toArray(),
                    'hoverOffset' => 4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
