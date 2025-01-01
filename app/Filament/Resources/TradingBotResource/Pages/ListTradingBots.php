<?php

namespace App\Filament\Resources\TradingBotResource\Pages;

use App\Filament\Resources\TradingBotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTradingBots extends ListRecords
{
    protected static string $resource = TradingBotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
