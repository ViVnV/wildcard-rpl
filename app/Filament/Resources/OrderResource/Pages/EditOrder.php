<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\OrderLog;
use App\Models\OrdersItem;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print')
                ->icon('heroicon-o-printer')
                ->label(trans('ecommerce.orders.actions.print'))
                ->openUrlInNewTab()
                ->url(route('order.print', $this->getRecord()->id)),
            Actions\DeleteAction::make()->icon('heroicon-o-trash'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['items'] = $this->getRecord()->ordersItems->toArray();

        return parent::mutateFormDataBeforeFill($data); // TODO: Change the autogenerated stub
    }

    public function afterSave()
    {
        $record = $this->getRecord();
        $data = $this->form->getState();

        $vat = 0;
        $discount = 0;
        $total = 0;
        foreach ($data['items'] as $item) {
            $getProduct = Product::find($item['product_id']);
            $getDiscount = 0;
            if ($getProduct->discount_to && Carbon::parse($getProduct->discount_to)->isFuture()) {
                $getDiscount = $getProduct->discount;
            }

            if (isset($item['id'])) {
                $getItemByID = OrdersItem::find($item['id']);
                $getItemByID->update([
                    'account_id' => $record->account_id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $getProduct->price,
                    'vat' => $getProduct->vat,
                    'discount' => $getDiscount,
                    'total' => (($getProduct->price + $getProduct->vat) - $getDiscount) * $item['qty'],
                ]);
            } else {
                $record->ordersItems()->create([
                    'account_id' => $record->account_id,
                    'product_id' => $item['product_id'],
                    'qty' => $item['qty'],
                    'price' => $getProduct->price,
                    'vat' => $getProduct->vat,
                    'discount' => $getDiscount,
                    'total' => ((($getProduct->price + $getProduct->vat) - $getDiscount) * $item['qty']),
                ]);
            }

            $vat += ($getProduct->vat * $item['qty']);
            $discount += $getDiscount;
            $total += ((($getProduct->price + $getProduct->vat) - $getDiscount) * $item['qty']);
        }

        $record->user_id = auth()->user()->id;
        $record->vat = $vat;
        $record->discount = $discount;
        $record->total = $total + $record->shipping;
        $record->save();

        $orderLog = new OrderLog;
        $orderLog->user_id = auth()->user()->id;
        $orderLog->order_id = $record->id;
        $orderLog->status = $record->status;
        $orderLog->is_closed = 1;
        $orderLog->note = 'Order update by '.auth()->user()->name.' and Total: '.number_format($record->total, 2);
        $orderLog->save();
    }
}