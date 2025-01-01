<?php

namespace App\Livewire\Pages;

use App\Models\Product\TradingBot;
use Livewire\Component;
use Livewire\WithPagination;

class TradingBots extends Component
{
    use WithPagination;

    public $search = '';
    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = TradingBot::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $trading_bots = $query->paginate(10);

        return view('livewire.pages.trading-bots', [
            'trading_bots' => $trading_bots,
        ])->layout('components.layouts.app', [
            'title' => 'ربات‌های معامله‌گر - مدرن اندیشان',
        ]);
    }
}
