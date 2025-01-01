<?php

namespace App\Filament\Resources\JournalResource\Pages;

use App\Filament\Resources\JournalResource;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateJournal extends CreateRecord
{
    use HasWizard;
    protected static string $resource = JournalResource::class;
    protected function getSteps():array{
        return [

            Step::make('اطلاعات حساب')
            ->description('Account Details')
            ->schema([
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),
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
                    ])->required(),
                TextInput::make('broker_name')
                    ->label('نام کارگزاری')
                    ->length(255)
                    ->nullable(),
            ])->columns(3),
            Step::make('اطلاعات معامله')
                ->description('Trade Details')
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
                        ])->required(),
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
                        ])->nullable(),
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

                ])->columns(2),
            Step::make('نتایج مالی')
                ->description('Financial Results')
                ->schema([
                    TextInput::make('profit_loss')
                        ->label('سود یا زیان معامله (به ارز پایه)')
                        ->numeric()
                        ->required(),
                    TextInput::make('profit_loss_percentage')
                        ->prefix('%')
                        ->minValue(-10000)
                        ->maxValue(100000)
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
                        ->minValue(-10000)
                        ->maxValue(100000)
                        ->label('مقدار افت حساب (Drawdown)')
                        ->numeric()
                        ->nullable(),
                ])->columns(2),
            Step::make('اطلاعات تحلیلی')
                ->description('Analysis Details')
                ->schema([
                    Select::make('analysis_type')
                        ->label('نوع تحلیل')
                        ->options([
                            'Technical' => 'تکنیکال',
                            'Fundamental' => 'فاندامنتال',
                            'Both' => 'هر دو',
                        ])->required(),
                    Textarea::make('entry_reason')
                        ->label('دلیل ورود به معامله (سیگنال‌ها یا استراتژی)')
                        ->rows(5)
                        ->maxLength(1024)
                        ->required(),
                    Textarea::make('exit_reason')
                        ->label('دلیل خروج از معامله')
                        ->rows(5)
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
                        ->rows(5)
                        ->maxLength(1024)
                        ->required(),
                    Textarea::make('news_events')
                        ->label('اخبار مرتبط (مانند NFP، FOMC)')
                        ->rows(5)
                        ->maxLength(1024)
                        ->nullable(),
                ])->columns(1),
            Step::make('احساسات و مدیریت روانشناسی')
                ->description('Psychology Management')
                ->schema([
                    Textarea::make('emotions_before_trade')
                        ->label('احساسات قبل از ورود (مانند هیجان، استرس)')
                        ->rows(5)
                        ->maxLength(1024)
                        ->nullable(),
                    Textarea::make('emotions_after_trade')
                        ->label('احساسات پس از خروج')
                        ->rows(5)
                        ->maxLength(1024)
                        ->nullable(),
                    Textarea::make('psychological_notes')
                        ->label('یادداشت‌های روانشناسی (درس‌های آموخته شده)')
                        ->rows(10)
                        ->maxLength(1024)
                        ->nullable(),
                ])->columns(1),
            Step::make('اطلاعات مدیریت ریسک')
                ->description('Risk Management')
                ->schema([
                    TextInput::make('risk_percentage')
                        ->prefix('%')
                        ->minValue(-10000)
                        ->maxValue(100000)
                        ->label('درصد ریسک در معامله')
                        ->numeric()
                        ->nullable(),
                    TextInput::make('capital_risked')
                        ->label('مقدار سرمایه‌ای که به خطر افتاده')
                        ->maxLength(100000)
                        ->numeric()
                        ->nullable(),
                    TextInput::make('max_drawdown_allowed')
                        ->label('حداکثر افت مجاز')
                        ->maxLength(100000)
                        ->numeric()
                        ->nullable(),
                ])->columns(1),
            Step::make('جزئیات استراتژی')
                ->description('Strategy Details')
                ->schema([
                    TextInput::make('risk_percentage')
                        ->prefix('%')
                        ->minValue(-10000)
                        ->maxValue(100000)
                        ->label('درصد ریسک در معامله')
                        ->numeric()
                        ->nullable(),
                    TextInput::make('strategy_name')
                        ->label('نام استراتژی استفاده شده')
                        ->maxLength(256)
                        ->required(),
                    Textarea::make('strategy_rules')
                        ->label('قوانین استراتژی')
                        ->maxLength(1024)
                        ->rows(15)
                        ->nullable(),
                    Textarea::make('backtest_results')
                        ->label('نتایج بک‌تست مرتبط')
                        ->maxLength(1024)
                        ->rows(10)
                        ->nullable(),
                    TextInput::make('win_rate')
                        ->prefix('%')
                        ->minValue(0)
                        ->maxValue(100)
                        ->label('نرخ برد استراتژی')
                        ->numeric()
                        ->nullable(),
                ])->columns(1),
            Step::make('تنظیمات')
                ->description('Settings')
                ->schema([
                    Toggle::make('is_public')
                        ->label('ژورنال عمومی (همه میبینند)')
                        ->nullable(),
                ])->columns(1),
        ];
    }
}
