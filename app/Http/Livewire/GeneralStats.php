<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class GeneralStats extends Component
{
    public $total_g_client, $total_o_client, $total_a_client;
    public $total_cni, $total_passport, $total_carte_refugie, $total_titre_sejour;
    public $enregistrementParJour, $jours, $jclients;

    public function mount()
    {
        $this->total_g_client = Client::count();
        $this->total_o_client = Client::where("user_id", null)->count();
        $this->total_a_client = Client::whereNotNull("user_id")->count();


        $this->total_cni = Client::where("type_piece", "CNI")->count();
        $this->total_passport = Client::where("type_piece", "Passport")->count();
        $this->total_titre_sejour = Client::where("type_piece", "Titre de séjour")->count();
        $this->total_carte_refugie = Client::where("type_piece", "Carte de réfugié")->count();
        $this->parJour();

        $enregistrementParJour = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $this->jours = $enregistrementParJour->pluck('date')->toArray();
        $this->jclients = $enregistrementParJour->pluck('count')->toArray();
/* 
         dd($this->jours,   $this->jclients); */
    }

    public function parJour()
    {
        // Fetch subscription data from the subscriptions table
        $subscriptionsByDay = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Chart data preparation for Line Chart
        $labels = $subscriptionsByDay->pluck('date')->toArray();
        $data = $subscriptionsByDay->pluck('count')->toArray();

        // Chart configuration
        $this->enregistrementParJour = [
            'labels' => $labels,
            'dataset' => [
                [
                    'label' => 'Enregistrement des client par jour',
                    'data' => $data,
                    'borderColor' => '#3490dc',
                    'fill' => false,
                ],
            ],
        ];
        //dump($this->jours);
    }
    public function render()
    {
        return view('livewire.general-stats');
    }
}
