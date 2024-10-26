<?php

namespace App\Filament\Resources\RawMaterialsResource\Pages;

use App\Filament\Resources\RawMaterialsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRawMaterials extends ListRecords
{
    protected static string $resource = RawMaterialsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
