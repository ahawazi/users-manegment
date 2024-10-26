<?php

namespace App\Filament\Resources\RawMaterialsResource\Pages;

use App\Filament\Resources\RawMaterialsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRawMaterials extends EditRecord
{
    protected static string $resource = RawMaterialsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
