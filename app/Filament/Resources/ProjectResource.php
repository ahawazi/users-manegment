<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\project;
use App\Models\User;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $navigationGroup = "projects";
    protected static ?string $model = project::class;
    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('project_manager_id')
                    ->label('project Manager')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('project_leader_id')
                    ->label('project Leader')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('projectManager.name')
                    ->label('project Manager'),

                TextColumn::make('projectLeader.name')
                    ->label('project Leader'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->jalaliDateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                    Action::make('raw_materials')
                        ->label('Raw Materials')
                        ->url(fn($record) => url('/admin/raw-materials/create?project_name=' . $record->name))
                        ->icon('heroicon-o-arrow-right')
                        ->color('primary'),

                ]),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
