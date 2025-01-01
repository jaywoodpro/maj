<?php

namespace App\Livewire\Pages;

use App\Models\Comment;
use App\Models\Product\CartItem;
use App\Models\Product\TradingBot;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TradingBotDetail extends Component
{
    public $trading_bot;
    public $quantity = 1;
    public function mount($slug)
    {
        $this->trading_bot = TradingBot::where('slug', $slug)->where('is_active', true)->firstOrFail();
    }
    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'برای افزودن محصول به سبد خرید، ابتدا وارد شوید.');
            return;
        }
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('model_id', $this->trading_bot->id)
            ->where('model_type', "App\Models\Product\TradingBot")
            ->first();
        if($cartItem){
            if($cartItem->quantity + $this->quantity <= 5){
                if ($cartItem->quantity >= 5) {
                    $this->dispatch('fullOfProduct');
                    return;
                }
                $cartItem->increment('quantity',$this->quantity);
            }else{
                $this->dispatch('totalExceedingAllowedLimit');
                return;
            }
        }elseif($this->quantity <= 5){
            CartItem::create([
                'user_id' => Auth::id(),
                'model_id' => $this->trading_bot->id,
                'model_type' => "App\Models\Product\TradingBot",
                'quantity' => $this->quantity,
            ]);
        }else{
            $this->dispatch('totalExceedingAllowedLimit');
            return;
        }
        $this->dispatch('cartUpdated');
    }
    public function buyThis(){
        $this->addToCart();
        return redirect()->route('filament.astrolabe.pages.cart');
    }
    public function render()
    {
        $other_trading_bots = TradingBot::where('id', '!=', $this->trading_bot->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
        $comments = Comment::where('model_type','App\Models\Product\TradingBot')->get();
        return view('livewire.pages.trading-bot-detail',[
            'other_trading_bots' => $other_trading_bots,
            'comments' => $comments,
        ])
            ->layout('components.layouts.app', [
            'title' => $this->trading_bot->title . ' - مدرن اندیشان',
        ]);
    }
}
