<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('results')
                ->required(),

                Forms\Components\Select::make('product_manager')
                ->label('Product Manager')
                ->relationship('productManager', 'name')
                ->options(User::role('product_manager')->pluck('name', 'id'))
                ->searchable()
                ->required(),

            Forms\Components\Select::make('product_leader')
                ->label('Product Leader')
                ->relationship('productLeader', 'name')
                ->options(User::role('product_leader')->pluck('name', 'id'))
                ->searchable()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('results'),
                Tables\Columns\TextColumn::make('productManager.name')->label('Product Manager'),
                Tables\Columns\TextColumn::make('productLeader.name')->label('Product Leader'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function canUpdate($record): bool
    {
        return auth()->user()->hasRole('admin');
    }

    public static function canView($record): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'product_manager', 'product_leader']);
    }

}
