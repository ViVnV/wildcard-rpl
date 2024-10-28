<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Traits\RedirectToIndexAfterCreate;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    use RedirectToIndexAfterCreate;

    protected static string $resource = ProductResource::class;
}
