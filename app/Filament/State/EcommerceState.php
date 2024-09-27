<?php

namespace App\Filament\State;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Contracts\View\View;

class EcommerceState extends Stat
{
    public function render(): View
    {
        return view('widgets.state', $this->data());
    }
}
