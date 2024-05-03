<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources;

use App\Filament\Resources\CustomServiceResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Softok2\FilamentPageBuilder\Form\Components\Fields\ImageUpload;
use Softok2\FilamentPageBuilder\Models\CustomService;

class CustomServiceResource extends Resource
{
    protected static ?string $model = CustomService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_es')
                    ->label(__('Name', ['locale' => '(es)']))
                    ->required(),
                Forms\Components\TextInput::make('name_en')
                    ->label(__('Name', ['locale' => '(en)']))
                    ->required(),
                ImageUpload::make()
                    ->directory('uploads/custom_services')
                    ->render()
                    ->label(__('Image'))->columnSpanFull(),
                Forms\Components\Textarea::make('description_es')
                    ->label(__('Description', ['locale' => '(es)'])),
                Forms\Components\Textarea::make('description_en')
                    ->label(__('Description', ['locale' => '(en)'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('image.0.path')
                        ->square()
                        ->width('200px')
                        ->height('100px')
                        ->label(__('Image')),
                    Tables\Columns\TextColumn::make(app()->getLocale() === 'es' ? 'name_es' : 'name_en')
                        ->label(__('Title', ['locale' => '']))
                        ->searchable()
                        ->sortable()
                        ->description(fn(
                            CustomService $record
                        ): ?string => app()->getLocale() === 'es' ? $record->description_es : $record->description_en),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => \Softok2\FilamentPageBuilder\Resources\CustomServiceResource\Pages\ManageCustomServices::route('/'),
        ];
    }

    public static function getModelLabel(): string
    {
        return trans_choice('Custom Services', 1);
    }

    public static function getPluralModelLabel(): string
    {
        return trans_choice('Custom Services', 2);
    }
}
