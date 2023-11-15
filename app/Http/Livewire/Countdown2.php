<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Countdown2 extends Component
{
    public $countdownActive = false;

    public function start()
    {
        $this->countdownActive = true;
        $this->emit('startCountdown');
    }

    public function nothing(){
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'success!']
        );
    }

    public function render()
    {
        return view('livewire.countdown2');
    }
}
