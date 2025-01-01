<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JournalResource\Pages;
use App\Filament\Resources\JournalResource\RelationManagers;
use App\Models\Journal;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JournalResource extends Resource
{
    protected static ?string $model = Journal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'ژورنال';
    protected static ?string $pluralModelLabel = 'ژورنال ها';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // سکشن اطلاعات حساب
                Section::make('اطلاعات حساب')
                    ->schema([
                        Hidden::make('user_id')->required(),
                        Select::make('platform')
                            ->label('نوع اکانت')
                            ->options([
                                'MetaTrader4' => 'MetaTrader4',
                                'MetaTrader5' => 'MetaTrader5',
                                'cTrader' => 'cTrader',
                                'TradingView' => 'TradingView',
                                'NinjaTrader' => 'NinjaTrader',
                                'FxProEdge' => 'FxProEdge',
                                'ZuluTrade' => 'ZuluTrade',
                                'MofidTrader' => 'مفید تریدر',
                                'AsaTrader' => 'آساتریدر',
                                'Farabixo' => 'فارابیکسو',
                                'BourseView' => 'بورس ویو',
                                'TadbirTrader' => 'تدبیر تریدر',
                                'RayanHamrah' => 'رایان همراه',
                                'Binance' => 'Binance',
                                'KuCoin' => 'KuCoin',
                                'CoinEx' => 'CoinEx',
                                'CoinMarketCap' => 'CoinMarketCap',
                                '3Commas' => '3Commas',
                                'TabTrader' => 'TabTrader',
                            ])
                            ->nullable(),
                        Select::make('account_type')
                            ->options([
                                'Live' => 'واقعی',
                                'Demo' => 'دمو',
                            ])
                            ->required()
                            ->label('نوع اکانت'),

                        TextInput::make('broker_name')
                            ->label('نام کارگزاری')
                            ->maxLength(255)
                            ->nullable(),

                        Select::make('base_currency')
                            ->label('ارز پایه')
                            ->default('USD')
                            ->options([
                                'USD' => 'دلار آمریکا',
                                'EUR' => 'یورو',
                                'GBP' => 'پوند انگلیس',
                                'CHF' => 'فرانک سوئیس',
                                'AED' => 'درهم امارات',
                                'IRR' => 'ریال ایران',
                                'IRT' => 'تومان ایران',
                                'USDT' => 'تتر',
                            ])
                            ->required(),
                    ])
                    ->columns(3),

                // سکشن اطلاعات معامله
                Section::make('اطلاعات معامله')
                    ->schema([
                        TextInput::make('trade_id')
                            ->label('شناسه معامله')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('pair')
                            ->label('جفت ارز مورد معامله')
                            ->required(),

                        DateTimePicker::make('entry_date')
                            ->label('تاریخ و ساعت ورود به معامله')
                            ->required(),

                        DateTimePicker::make('exit_date')
                            ->label('تاریخ و ساعت خروج از معامله')
                            ->required(),

                        TextInput::make('entry_price')
                            ->label('قیمت ورود')
                            ->numeric()
                            ->required(),

                        TextInput::make('exit_price')
                            ->label('قیمت خروج')
                            ->numeric()
                            ->required(),

                        Select::make('position_type')
                            ->label('نوع معامله')
                            ->options([
                                'Buy' => 'خرید',
                                'Sell' => 'فروش',
                            ])
                            ->required(),

                        Select::make('leverage')
                            ->label('لوریج استفاده شده')
                            ->options([
                                '1:1' => '1:1',
                                '1:10' => '1:10',
                                '1:50' => '1:50',
                                '1:100' => '1:100',
                                '1:200' => '1:200',
                                '1:300' => '1:300',
                                '1:400' => '1:400',
                                '1:500' => '1:500',
                                '1:600' => '1:600',
                                '1:700' => '1:700',
                                '1:800' => '1:800',
                                '1:900' => '1:900',
                                '1:1000' => '1:1000',
                            ])
                            ->nullable(),

                        TextInput::make('stop_loss')
                            ->label('حد ضرر (Stop Loss)')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('take_profit')
                            ->label('حد سود (Take Profit)')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('pip_gain_loss')
                            ->label('تعداد پیپ‌های سود یا زیان')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('commission')
                            ->label('کارمزد معامله')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('swap_fee')
                            ->label('هزینه سوآپ (در صورت نگهداری معامله در شب)')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->columns(2),

                // سکشن نتایج مالی
                Section::make('نتایج مالی')
                    ->schema([
                        TextInput::make('profit_loss')
                            ->label('سود یا زیان معامله (به ارز پایه)')
                            ->numeric()
                            ->required(),

                        TextInput::make('profit_loss_percentage')
                            ->prefix('%')
                            ->label('درصد سود یا زیان معامله نسبت به سرمایه')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('balance_before')
                            ->label('موجودی قبل از معامله')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('balance_after')
                            ->label('موجودی پس از معامله')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('risk_reward_ratio')
                            ->label('نسبت ریسک به سود (Risk/Reward)')
                            ->numeric()
                            ->nullable(),

                        TextInput::make('drawdown')
                            ->prefix('%')
                            ->label('مقدار افت حساب (Drawdown)')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->columns(2),

                // سکشن اطلاعات تحلیلی
                Section::make('اطلاعات تحلیلی')
                    ->schema([
                        Select::make('analysis_type')
                            ->label('نوع تحلیل')
                            ->options([
                                'Technical' => 'تکنیکال',
                                'Fundamental' => 'فاندامنتال',
                                'Both' => 'هر دو',
                            ])
                            ->required(),

                        Textarea::make('entry_reason')
                            ->label('دلیل ورود به معامله (سیگنال‌ها یا استراتژی)')
                            ->maxLength(1024)
                            ->required(),

                        Textarea::make('exit_reason')
                            ->label('دلیل خروج از معامله')
                            ->maxLength(1024)
                            ->required(),

                        TagsInput::make('indicators_used')
                            ->label('اندیکاتورهای استفاده شده')
                            ->nullable(),

                        TagsInput::make('timeframes')
                            ->label('تایم‌فریم های معامله')
                            ->required(),

                        Textarea::make('market_conditions')
                            ->label('شرایط بازار (روند صعودی، نزولی، یا رنج)')
                            ->maxLength(1024)
                            ->required(),

                        Textarea::make('news_events')
                            ->label('اخبار مرتبط (مانند NFP، FOMC)')
                            ->nullable(),
                    ])
                    ->columns(1),

                // سکشن احساسات و مدیریت روانشناسی
                Section::make('احساسات و مدیریت روانشناسی')
                    ->schema([
                        Textarea::make('emotions_before_trade')
                            ->label('احساسات قبل از ورود (مانند هیجان، استرس)')
                            ->nullable(),

                        Textarea::make('emotions_after_trade')
                            ->label('احساسات پس از خروج')
                            ->nullable(),

                        Textarea::make('psychological_notes')
                            ->label('یادداشت‌های روانشناسی (درس‌های آموخته شده)')
                            ->nullable(),
                    ])
                    ->columns(1),

                // سکشن تنظیمات
                Section::make('تنظیمات')
                    ->schema([
                        Toggle::make('is_public')
                            ->label('ژورنال عمومی (همه میبینند)')
                            ->nullable(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('trade_id')
                    ->label('شناسه معامله')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('pair')
                    ->label('جفت ارز')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_type')
                    ->badge()
                    ->label('نوع اکانت')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('base_currency')
                    ->label('ارز پایه')
                    ->sortable(),



                Tables\Columns\TextColumn::make('entry_date')
                    ->label('تاریخ ورود')
                    ->jalaliDateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('exit_date')
                    ->label('تاریخ خروج')
                    ->jalaliDateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('profit_loss')
                    ->label('سود/زیان')
                    ->sortable(),


                TextColumn::make('position_type')
                    ->label('نوع معامله')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'success' => 'Buy',
                        'danger' => 'Sell',
                    ]),

                Tables\Columns\ToggleColumn::make('is_public')
                    ->label('عمومی')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('platform')
                    ->label('نوع اکانت')
                    ->options([
                        'MetaTrader4' => 'MetaTrader4',
                        'MetaTrader5' => 'MetaTrader5',
                        'cTrader' => 'cTrader',
                        'TradingView' => 'TradingView',
                        'NinjaTrader' => 'NinjaTrader',
                        'FxProEdge' => 'FxProEdge',
                        'ZuluTrade' => 'ZuluTrade',
                        'MofidTrader' => 'مفید تریدر',
                        'AsaTrader' => 'آساتریدر',
                        'Farabixo' => 'فارابیکسو',
                        'BourseView' => 'بورس ویو',
                        'TadbirTrader' => 'تدبیر تریدر',
                        'RayanHamrah' => 'رایان همراه',
                        'Binance' => 'Binance',
                        'KuCoin' => 'KuCoin',
                        'CoinEx' => 'CoinEx',
                        'CoinMarketCap' => 'CoinMarketCap',
                        '3Commas' => '3Commas',
                        'TabTrader' => 'TabTrader',
                    ]),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJournals::route('/'),
            'create' => Pages\CreateJournal::route('/create'),
            'edit' => Pages\EditJournal::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
