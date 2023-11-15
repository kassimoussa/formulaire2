<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Countdown extends Component
{
   
    public function start()
    {
        $this->emit('startCountdown');
    }

    public function render()
    {
        return view('livewire.countdown');
    }
}
