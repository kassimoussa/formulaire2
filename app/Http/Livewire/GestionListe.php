<?php

namespace App\Http\Livewire;

use App\Models\ListeSim;
use Livewire\Component;
use Livewire\WithPagination;

class GestionListe extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = ""; 
    public function render()
    {
        $sims = ListeSim::whereLike(['numero', 'nom'], $this->search ?? '')
            ->orderBy("id", "asc")->paginate(20);

      //  dump($sims);

        return view('livewire.gestion-liste', ['sims' => $sims]);
    }
}
