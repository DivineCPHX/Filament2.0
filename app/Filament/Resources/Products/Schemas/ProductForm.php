<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon(Heroicon::InformationCircle)
                        ->description('Fill in all the fields')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Product Name')
                                        ->required(),
                                    TextInput::make('sku')
                                    ->label('SKU')
                                    ->unique()
                                    ->required(),
                                ])->columns(2),
                            MarkdownEditor::make('description')
                                ->label('Description')
                                ->required(),
                        ]),
                    Step::make('Pricing & Stock')
                        ->icon(Heroicon::CurrencyDollar)
                        ->description('Set the price and stock information')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('price')
                                        ->label('Price')
                                        ->numeric()
                                        ->required(),
                                    TextInput::make('sale_price')
                                        ->label('Sale Price')
                                        ->numeric(),
                                ])->columns(2),
                        ]),
                    Step::make('Media & Status')
                        ->icon(Heroicon::Photo)
                        ->description('Upload product images and set status')
                        ->schema([
                            Group::make()
                                ->schema([
                                    FileUpload::make('image')
                                        ->disk('public')
                                        ->directory('posts')
                                        ->label('Product Image')
                                        ->required(),
                                ])->columns(2),
                                Toggle::make('is_active')
                                        ->label('Active')
                                        ->default(true),
                                Toggle::make('is_featured')
                                        ->label('Featured')
                                        ->default(false),

                        ]),
                ])->columnSpanFull()
                ->skippable()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save'),
                ),
            ]);
    }
}
