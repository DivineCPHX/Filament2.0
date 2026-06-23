<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCounterWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count()),
            Stat::make('Total users from Nigeria', User::whereHas('country', fn ($q) => $q->where('name', 'Nigeria'))->count()),
            Stat::make('Total users from United States', User::whereHas('country', fn ($q) => $q->where('name', 'United States'))->count()),

        ];
    }
}
