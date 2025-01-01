<?php

namespace App\Filament\Pages;

use App\Models\Product\CartItem;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Cart extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $title = 'سبد خرید';
    protected static ?string $navigationLabel = 'سبد خرید';
    protected static ?string $navigationGroup = 'فروشگاه';
    protected static ?string $slug = 'cart';
    protected static string $view = 'filament.pages.cart';

    public $cartItems = [];
    public $totalPrice = 0;

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $user = Auth::user();
        if (!$user) {
            $this->cartItems = [];
            $this->totalPrice = 0;
            return;
        }
        $this->cartItems = CartItem::where('user_id', $user->id)
            ->with('model')
            ->get();
        $this->totalPrice = $this->cartItems->sum(function ($item) {
            $price = $item->model->discount_price ?? $item->model->price;
            return $price * $item->quantity;
        });
    }

    public function increaseQuantity($itemId): void
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem && $cartItem->quantity < 5) {
            $cartItem->increment('quantity');
            Notification::make()
                ->title('افزوده شد')
                ->body('تعداد محصول در سبد شما بروز شد.')
                ->success()
                ->seconds(2)
                ->send();
        } else {
            Notification::make()
                ->title('محدودیت تعداد')
                ->body('در هر خرید شما از هر محصول تنها میتوانید پنج لایسنس خریداری کنید.')
                ->danger()
                ->seconds(4)
                ->send();
        }
        $this->loadCart();
    }

    public function decreaseQuantity($itemId): void
    {
        $cartItem = CartItem::find($itemId);

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
                Notification::make()
                    ->title('کاسته شد')
                    ->body('تعداد محصول در سبد شما بروز شد.')
                    ->success()
                    ->seconds(2)
                    ->send();
            } else {
                $cartItem->delete();
                Notification::make()
                    ->title('محصول حذف شد')
                    ->body('محصول مورد نظر از سبد خرید شما حذف شد.')
                    ->warning()
                    ->seconds(3)
                    ->send();
            }
        }

        $this->loadCart();
    }

    public function goToCheckout(){
        $cartItem = CartItem::all();
        if($cartItem){
            return redirect()->route('filament.astrolabe.pages.checkout');
        }else{
            Notification::make()
                ->title('سبد خرید شما خالی است')
                ->body('با سبد خرید خالی نمیتوانید به صفحه ی پرداخت بروید.')
                ->danger()
                ->seconds(3)
                ->send();
        }
    }

    public function removeItem($itemId): void
    {
        CartItem::find($itemId)?->delete();
        $this->loadCart();
    }
}
