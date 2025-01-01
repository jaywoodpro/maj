<?php

namespace App\Livewire\Elements;

use App\Models\Product\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartButton extends Component
{
    public $modelId;
    public $modelType;
    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'برای افزودن محصول به سبد خرید، ابتدا وارد شوید.');
            return;
        }
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('model_id', $this->modelId)
            ->where('model_type', $this->modelType)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity >= 5) {
                $this->dispatch('fullOfProduct');
                return;
            }
            $cartItem->increment('quantity');
        } else {
            // افزودن محصول جدید به سبد خرید
            CartItem::create([
                'user_id' => Auth::id(),
                'model_id' => $this->modelId,
                'model_type' => $this->modelType,
                'quantity' => 1,
            ]);
        }
        $this->dispatch('cartUpdated');
    }
    public function render()
    {
        return view('livewire.elements.add-to-cart-button');
    }
}
