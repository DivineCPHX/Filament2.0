<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Product Info')
                            ->icon(Heroicon::InformationCircle)
                            ->badge('New')
                            ->schema([
                                TextEntry::make('id')->label('Product ID')->weight('bold')->color('success'),
                                TextEntry::make('name')->label('Product Name')->weight('bold')->color('primary'),
                                TextEntry::make('sku')->label('SKU'),
                                TextEntry::make('description')->label('Description')->weight('bold')->color('primary'),
                                TextEntry::make('created_at')->label('Product Creation Date')->dateTime()->color('info'),
                        ]),

                        Tab::make('Pricing & Stock')
                            ->icon(Heroicon::CurrencyDollar)
                            ->badge('New')
                            ->schema([
                                TextEntry::make('price')->label('Price')->money('USD')->icon(Heroicon::CurrencyDollar)->color('success'),
                                TextEntry::make('stock')->label('Stock'),
                        ]),

                        Tab::make('Media & Status')
                            ->icon(Heroicon::Photo)
                            ->badge('New')
                            ->schema([
                                ImageEntry::make('image')->label('Image')->disk('public')->visibility('public')->square(),
                                IconEntry::make('is_active')->label('Is Active?')->boolean(),
                                IconEntry::make('is_featured')->label('Is Featured?')->boolean(),
                        ]),
                ])->columnSpanfull()->vertical(),
        ]);
    }
}
