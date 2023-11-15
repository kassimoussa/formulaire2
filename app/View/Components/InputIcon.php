<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputIcon extends Component
{
    /**
     * Create a new component instance.
     */
    public $iplabel, $ipicon, $ipname, $iptype, $ipid, $ipplaceholder; 
    public function __construct($iplabel, $ipicon, $ipname, $iptype, $ipid, $ipplaceholder )
    {
        $this->iplabel = $iplabel ;
        $this->ipicon = $ipicon ;
        $this->ipname = $ipname ;
        $this->iptype = $iptype ;
        $this->ipid = $ipid ;
        $this->ipplaceholder = $ipplaceholder ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-icon');
    }
}
