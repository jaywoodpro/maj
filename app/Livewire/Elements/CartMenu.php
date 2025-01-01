<?php

namespace App\Livewire\Elements;

use App\Models\Product\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartMenu extends Component
{
    protected $listeners = ['cartUpdated' => 'refreshCart'];
    public $cartItems = [];
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function mount()
    {
        $this->loadCart();
    }
    public function refreshCart()
    {
        $this->loadCart();
    }
    public function decreaseQuantity($itemId)
    {
        $cartItem = CartItem::find($itemId);

        if (!$cartItem) {
            session()->flash('error', 'محصول در سبد خرید یافت نشد.');
            return;
        }
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete();
        }
        $this->loadCart();
        session()->flash('success', 'محصول از سبد خرید حذف شد.');
    }
    public function loadCart()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->where('quantity', '<=', 0)->delete();
            $this->cartItems = CartItem::where('user_id', Auth::id())->with('model')->get();
            $this->totalQuantity = $this->cartItems->sum('quantity');
            $this->totalPrice = $this->cartItems->sum(function ($cartItem) {
                $price = $cartItem->model->discount_price ?? $cartItem->model->price; // اولویت با تخفیف
                return $price * $cartItem->quantity;
            });
        }
    }
    public function render()
    {
        return view('livewire.elements.cart-menu', [
            'cartItems' => $this->cartItems,
            'totalQuantity' => $this->totalQuantity,
            'totalPrice' => $this->totalPrice,
        ]);
    }
}
