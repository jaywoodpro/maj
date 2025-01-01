<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'اسلایدر';
    protected static ?string $pluralModelLabel = 'اسلایدر ها';
    protected static ?string $navigationGroup = 'تنظیمات صفحات';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(6)
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                Section::make('محتوای اسلایدر')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('عنوان')
                                            ->placeholder('عنوان اسلایدر')
                                            ->nullable(),
                                        Textarea::make('title')
                                            ->label('توضیحات')
                                            ->nullable(),
                                        TextInput::make('label')
                                            ->label('برچست')
                                            ->placeholder('برچسب باید انگلیسی و بدون فاصله باشد (مکان نمایش اسلایدر به این برچسب بستگی دارد)')
                                            ->required(),
                                ]),
                            ])->columnSpan(4),
                        Grid::make(2)
                            ->schema([
                                Section::make('تصویر')
                                    ->schema([
                                        FileUpload::make('image')
                                        ->label('تصویر اسلایدر')
                                        ->directory('slider')
                                        ->uploadingMessage('در حال آپلود...')
                                        ->required()
                                        ->image()
                                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                        ->maxSize(16384),
                                        TextInput::make('alt')
                                            ->label('متن جایگزین')
                                            ->nullable(),
                                    ]),
                            ])->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('تصویر')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('label')
                    ->label('برچسب')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('ایجاد')
                    ->searchable()
                    ->jalaliDateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('بروزرسانی')
                    ->searchable()
                    ->jalaliDateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
