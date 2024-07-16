<?php

namespace App\Filament\Resources\SousMenuResource\Pages;

use App\Filament\Resources\SousMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSousMenus extends ListRecords
{
    protected static string $resource = SousMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
