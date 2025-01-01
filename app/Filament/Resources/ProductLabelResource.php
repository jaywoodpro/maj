<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductLabelResource\Pages;
use App\Filament\Resources\ProductLabelResource\RelationManagers;
use App\Models\Product\Indicator;
use App\Models\Product\ProductLabel;
use App\Models\Product\TradingBot;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductLabelResource extends Resource
{
    protected static ?string $model = ProductLabel::class;
    protected static ?string $modelLabel = 'برچسب محصول';
    protected static ?string $pluralModelLabel = 'برچسب محصولات';
    protected static ?string $navigationGroup = 'محصولات';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('جزئیات لیبل')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('لیبل')
                                    ->unique()
                                    ->placeholder('لیبل مرتبط با ربات یا اندیکاتور')
                                    ->required(),
                                Select::make('type')
                                    ->options([
                                        'bot' => 'ربات',
                                        'indicator' => 'اندیکاتور',
                                    ])
                                    ->label('نوع محصول')
                                    ->required()
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('برچسب محصول')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('type')
                    ->label('نوع محصول')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->sortable()
                    ->alignCenter()
                    ->jalaliDateTime(),
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
            'index' => Pages\ListProductLabels::route('/'),
            'create' => Pages\CreateProductLabel::route('/create'),
            'edit' => Pages\EditProductLabel::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
