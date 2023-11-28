<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SendSms extends Component
{
    public $from, $texte, $destinataire, $codepin;
    public $currentStep = 1;
    public $moncode = "1112";

    public function checkpin()
    {
        if($this->codepin == $this->moncode)
        {
            $this->currentStep = 2;
        }else {
            $this->addError('codepin', 'Le code entré est faux.');
        }
    }
    public function send()
    {
        $url = 'http://10.39.230.68:13013/cgi-bin/sendsms';
        $user = 'sms_usr1';
        $pass = 'sms_pwd1';
        $from = $this->from;
        $to = "253" . $this->destinataire;
        $text = $this->texte;

        $response = Http::get($url, [
            'user' => $user,
            'pass' => $pass,
            'from' => $from,
            'to' => $to,
            'text' => $text,
        ]);

        // dump($response);

        if ($response->successful()) {
            // Request was successful 
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => "Le sms vous a été envoyé avec succès!"]
            );
            $this->reset();
            $this->currentStep = 1;
            $this->resetValidation();

        } else {
            // Request failed 
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "ll y a eu un problème lors de l'envois du sms. Veuillerc cliquer sur le bouton pour Réenvoyer !"]
            );
            $this->reset();
            $this->resetValidation();
        }
    }

    public function render()
    {
        return view('livewire.send-sms');
    }
}
