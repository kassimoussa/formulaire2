<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class GestionClient extends Component
{
    public $clients, $imgUrl;
    public $search = "";

    public function getClient()
    {
        $search = $this->search; 
        $this->clients = Client::Where(function ($query) use ($search) {
            $query->where('numero', 'Like', '%' . $search . '%')
                ->orWhere('nom', 'Like', '%' . $search . '%')
                ->orWhere('type_doc', 'Like', '%' . $search . '%');
        })->orderBy("created_at", "asc")
            ->get();
    }
    public function showImg($client_id)
    {
        $client = Client::find($client_id);
        $this->imgUrl = $client->storage_path;
    }
    public function close_img() 
    {
        $this->imgUrl = "";
    }
    public function render()
    {
        $this->getClient();
        return view('livewire.gestion-client');
    }
}
