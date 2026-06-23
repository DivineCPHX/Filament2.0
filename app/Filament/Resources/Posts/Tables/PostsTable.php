<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->label('Image')
                    ->visibility('public')
                    ->disk('public')
                    ->toggleable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                ColorColumn::make('color')
                    ->label('Color')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                // TextColumn::make('published_at')
                //     ->label('Published At')
                //     ->dateTime()
                //     ->sortable()
                //     ->searchable()
                //     ->toggleable(),
                ToggleColumn::make('published')
                    ->label('Published')
                    ->sortable()
                    ->toggleable(),
                // IconColumn::make('published')
                //     ->label('Published')
                //     ->boolean()
                //     ->sortable()
                //     ->toggleable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->label('Creation Date')
                    ->schema([
                        DatePicker::make('created_from')->label('Created From'),
                        DatePicker::make('created_until')->label('Created Until'),
                    ])
                    ->query(fn($query, $data) => $query
                        ->when($data['created_from'], fn($query, $date) => $query->whereDate('created_at', '>=', $date))
                        ->when($data['created_until'], fn($query, $date) => $query->whereDate('created_at', '<=', $date))
                    ),
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

            ])
            ->recordActions([
                // Action::make('Status')
                //     ->label('Toggle Status')
                //     ->action(fn($record) => $record->update(['is_published' => !$record->is_published]))
                //     ->icon(fn($record) => $record->is_published ? 'heroicon-o-eye' : 'heroicon-o-eye-slash'))
                //     ->color(fn($record) => $record->is_published ? 'success' : 'danger')),
                Action::make('Status')
                    ->icon(Heroicon::RocketLaunch)
                    ->schema([
                    //     Toggle::make('is_published')
                    //         ->label('Published')
                    //         ->onChange(fn($state, $record) => $record->update(['is_published' => $state]))
                    //         ->inline(false),
                        Toggle::make('published')
                            ->label('Published'),
                    ])
                    ->action(function (array $data, Post $record) {
                        $record->published = $data['published'];
                        $record->save();
                    }),

                EditAction::make(),
                DeleteAction::make(),
                ReplicateAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
