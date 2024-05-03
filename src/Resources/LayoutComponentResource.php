<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Softok2\FilamentPageBuilder\Models\LayoutComponent;
use Softok2\FilamentPageBuilder\Resources\LayoutComponentResource\Pages\EditComponentLayout;
use Softok2\FilamentPageBuilder\Resources\LayoutComponentResource\Pages\ListLayoutComponents;

class LayoutComponentResource extends Resource
{
    protected static ?string $model = LayoutComponent::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?int $navigationSort = 10;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->statePath('content')
                    ->schema($form->getRecord()->resourceFormSchema())
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->badge()
                        ->formatStateUsing(fn ($state) => ucfirst($state))
                        ->searchable(),
                ]),
            ])->contentGrid([
                'md' => 2,
                'lg' => 3,
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

    public static function getPages(): array
    {
        return [
            'index' => ListLayoutComponents::route('/'),
            'edit' => EditComponentLayout::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return trans_choice('filament-page-builder::page-builder.layouts-components', 1);
    }

    public static function getNavigationLabel(): string
    {
        return trans('filament-page-builder::page-builder.layouts-components');
    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-page-builder::page-builder.pages_and_layouts');
    }
}
