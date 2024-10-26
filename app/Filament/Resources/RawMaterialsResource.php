<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RawMaterialsResource\Pages;
use App\Models\Commodity;
use App\Models\RawMaterials;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RawMaterialsResource extends Resource
{
    protected static ?string $model = RawMaterials::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';
    protected static ?string $navigationLabel = 'Raw Materials';
    protected static ?string $navigationGroup = 'projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('size')
                    ->label('Size')
                    ->numeric()
                    ->required(),

                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('project_name')
                    ->label('Project')
                    ->default(request()->query('project_name'))
                    //todo user can't be change this
                    // ->disabled()
                    ->required(),

                Select::make('commoditie_id')
                    ->label('Commodity')
                    ->options(Commodity::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('size')
                    ->label('Size')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('project_name')
                    ->label('Project')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('commodity.name')
                    ->label('Commodity')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRawMaterials::route('/'),
            'create' => Pages\CreateRawMaterials::route('/create'),
            'edit' => Pages\EditRawMaterials::route('/{record}/edit'),
        ];
    }
}
