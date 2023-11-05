<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class GestionClient extends Component
{
    use WithFileUploads;
    public $clients, $client_id, $numero, $nom, $date_naissance, $lieu_naissance, $domicile, $profession, $photo, $photo_url, $imgUrl;
    public $numero2, $nom2, $date_naissance2, $lieu_naissance2, $domicile2, $profession2, $photo2, $photo_url2;
    public $id_piece, $piece, $piece_url, $type_piece, $date_emission, $date_expiration;
    public $id_piece2, $piece2, $piece_url2, $type_piece2, $date_emission2, $date_expiration2;
    public $search = "";

    public function mount()
    {
        $this->photo_url = "images/addphoto.png";
        $this->photo_url2 = "images/addphoto.png";
        $this->piece_url = "images/addphoto.png";
        $this->piece_url2 = "images/addphoto.png";
    }

    protected $rules = [
        'nom' => 'required',
        'date_naissance' => 'required',
        'lieu_naissance' => 'required',
        'domicile' => 'required',
        'profession' => 'required',
        'photo' => 'required|image',
        'piece' => 'required|image',
        'photo2' => 'required|image',
        'piece2' => 'required|image',
        'type_piece' => 'required',
        'id_piece' => 'required',
        'date_emission' => 'required',
        'date_expiration' => 'required',
    ];


    public function getClient()
    {
        $search = $this->search;
        $this->clients = Client::Where(function ($query) use ($search) {
            $query->where('numero', 'Like', '%' . $search . '%')
                ->orWhere('nom', 'Like', '%' . $search . '%')
                ->orWhere('type_piece', 'Like', '%' . $search . '%');
        })->orderBy("created_at", "asc")
            ->get();
    }

    public function loadid($client_id)
    {
        $this->client_id = $client_id;
        $client = Client::find($client_id);
        $this->photo2 = $client->photo;
        $this->photo_url2 = $client->photo_storage_path;
        $this->numero2 = $client->numero;
        $this->nom2 = $client->nom;
        $this->lieu_naissance2 = $client->lieu_naissance;
        $this->date_naissance2 = $client->date_naissance;
        $this->domicile2 = $client->domicile;
        $this->profession2 = $client->profession;
        $this->id_piece2 = $client->id_piece;
        $this->piece2 = $client->piece;
        $this->piece_url2 = $client->piece_storage_path;
        $this->type_piece2 = $client->type_piece;
        $this->date_emission2 = $client->date_emission;
        $this->date_expiration2 = $client->date_expiration;
    }

    public function store()
    {
        $this->validate([
            'numero' => 'min:8|max:8|required|unique:clients',
            'nom' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'domicile' => 'required',
            'profession' => 'required',
            'photo' => 'required|image',
            'piece' => 'required|image',
            'type_piece' => 'required',
            'id_piece' => 'required',
            'date_emission' => 'required',
            'date_expiration' => 'required',
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
            $this->close_modal();
            $this->getClient();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Ajout réussi!']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de l'ajout!"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function update()
    {
        $client = Client::find($this->client_id);
        $query = $client->update([
            'numero' => $this->numero2,
            'nom' => $this->nom2,
            'date_naissance' => $this->date_naissance2,
            'lieu_naissance' => $this->lieu_naissance2,
            'domicile' => $this->domicile2,
            'profession' => $this->profession2,
            'type_piece' => $this->type_piece2,
            'id_piece' => $this->id_piece2,
            'date_emission' => $this->date_emission2,
            'date_expiration' => $this->date_expiration2,
        ]);

        if ($query) {
            $this->close_modal();
            $this->getClient();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Modification réussi!']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de la modification!"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function updateImg()
    {
        $client = Client::find($this->client_id);

        $photo_name = $client->photo;
        $photo_public_path = $client->photo_public_path;
        $photo_storage_path = $client->photo_storage_path;
        $piece_name = $client->piece;
        $piece_public_path = $client->piece_public_path;
        $piece_storage_path = $client->piece_storage_path;

        if ($this->photo2 != $client->photo) {
            $photo_name = time() . '.' . $this->photo2->getClientOriginalName();
            $photo_public_path = "public/images/" . $photo_name;
            $photo_storage_path = "storage/images/" . $photo_name;
            $this->photo2->storeAs('public/images', $photo_name);
            if ($client->photo_public_path != null) {
                Storage::delete($client->photo_public_path);
            }
        } 
        if ($this->piece2 != $client->piece) {
            $piece_name = time() . '.' . $this->piece2->getClientOriginalName();
            $piece_public_path = "public/images/" . $piece_name;
            $piece_storage_path = "storage/images/" . $piece_name;
            $this->piece2->storeAs('public/images', $piece_name);
            if ($client->piece_public_path != null) {
                Storage::delete($client->piece_public_path);
            }
        }

        $query = $client->update([
            'photo' => $photo_name,
            'photo_public_path' => $photo_public_path,
            'photo_storage_path' => $photo_storage_path,
            'piece' => $piece_name,
            'piece_public_path' => $piece_public_path,
            'piece_storage_path' => $piece_storage_path,
        ]);

        if ($query) {
            $this->close_modal();
            $this->getClient();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Modification réussi!']
            );
            $this->dispatchBrowserEvent('close-modal');
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => "Erreur lors de la modification!"]
            );
            $this->dispatchBrowserEvent('close-modal');
        }
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($this->piece) {
            $this->piece_url =  $this->piece->temporaryUrl();
        }

        if ($this->photo) {
            $this->photo_url =  $this->photo->temporaryUrl();
        }

        /* if ($this->photo2) {
            $this->photo_url2 =  $this->photo2->temporaryUrl();
        }
        if ($this->piece2) {
            $this->piece_url2 =  $this->piece2->temporaryUrl();
        } */
    }

    public function updatedPhoto2($propertyName)
    {
        // $this->validateOnly($propertyName);

        if ($this->photo2) {
            $this->photo_url2 =  $this->photo2->temporaryUrl();
        }
    }
    public function updatedPiece2($propertyName)
    {
        // $this->validateOnly($propertyName);

        if ($this->piece2) {
            $this->piece_url2 =  $this->piece2->temporaryUrl();
        }
    }

    public function close_modal()
    {
        $this->reset([
            'nom', 'numero', 'date_naissance', 'lieu_naissance', 'domicile', 'profession', 'type_piece', 'id_piece', 'date_emission', 'date_expiration',
            'nom2', 'numero2', 'date_naissance2', 'lieu_naissance2', 'domicile2', 'profession2', 'type_piece2', 'id_piece2', 'date_emission2', 'date_expiration2',
        ]);
        /* $this->photo_url = "images/addphoto.png";
        $this->photo_url2 = "images/addphoto.png";
        $this->piece_url = "images/addphoto.png";
        $this->piece_url2 = "images/addphoto.png"; */
    }
    public function delete()
    {
        $client = Client::find($this->client_id);
        if ($client->public_path != null) {
            Storage::delete($client->public_path);
        }
        $client->delete();
        $this->getClient();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }
    public function render()
    {
        $this->getClient();
        return view('livewire.gestion-client');
    }
}
