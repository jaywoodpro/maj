<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'کاربر';
    protected static ?string $pluralModelLabel = 'کاربران';
    protected static ?string $navigationGroup = 'سطوح دسترسی';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('نام')
                                    ->required(),
                                TextInput::make('last_name')
                                    ->label('نام خانوادگی')
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')
                                    ->label('ایمیل')
                                    ->email()
                                    ->required(),
                                TextInput::make('mobile_number')
                                    ->label('شماره موبایل')
                                    ->tel(),
                            ]),
                        TextInput::make('province')
                            ->label('استان'),
                        Toggle::make('is_active')
                            ->label('فعال است؟')
                            ->default(true),
                        TextInput::make('password')
                            ->label('رمز عبور')
                            ->password()
                            ->required(fn (string $context) => $context === 'create'),
                        Select::make('roles')
                            ->label('نقش‌ها')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('نام')->searchable(),
                TextColumn::make('last_name')->label('نام خانوادگی')->searchable(),
                TextColumn::make('email')->label('ایمیل')->searchable(),
                TextColumn::make('mobile_number')->label('شماره موبایل'),
                ToggleColumn::make('is_active')->label('فعال است؟'),
                TextColumn::make('roles.name')
                    ->label('نقش')
                    ->badge()
                    ->colors([
                        'danger' => fn ($state): bool => in_array('super_admin', (array) $state),
                        'warning' => fn ($state): bool => in_array('admin', (array) $state),
                        'primary' => fn ($state): bool => in_array('vendor', (array) $state),
                        'info' => fn ($state): bool => in_array('pro_user', (array) $state),
                        'gray' => fn ($state): bool => in_array('user', (array) $state),
                    ]),
                TextColumn::make('created_at')->label('تاریخ ایجاد')->jalaliDateTime(),
            ])
            ->filters([
                Filter::make('is_active')
                    ->label('فقط کاربران فعال')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('changeRoles')
                    ->label('تغییر نقش')
                    ->action(fn ($record, array $data) => $record->syncRoles($data['roles']))
                    ->form([
                        Select::make('roles')
                            ->label('نقش‌ها')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload(),
                    ])
                    ->color('success'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
