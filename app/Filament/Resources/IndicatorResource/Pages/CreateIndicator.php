<?php

namespace App\Filament\Resources\IndicatorResource\Pages;

use App\Filament\Resources\IndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIndicator extends CreateRecord
{
    protected static string $resource = IndicatorResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // حذف داده‌های Repeater از داده اصلی
        $this->platformsData = $data['platforms'] ?? [];
        unset($data['platforms']);

        return $data;
    }
    protected function afterCreate(): void
    {
        $record = $this->record;
        if (!empty($this->data['seo']) && is_array($this->data['seo'])) {
            $seoData = array_filter($this->data['seo'], function ($value) {
                return !is_array($value) || !empty($value);
            });

            $record->seoMeta()->create($seoData);
        }
        if (!empty($this->data['sku'])) {
            // ذخیره رکورد در جدول SKU
            $record->sku()->create([
                'sku' => $this->data['sku'],
            ]);
        }
        foreach ($this->platformsData as $platformData) {
            if (empty($platformData['platform_id'])) {
                continue;
            }

            // ذخیره داده‌ها در جدول پیوت
            $record->platforms()->syncWithoutDetaching([
                $platformData['platform_id'] => [
                    'version' => $platformData['version'] ?? null,
                    'changelog' => $platformData['changelog'] ?? null,
                    'main_file' => $platformData['main_file'] ?? null,
                    'demo_file' => $platformData['demo_file'] ?? null,
                ],
            ]);
        }
    }
}
