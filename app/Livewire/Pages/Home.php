<?php

namespace App\Livewire\Pages;

use App\Models\Blog\Post;
use App\Models\Product\Indicator;
use App\Models\Product\License;
use App\Models\Product\TradingBot;
use App\Models\Slider;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $sliders = Slider::whereNull('deleted_at')->get();

        $best_offer_trading_bot = TradingBot::whereNull('deleted_at')->where('is_active',true)->where('is_best_offer',true)->latest()->first();
        $trading_bots = TradingBot::whereNull('deleted_at')
            ->where('is_active', true)
            ->when($best_offer_trading_bot, function ($query) use ($best_offer_trading_bot) {
                $query->where('id', '!=', $best_offer_trading_bot->id);
            })
            ->latest()
            ->take(10)
            ->get();

        $best_offer_indicator = Indicator::whereNull('deleted_at')->where('is_active',true)->where('is_best_offer',true)->latest()->first();
        $indicators = Indicator::whereNull('deleted_at')
            ->where('is_active', true)
            ->when($best_offer_indicator, function ($query) use ($best_offer_indicator) {
                $query->where('id', '!=', $best_offer_indicator->id);
            })
            ->latest()
            ->take(10)
            ->get();

        $posts = Post::latest()->take(4)->get();
        $total_licenses = License::count();
        $total_products = Indicator::count() + TradingBot::count();
        return view('livewire.pages.home', [
            'sliders' => $sliders,
            'trading_bots' => $trading_bots,
            'indicators' => $indicators,
            'posts' => $posts,
            'best_offer_indicator' => $best_offer_indicator,
            'best_offer_trading_bot' => $best_offer_trading_bot,
            'total_licenses' => $total_licenses,
            'total_products' => $total_products,
        ])
            ->layout('components.layouts.app', [
            'title' => 'صفحه نخست - مدرن اندیشان'
        ]);
    }
}
