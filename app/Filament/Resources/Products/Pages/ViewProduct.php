<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }


    // public static function getInfolist(Infolist $infolist): Infolist
    // public static function configure(Schema $schema): Schema
    // {
    // return $schema
    //     ->components([
    //         Section::make('Product Info')
    //             ->schema([])
    //     ]);

    // }
}
