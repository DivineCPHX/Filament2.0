<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Icons\Heroicon;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
        }

    protected function getCreatedNotificationMessage(): ?string
    {
        return "To the moon.";
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->title("User created.")
        ->body("User was created successfully.")
        ->icon(Heroicon::AcademicCap)
        ->success()
        ->send();
    }

}
