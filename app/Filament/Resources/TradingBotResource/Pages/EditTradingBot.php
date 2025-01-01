<?php

namespace App\Filament\Resources\TradingBotResource\Pages;

use App\Filament\Resources\TradingBotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTradingBot extends EditRecord
{
    protected static string $resource = TradingBotResource::class;
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $platforms = $this->record->platforms()->get(); // بازیابی داده‌های پیوت
        $data['sku'] = $this->record->sku?->sku;
        $seoMeta = $this->record->seoMeta;
        if ($seoMeta) {
            $data['seo'] = $seoMeta->toArray();
        } else {
            $data['seo'] = [];
        }
        $data['platforms'] = $platforms->map(function ($platform) {
            return [
                'platform_id' => $platform->id,
                'version' => $platform->pivot->version,
                'changelog' => $platform->pivot->changelog,
                'main_file' => $platform->pivot->main_file,
                'demo_file' => $platform->pivot->demo_file,
            ];
        })->toArray();

        return $data;
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $platformsData = $data['platforms'] ?? []; // استخراج داده‌های پلتفرم‌ها

        unset($data['platforms']); // حذف داده‌های Repeater از فرم اصلی

        // پاک کردن روابط موجود و بازنویسی داده‌های جدید
        $this->record->platforms()->sync([]);
        if (isset($data['seo'])) {
            foreach ($data['seo'] as $key => $value) {
                if (is_array($value) && empty($value)) {
                    $data['seo'][$key] = null;
                }
            }
        }
        if (isset($data['seo'])) {
            $data['seo']['currency'] = $data['seo']['currency'] ?? 'IRT'; // تنظیم مقدار پیش‌فرض
        }
        foreach ($platformsData as $platformData) {
            if (empty($platformData['platform_id'])) {
                continue;
            }

            // ذخیره داده‌ها در جدول پیوت
            $this->record->platforms()->syncWithoutDetaching([
                $platformData['platform_id'] => [
                    'version' => $platformData['version'] ?? null,
                    'changelog' => $platformData['changelog'] ?? null,
                    'main_file' => $platformData['main_file'] ?? null,
                    'demo_file' => $platformData['demo_file'] ?? null,
                ],
            ]);
        }

        return $data;
    }
    protected function afterSave(): void
    {
        $record = $this->record;

        if (!empty($this->data['seo']) && is_array($this->data['seo'])) {
            $seoData = array_filter($this->data['seo'], function ($value) {
                return !is_array($value) || !empty($value);
            });

            $record->seoMeta()->updateOrCreate([], $seoData);
        } else {
            $record->seoMeta()?->delete(); // حذف SEO Meta در صورت خالی بودن داده‌ها
        }


        if (!empty($this->data['sku'])) {
            // بروزرسانی یا ایجاد رکورد در جدول SKU
            $record->sku()->updateOrCreate([], [
                'sku' => $this->data['sku'],
            ]);
        } else {
            // حذف رکورد SKU اگر مقدار جدید خالی باشد
            $record->sku()?->delete();
        }
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
