<?php

declare(strict_types=1);

namespace Softok2\FilamentPageBuilder\Resources;

use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Softok2\FilamentPageBuilder\Form\Components\Fields\ImageUpload;
use Softok2\FilamentPageBuilder\Models\Post;
use Softok2\FilamentPageBuilder\Resources\PostResource\Pages\CreatePost;
use Softok2\FilamentPageBuilder\Resources\PostResource\Pages\EditPost;
use Softok2\FilamentPageBuilder\Resources\PostResource\Pages\ListPosts;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static string $fileUploadDirectory = 'uploads/posts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                PageResource::getMetadataForm(),

                Forms\Components\Fieldset::make(__('Blog'))->schema(
                    [
                        Split::make([
                            Section::make([
                                TextInput::make('title_es')
                                    ->label(__('Title', ['locale' => '(es)']))
                                    ->required(),
                                TextInput::make('title_en')
                                    ->label(__('Title', ['locale' => '(en)'])),
                                TinyEditor::make('body_es')
                                    ->simple()
                                    ->showMenuBar()
                                    ->label(__('Content', ['locale' => '(es)']))
                                    ->fileAttachmentsDirectory(self::$fileUploadDirectory)
                                    ->fileAttachmentsVisibility('private')
                                    ->required()
                                    ->columnSpanFull(),
                                TinyEditor::make('body_en')
                                    ->simple()
                                    ->showMenuBar()
                                    ->label(__('Content', ['locale' => '(en)']))
                                    ->fileAttachmentsDirectory(self::$fileUploadDirectory)
                                    ->fileAttachmentsVisibility('private')
                                    ->required()
                                    ->columnSpanFull(),

                            ])->columns(),
                            Section::make([
                                ImageUpload::make(name: 'cover_image')
                                    ->directory(self::$fileUploadDirectory)
                                    ->label(__('Cover Image'))
                                    ->render()
                                    ->columnSpanFull(),
                            ])->grow(false),
                        ])->from('md')
                            ->columnSpanFull(),
                    ]
                ),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image.0.path')
                    ->square()
                    ->size(50)
                    ->label(__('Image')),
                Tables\Columns\TextColumn::make(app()->getLocale() === 'es' ? 'title_es' : 'title_en')
                    ->label(__('Title', ['locale' => '']))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('Created at'))
                    ->badge()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Post');
    }
}
