<?php

namespace App\Filament\Resources\StrategyResource\Pages;

use App\Filament\Resources\StrategyResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Strategy;
use JetBrains\PhpStorm\NoReturn;

class CreateStrategy extends CreateRecord
{
    protected static string $resource = StrategyResource::class;
    protected function afterCreate(): void
    {
        $record = $this->record;
        if (!empty($this->data['seo']) && is_array($this->data['seo'])) {
            $seoData = array_filter($this->data['seo'], function ($value) {
                return !is_array($value) || !empty($value);
            });

            $record->seoMeta()->create($seoData);
        }
    }
}
