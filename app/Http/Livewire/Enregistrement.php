<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\SecretCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Enregistrement extends Component
{
    use WithFileUploads;
    public $audj, $now, $nom, $numero, $date_naissance, $lieu_naissance, $domicile, $profession, 
    $id_piece, $piece, $type_piece, $date_emission, $date_expiration, $photo,
    $code_secret, $code_secret_confirmation, $randomSixDigitNumber, $piece_url, $photo_url, $responseMessage;
    public $currentStep = 1;
    public $totalStep = 4;
    public $errorMsg = "Ce champ ne doit etre vide !"; 

    public function mount()
    {
        $this->audj = Carbon::today()->format('Y-m-d');
        $this->now = Carbon::now();
        $this->piece_url = "images/addphoto.png";
        $this->photo_url = "";
    }


    /*  public function rules() 
    {
        return [ 
            'numero' => 'required|unique:clients|min:8|max:8', 
            'nom' => 'required', 
            'file' => 'image|max:1024',
            'code_secret' => 'required|min:6|max:6', 
        ];
    } */

    public function messages()
    {
        return [
            'numero.required' => 'Vous devez entrer un numéro de telephone.',
            'numero.unique' => 'Vous avez déja fourni les infos pour ce numéro de telephone.',
            'numero.max' => 'Vous devez entrer un numéro de 8 chiffres',
            'numero.min' => 'Vous devez entrer un numéro de 8 chiffres',
            'nom.required' => 'Vous devez entrer votre nom.',
            'code_secret_confirmation.required' => 'Vous devez entrer le code qui vous a été envoyé par sms.',
            'code_secret_confirmation.min' => 'Le code secret est de 6 chiffres',
            'code_secret_confirmation.max' => 'Le code secret est de 6 chiffres',
            'code_secret.confirmed' => 'Le code entré ne correspond pas.',
            'piece.required' => "Vous devez entrer une image de votre pièce d'identité.",
        ];
    }

    public function step_increment()
    {
        /* $this->resetErrorBag(); 
        $this->validateData();*/
        $this->currentStep++;
    }

    public function step_decrement()
    {
        /* $this->resetErrorBag(); 
        if ($this->currentStep > 1) {
            $this->currentStep--;
        } */
        $this->currentStep--;
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->step1a();
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'code_secret' => 'confirmed',
                'code_secret_confirmation' => 'required|min:6|max:6',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'nom' => 'required',
            ]);
        }
    }

    public function step1a()
    {
        $this->validate([
            'numero' => 'required|unique:clients|min:8|max:8',
        ]);

        $check_client = Client::where('numero', $this->numero)->exists();
        if ($check_client) {
        } else {
            $this->sendSecretCode();
        }
    }

    public function sendSecretCode()
    {
        $checkCodeExist = SecretCode::where('numero', $this->numero)->first();
        if ($checkCodeExist) {
            $randomSixDigitNumber = rand(100000, 999999);
            $checkCodeExist->update([
                'code' => $randomSixDigitNumber,
                'date_envoie' => Carbon::now(),
            ]);

            $this->code_secret = $randomSixDigitNumber;
            $this->currentStep = 2;
        } else {
            $randomSixDigitNumber = rand(100000, 999999);
            $newSecretCode = new Secretcode();
            $newSecretCode->numero = $this->numero;
            $newSecretCode->code = $randomSixDigitNumber;
            $newSecretCode->date_envoie = Carbon::now();
            $query = $newSecretCode->save();


            $this->code_secret = $randomSixDigitNumber;
            $this->currentStep = 2;
        }

        /* $response = Http::asForm()->post('http://192.168.100.183:8000/api/insert', [
            'dir_num' => "253".$this->numero,
            'sms_text' => "Votre code secret est: ".$this->code_secret,
        ]);

        if ($response->successful()) {
            // Request was successful
            $this->responseMessage = $response->json()['message'];
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => "Le sms vous a été envoyé avec succès!"]
            );
        } else {
            // Request failed
            $this->responseMessage = 'Error: ' . $response->status();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "ll y a eu un problème lors de l'envois du sms. Veuillerc cliquer sur le bouton pour Réenvoyer !"]
            );
        } */
    }


    public function step2a()
    {

        $this->validate([
            'code_secret_confirmation' => 'required|min:6|max:6',
        ]);

        //$secretCode = Secretcode::select('code')->where('numero', $this->numero)->first();

        if ($this->code_secret == $this->code_secret_confirmation) {
            $this->currentStep = 3;
        } else {
            $this->addError('code_secret_confirmation', 'Le code entré ne correspond pas au code qui vous a été envoyé.');
        }
    }
    public function updated($propertyName)
    {
        /* $this->validateOnly($propertyName); */

        if ($this->piece) {
            $this->piece_url =  $this->piece->temporaryUrl();
        }
    }

    public function save()
    {
        $this->validate([
            'piece' => 'required|image',
            'nom' => 'required',
            'type_piece' => 'required',
        ]);

        $client = new Client();
        $client->numero = $this->numero;
        $client->nom = Str::title($this->nom);
        $client->type_piece = $this->type_piece;
        $client->date_naissance = $this->date_naissance;
        $client->lieu_naissance = $this->lieu_naissance;
        $client->domicile = $this->domicile;
        $client->profession = $this->profession;
        $client->id_piece = $this->id_piece;
        $client->date_emission = $this->date_emission;
        $client->date_expiration = $this->date_expiration;
        $piece_name = time() . '.' . $this->piece->getClientOriginalName();
        $client->piece =  $piece_name;
        $client->piece_public_path = "public/images/" . $piece_name;
        $client->piece_storage_path = "storage/images/" . $piece_name;
        $photo_name = time() . '.' . $this->photo->getClientOriginalName();
        $client->photo =  $photo_name;
        $client->photo_public_path = "public/images/" . $photo_name;
        $client->photo_storage_path = "storage/images/" . $photo_name;
        $query = $client->save();

        if ($query) {
            $this->piece->storeAs('public/images', $piece_name);
            $this->photo->storeAs('public/images', $photo_name);
            $this->currentStep = 4;
        } else {
            $this->currentStep = 5;
        }
    }

    public function render()
    {
        return view('livewire.enregistrement');
    }
}
