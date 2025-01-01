<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialResource\Pages;
use App\Filament\Resources\SocialResource\RelationManagers;
use App\Models\Social;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialResource extends Resource
{
    protected static ?string $model = Social::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'شبکه اجتماعی';
    protected static ?string $pluralModelLabel = 'شبکه های اجتماعی';
    protected static ?string $navigationGroup = 'تنظیمات صفحات';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('عنوان')
                                    ->required(),
                                Toggle::make('is_active')
                                    ->label('فعال است؟')
                                    ->default(true),
                            ]),
                        Textarea::make('sort_description')
                            ->label('توضیحات کوتاه')
                            ->rows(3),
                        FileUpload::make('logo')
                            ->label('لوگو')
                            ->directory('social')
                            ->uploadingMessage('در حال آپلود...')
                            ->required()
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                            ->maxSize(16384)
                            ->imageEditorAspectRatios([
                                '1:1',
                            ]),
                        TextInput::make('link')
                            ->label('لینک')
                            ->url()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')->label('لوگو'),
                TextColumn::make('title')->label('عنوان')->searchable(),
                TextColumn::make('sort_description')->label('توضیحات کوتاه')->limit(50),
                TextColumn::make('link')->label('لینک')->url(fn ($record) => $record->link),
                ToggleColumn::make('is_active')->label('فعال است؟'),
                TextColumn::make('created_at')->label('تاریخ ایجاد')->date(),
            ])
            ->filters([
                Filter::make('is_active')
                    ->label('فقط فعال‌ها')
                    ->query(fn ($query) => $query->where('is_active', true)),
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
            'index' => Pages\ListSocials::route('/'),
            'create' => Pages\CreateSocial::route('/create'),
            'edit' => Pages\EditSocial::route('/{record}/edit'),
        ];
    }
}
