<?php

namespace App\Filament\Manager\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id'),
                TextInput::make('name'),
                TextInput::make('email'),
            ]);
    }
}
