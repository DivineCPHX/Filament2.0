<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Fields')
                    ->description('Basic information about the post. Fill in all fields')
                    ->icon(Heroicon::RocketLaunch)
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('title')
                                    ->rules('required|min:3|max:255')
                                    ->unique()
                                    ->label('Title')
                                    ->required(),
                                TextInput::make('slug')
                                    ->unique()
                                    ->label('Slug')
                                    ->required(),
                                ColorPicker::make('color')
                                    ->label('Color'),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    // ->searchable()
                                    ->required(),
                        ])->columns(2),
                        MarkdownEditor::make('body')
                            ->label('Body')
                            ->required(),
                ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Image Upload')
                            ->description('Attach your images here. You can upload multiple images if needed.')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Image')
                                    ->disk('public')
                                    ->directory('posts')
                                    ->image(),
                            ]),

                        Section::make('Meta')
                            ->description('Enter addtional information.')
                            ->icon(Heroicon::InformationCircle)
                            ->schema([
                                Select::make('tags')
                                    ->label('Tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->separator(','),
                                Toggle::make('published')
                                    ->label('Published'),
                                DateTimePicker::make('published_at')
                                    ->label('Published At'),
                            ]),
                ])->columnSpan(1),

            ])->columns(3);
    }
}
