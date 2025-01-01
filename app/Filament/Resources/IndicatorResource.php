<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndicatorResource\Pages;
use App\Filament\Resources\IndicatorResource\RelationManagers;
use App\Models\Platform;
use App\Models\Product\Indicator;
use App\Models\Product\SKU;
use App\Models\Product\TradingBot;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class IndicatorResource extends Resource
{
    protected static ?string $model = Indicator::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'اندیکاتور';
    protected static ?string $pluralModelLabel = 'اندیکاتور ها';
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
                                        Grid::make()
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('عنوان')
                                                    ->unique(ignoreRecord: true)
                                                    ->placeholder('عنوان اصلی پلتفرم فاقد توضیحات اضافه')
                                                    ->required(),
                                                TextInput::make('slug')
                                                    ->unique(ignoreRecord: true)
                                                    ->label('نامک')
                                                    ->placeholder('آدرس نمایشی این محتوا در مورد گر (انگلیسی و فاصله ها با استفاده از ( - )')
                                                    ->required(),
                                                Select::make('label_id')
                                                    ->label('لیبل اندیکاتور')
                                                    ->relationship('label', 'title')
                                                    ->required()
                                                    ->searchable(),
                                            ])->columns(3),
                                        Select::make('strategies')
                                            ->label('انتخاب استراتژی‌ها')
                                            ->relationship('strategies', 'title')
                                            ->multiple()
                                            ->searchable()
                                            ->nullable(),
                                        TagsInput::make('tags')
                                            ->label('برچسب ها')
                                            ->nullable(),
                                        TiptapEditor::make('description')
                                            ->label('توضیحات (کامل)')
                                            ->extraInputAttributes(['style' => 'min-height: 36rem;'])
                                            ->output(TiptapOutput::Html)
                                            ->required(),
                                        TiptapEditor::make('short_description')
                                            ->label('توضیحات (کوتاه)')
                                            ->extraInputAttributes(['style' => 'min-height: 18rem;'])
                                            ->output(TiptapOutput::Html)
                                            ->required(),
                                    ]),
                                Section::make('نسخه ها و فایل ها')
                                    ->schema([
                                        Repeater::make('platforms')
                                            ->label('پلتفرم‌ها')
                                            ->schema([
                                                Grid::make()
                                                    ->schema([
                                                        Select::make('platform_id')
                                                            ->label('عنوان پلتفرم')
                                                            ->options(function () {
                                                                return Platform::where('is_active', true)->pluck('title', 'id');
                                                            })
                                                            ->required(),
                                                        TextInput::make('version')
                                                            ->label('نسخه')
                                                            ->placeholder('عنوان اصلی پلتفرم فاقد توضیحات اضافه')
                                                            ->required(),
                                                    ])->columns(2),
                                                TiptapEditor::make('changelog')
                                                    ->label('تغییرات نسخه ها')
                                                    ->extraInputAttributes(['style' => 'min-height: 12rem;'])
                                                    ->output(TiptapOutput::Html)
                                                    ->required(),
                                                FileUpload::make('main_file')
                                                    ->label('فایل اصلی')
                                                    ->directory('platforms/main_files')
                                                    ->nullable()
                                                    ->acceptedFileTypes([
                                                        "application/zip",
                                                        "application/x-compressed",
                                                        "application/x-zip-compressed",
                                                        "application/zip",
                                                        "multipart/x-zip",
                                                    ]),
                                                FileUpload::make('demo_file')
                                                    ->label('فایل دمو')
                                                    ->directory('platforms/demo_files')
                                                    ->nullable()
                                                    ->acceptedFileTypes([
                                                        "application/zip",
                                                        "application/x-compressed",
                                                        "application/x-zip-compressed",
                                                        "application/zip",
                                                        "multipart/x-zip",
                                                    ]),
                                            ])
                                            ->default([])
                                            ->minItems(1)
                                            ->maxItems(Platform::all()->count())
                                    ])
                                //),
                            ])->columnSpan(4),
                        Grid::make(2)
                            ->schema([
                                Section::make('نمای اندیکاتور')
                                    ->schema([
                                        FileUpload::make('catalog_file')
                                            ->label('بارگذاری کاتالوگ PDF')
                                            ->directory('indicator/catalogs')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->maxSize(30720)
                                            ->uploadingMessage('در حال آپلود...')
                                            ->required(),
                                        FileUpload::make('thumbnail')
                                            ->label('تصویر شاخص (ابعاد مربعی)')
                                            ->directory('indicator/thumbnail')
                                            ->uploadingMessage('در حال آپلود...')
                                            ->required()
                                            ->image()
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                            ->maxSize(16384)
                                            ->imageEditorAspectRatios([
                                                '1:1',
                                            ]),
                                        Repeater::make('gallery')
                                            ->label('گالری تصاویر')
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('عنوان')
                                                    ->required(),
                                                FileUpload::make('image')
                                                    ->label('تصویر')
                                                    ->directory('indicator/gallery')
                                                    ->image()
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg', 'image/png', 'image/svg+xml'])
                                                    ->maxSize(16384)
                                                    ->imageEditorAspectRatios([
                                                        '1:1',
                                                    ]),
                                            ])
                                            ->minItems(0)
                                            ->maxItems(10)
                                            ->default([]),
                                    ]),
                                Section::make('تعرفه ها')
                                    ->schema([
                                        TextInput::make('price')
                                            ->label('قیمت')
                                            ->numeric()
                                            ->required()
                                            ->suffix('تومان (IRT)'),
                                        TextInput::make('discount_price')
                                            ->label('قیمت با تخفیف')
                                            ->numeric()
                                            ->required()
                                            ->suffix('تومان (IRT)'),
                                    ]),
                                Section::make('پیشرفته')
                                    ->schema([
                                        Select::make('user_id')
                                            ->label('نویسنده محتوا')
                                            ->placeholder('یک کاربر را انتخاب کنید')
                                            ->relationship('author', 'name')
                                            ->options(function () {
                                                return \App\Models\User::query()
                                                    ->whereHas('roles', function ($query) {
                                                        $query->whereIn('name', ['admin', 'super_admin', 'vendor']);
                                                    })
                                                    ->pluck('name', 'id');
                                            })
                                            ->default(Auth::id())
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                        TextInput::make('sku')
                                            ->label('کد SKU')
                                            ->required()
                                            ->rule(function (callable $get) {
                                                return function ($attribute, $value, $fail) use ($get) {
                                                    $recordId = $get('id');
                                                    $exists = SKU::where('sku', $value)
                                                        ->where(function ($query) use ($recordId) {
                                                            $query->where('model_id', '!=', $recordId)
                                                                ->where('model_type', Indicator::class);
                                                        })
                                                        ->exists();
                                                    if ($exists) {
                                                        $fail('کد SKU وارد شده قبلاً استفاده شده است.');
                                                    }
                                                };
                                            }),
                                        Toggle::make('is_best_offer')
                                            ->label('پیشنهاد ویژه')
                                            ->default(false),
                                        Toggle::make('is_international')
                                            ->label('محصول بین المللی')
                                            ->default(true),
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
                                        Fieldset::make('اطلاعات محصول')
                                            ->schema([
                                                TextInput::make('seo.price')->label('قیمت')->numeric()->nullable(),
                                                TextInput::make('seo.sale_price')->label('قیمت فروش')->numeric()->nullable(),
                                                TextInput::make('seo.currency')->label('واحد پول')->default("IRT")->nullable()->placeholder('پیشفرض: IRT'),
                                                TextInput::make('seo.availability')->label('وضعیت موجودی')->nullable(),
                                                TextInput::make('seo.sku')->label('کد محصول')->nullable(),
                                                TextInput::make('seo.product_condition')->label('شرایط محصول')->nullable(),
                                            ])->columns(1),
                                    ]),
                            ])->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('نامک')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label.title')
                    ->label('لیبل')
                    ->searchable()
                    ->sortable(),

                /*Tables\Columns\TextColumn::make('author.name')
                    ->label('نویسنده')
                    ->sortable(),*/

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('فعال بودن')
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_best_offer')
                    ->label('پیشنهاد ویژه')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت (تومان)')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state)),

                Tables\Columns\TextColumn::make('discount_price')
                    ->label('قیمت با تخفیف (تومان)')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable()
                    ->jalaliDateTime(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('آخرین به‌روزرسانی')
                    ->dateTime()
                    ->sortable()
                    ->jalaliDateTime(),
            ])
            ->filters([
                Tables\Filters\Filter::make('فعال')
                    ->query(fn(Builder $query) => $query->where('is_active', true)),

                Tables\Filters\Filter::make('پیشنهاد ویژه')
                    ->query(fn(Builder $query) => $query->where('is_best_offer', true)),

                Tables\Filters\Filter::make('بین‌المللی')
                    ->query(fn(Builder $query) => $query->where('is_international', true)),
                //Tables\Filters\TrashedFilter::make(),
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
            RelationManagers\StrategiesRelationManager::class,
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
            'index' => Pages\ListIndicators::route('/'),
            'create' => Pages\CreateIndicator::route('/create'),
            'edit' => Pages\EditIndicator::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }
}
