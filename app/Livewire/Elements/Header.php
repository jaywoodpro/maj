<?php

namespace App\Livewire\Elements;

use App\Models\Social;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $socials = Social::whereNull('deleted_at')->where('is_active',true)->get();
        return view('livewire.elements.header',[
            'socials' => $socials,
        ]);
    }
}
