<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Softok2\FilamentPageBuilder\Forms\Components\ImageUpload;
use Softok2\FilamentPageBuilder\Forms\Components\Text;
use Softok2\FilamentPageBuilder\Models\Page;
use Softok2\FilamentPageBuilder\Resources\PageResource\Pages\EditPage;
use Softok2\FilamentPageBuilder\Resources\PageResource\Pages\ListPages;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                self::getMetadataForm(),
                Forms\Components\Section::make(__('Title'))
                    ->compact()
                    ->columns()
                    ->collapsible()
                    ->schema([
                        Text::make('title')
                            ->columnSpanFull()
                            ->label(''),
                    ]),

                Forms\Components\Section::make(__('Content'))
                    ->compact()
                    ->collapsible()
                    ->schema([
                        Forms\Components\Builder::make('content')
                            ->hiddenLabel()
                            ->addActionLabel(__('Add Content'))
                            ->blocks($form->getRecord()->block()->sections())->columnSpanFull()
                            ->maxItems($form->getRecord()->block()->getMaxItems())
                            ->blockNumbers(false)
                            ->collapsible(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make(app()->getLocale() === 'es' ? 'title.es' : 'title.en')
                        ->badge()
                        ->searchable(),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
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
            'index' => ListPages::route('/'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return trans_choice('filament-page-builder::page-builder.page', 1);
    }

    public static function getMetadataForm()
    {
        return Forms\Components\Section::make(__('Metadata'))
            ->collapsed()
            ->compact()
            ->collapsible()
            ->statePath('meta')
            ->columns()
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Fieldset::make('title')
                        ->statePath('title')
                        ->schema([
                            TextInput::make('es')
                                ->label('Es')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('en')->label('En')
                                ->maxLength(255),
                        ]),
                ]),
                Forms\Components\Group::make([
                    Forms\Components\Fieldset::make('keywords')
                        ->statePath('keywords')
                        ->schema([
                            Forms\Components\TagsInput::make('es')
                                ->label('Es'),
                            Forms\Components\TagsInput::make('en')->label('En'),
                        ]),
                ]),
                ImageUpload::make('image')->columnSpanFull(),
            ]);

    }

    public static function getNavigationGroup(): ?string
    {
        return trans('filament-page-builder::page-builder.pages_and_layouts');
    }
}
