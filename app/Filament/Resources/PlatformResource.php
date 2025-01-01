<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlatformResource\Pages;
use App\Filament\Resources\PlatformResource\RelationManagers;
use App\Models\Platform;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlatformResource extends Resource
{
    protected static ?string $model = Platform::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'پلتفرم';
    protected static ?string $pluralModelLabel = 'پلتفرم‌ها';
    protected static ?string $navigationGroup = 'محصولات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(6)
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                Section::make('محتوای اصلی')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('عنوان')
                                                    ->placeholder('عنوان پلتفرم')
                                                    ->required(),
                                                TextInput::make('slug')
                                                    ->label('نامک')
                                                    ->placeholder('آدرس نمایشی (انگلیسی و فاصله‌ها با -)')
                                                    ->unique(ignoreRecord: true)
                                                    ->required(),
                                            ]),
                                        TagsInput::make('tags')
                                            ->label('برچسب ها')
                                            ->nullable(),
                                        TiptapEditor::make('description')
                                            ->label('توضیحات (کامل)')
                                            ->extraInputAttributes(['style' => 'min-height: 64rem;'])
                                            ->output(TiptapOutput::Html)
                                            ->required(),
                                    ]),
                            ])
                            ->columnSpan(4),
                        Grid::make(2)
                            ->schema([
                                Section::make('نمای پلتفرم')
                                    ->schema([
                                        FileUpload::make('thumbnail')
                                            ->label('تصویر شاخص (ابعاد مربعی)')
                                            ->directory('platform/thumbnail')
                                            ->uploadingMessage('در حال آپلود...')
                                            ->required()
                                            ->image()
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                            ->maxSize(16384)
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ]),
                                    ]),
                                Section::make('پیشرفته')
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('فعال بودن')
                                            ->default(true),
                                        TextInput::make('youtube_link')
                                            ->label('لینک یوتیوب')
                                            ->nullable()
                                            ->url(),
                                        TextInput::make('aparat_link')
                                            ->label('لینک آپارات')
                                            ->nullable()
                                            ->url(),
                                        Repeater::make('related_links')
                                            ->label('لینک های مرتبط')
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('title')
                                                            ->label('عنوان')
                                                            ->required(),
                                                        TextInput::make('url')
                                                            ->url()
                                                            ->label('نشانی')
                                                            ->required(),
                                                    ]),
                                            ])
                                            ->minItems(0)
                                            ->maxItems(10)
                                            ->default([]),
                                    ]),
                                Section::make('اطلاعات متا')
                                    ->schema([
                                        Fieldset::make('اطلاعات سئو')
                                            ->schema([
                                                TextInput::make('seo.title')->label('عنوان')->nullable(),
                                                Textarea::make('seo.description')->label('توضیحات')->nullable(),
                                                FileUpload::make('seo.image')
                                                    ->label('تصویر')
                                                    ->nullable()
                                                    ->directory('seo-meta')
                                                    ->image()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                                    ->maxSize(16384),
                                                TextInput::make('seo.author')->label('نویسنده')->nullable(),
                                                TextInput::make('seo.robots')->label('دستورات Robots')->nullable(),
                                                TextInput::make('seo.canonical_url')->label('لینک Canonical')->nullable(),
                                                TagsInput::make('seo.keywords')->label('کلمات کلیدی')->nullable(),
                                            ])->columns(1),
                                        Fieldset::make('سئو شبکه‌های اجتماعی')
                                            ->schema([
                                                TextInput::make('seo.facebook_title')->label('عنوان فیسبوک')->nullable(),
                                                Textarea::make('seo.facebook_description')->label('توضیحات فیسبوک')->nullable(),
                                                FileUpload::make('seo.facebook_image')->label('تصویر فیسبوک')
                                                    ->nullable()
                                                    ->directory('seo-meta')
                                                    ->image()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                                    ->maxSize(16384),
                                                TextInput::make('seo.twitter_title')->label('عنوان توییتر')->nullable(),
                                                Textarea::make('seo.twitter_description')->label('توضیحات توییتر')->nullable(),
                                                FileUpload::make('seo.twitter_image')->label('تصویر توییتر')
                                                    ->nullable()
                                                    ->directory('seo-meta')
                                                    ->image()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                                    ->maxSize(16384),
                                                TextInput::make('seo.open_graph_title')->label('عنوان Open Graph')->nullable(),
                                                Textarea::make('seo.open_graph_description')->label('توضیحات Open Graph')->nullable(),
                                                FileUpload::make('seo.open_graph_image')->label('تصویر Open Graph')
                                                    ->nullable()
                                                    ->directory('seo-meta')
                                                    ->image()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml']) // فرمت‌های مجاز
                                                    ->maxSize(16384),
                                            ])->columns(1),
                                        Fieldset::make('داده‌های ساختاریافته')
                                            ->schema([
                                                TextInput::make('seo.schema_type')->label('نوع Schema')->nullable(),
                                                Textarea::make('seo.schema_data')->label('داده‌های Schema')->nullable(),
                                            ])->columns(1),
                                        Fieldset::make('اطلاعات پیشرفته')
                                            ->schema([
                                                TextInput::make('seo.priority')->label('اولویت')->nullable(),
                                                Toggle::make('seo.sitemap_include')->label('نمایش در نقشه سایت')->default(true),
                                                TextInput::make('seo.sitemap_priority')->label('اولویت نقشه سایت')->nullable(),
                                                TextInput::make('seo.sitemap_changefreq')->label('فرکانس تغییر نقشه سایت')->nullable(),
                                            ])->columns(1),
                                    ]),
                            ])
                            ->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->withCount(['tradingBots', 'indicators']);
            })
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('تصویر شاخص')
                    ->circular()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('نامک')
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('فعال بودن')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->sortable()
                    ->alignCenter()
                    ->jalaliDateTime(),
                /*Tables\Columns\TextColumn::make('tradingBots_count')
                    ->label('ربات‌ها')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('indicators_count')
                    ->label('اندیکاتورها')
                    ->alignCenter(),*/
                Tables\Columns\TextColumn::make('trading_bots_count')
                    ->label('ربات‌ها')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        return $record->tradingBots()->count(); // کوئری مستقیم برای شمارش
                    }),
                Tables\Columns\TextColumn::make('indicators_count')
                    ->label('اندیکاتورها')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        return $record->indicators()->count(); // کوئری مستقیم برای شمارش
                    })
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlatforms::route('/'),
            'create' => Pages\CreatePlatform::route('/create'),
            'edit' => Pages\EditPlatform::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active',true)->count();
    }
}
