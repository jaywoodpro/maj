<?php

namespace App\Filament\Pages;

use App\Models\Product\CartItem;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Checkout extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'تسویه حساب';
    protected static ?string $navigationLabel = 'تسویه حساب';
    protected static ?string $navigationGroup = 'فروشگاه';
    protected static string $view = 'filament.pages.checkout';

    public function mount()
    {
        $cartItem = CartItem::all();
        if(count($cartItem) == 0){
            Notification::make()
                ->title('سبد خرید شما خالی است')
                ->body('با سبد خرید خالی نمیتوانید به صفحه ی پرداخت بروید.')
                ->danger()
                ->seconds(3)
                ->send();
            return redirect('astrolabe/cart');
        }
    }
}
