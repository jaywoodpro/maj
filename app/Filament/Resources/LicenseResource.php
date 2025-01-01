<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenseResource\Pages;
use App\Filament\Resources\LicenseResource\RelationManagers;
use App\Models\Product\License;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicenseResource extends Resource
{
    protected static ?string $model = License::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'لایسنس';
    protected static ?string $pluralModelLabel = 'لایسنس ها';
    protected static ?string $navigationGroup = 'محصولات';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات عمومی')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('key')
                                    ->label('کلید لایسنس')
                                    ->required()
                                    ->maxLength(16),
                                Select::make('type')
                                    ->label('نوع لایسنس')
                                    ->options([
                                        'indicator' => 'اندیکاتور',
                                        'bot' => 'ربات معامله‌گر',
                                    ])
                                    ->required(),
                                TextInput::make('application_name')
                                    ->label('نام اپلیکیشن')
                                    ->required(),
                                TextInput::make('user_nickname')
                                    ->label('نام مستعار کاربر'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Select::make('user_id')
                                    ->label('کاربر')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->required(),
                                Select::make('label_id')
                                    ->label('لیبل محصول')
                                    ->relationship('label', 'title')
                                    ->searchable()
                                    ->required(),
                            ]),
                    ]),
                Section::make('اطلاعات حساب')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('account_number')
                                    ->label('شماره حساب')
                                    ->required(),
                                TextInput::make('account_type')
                                    ->label('نوع حساب')
                                    ->required(),
                                TextInput::make('broker_name')
                                    ->label('نام بروکر')
                                    ->required(),
                                Toggle::make('is_live')
                                    ->label('حساب لایو است؟')
                                    ->required(),
                            ]),
                    ]),
                Section::make('وضعیت و تاریخ انقضا')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('فعال است؟')
                                    ->required(),
                                DatePicker::make('expiration_date')
                                    ->label('تاریخ انقضا')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('کلید لایسنس')->searchable(),
                TextColumn::make('type')->label('نوع'),
                TextColumn::make('user.name')->label('کاربر'),
                TextColumn::make('label.title')->label('برچسب محصول'),
                ToggleColumn::make('is_active')->label('فعال است'),
                ToggleColumn::make('is_live')->label('حساب لایو است'),
                TextColumn::make('expiration_date')->label('تاریخ انقضا')->jalaliDate(),
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
        if (auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) {
            return parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }
        if (auth()->user()->hasRole('vendor')) {
            return parent::getEloquentQuery()->where('user_id', auth()->user()->id)->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLicenses::route('/'),
            'create' => Pages\CreateLicense::route('/create'),
            'edit' => Pages\EditLicense::route('/{record}/edit'),
        ];
    }
}
