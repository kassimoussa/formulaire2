<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class GestionUser extends Component
{
    public $users, $user_id, $name, $username, $email, $password, $level;
    public $name2, $username2, $email2, $password2, $level2;
    public $search = "";
    public function getUsers()
    {
        $search = $this->search;
        $this->users = User::Where(function ($query) use ($search) {
            $query->where('name', 'Like', '%' . $search . '%')
                ->orWhere('username', 'Like', '%' . $search . '%');
        })->orderBy("created_at", "asc")
            ->get();
    }
    protected $rules = [
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'level' => 'required', 
    ];
    public function messages()
    {
        return [
            'name.required' => 'Vous devez entrer un nom.', 
            'username.required' => 'Vous devez entrer un pseudo.',
            'email.required' => 'Vous devez entrer un email.',
            'email.email' => "L'email doit etre un email valide.",
            'email.unique' => "L'email est déjà enregitré dans la base de données.",
            'password.required' => 'Vous devez entrer un mot de passe.',
            'level.required' => "Vous devez entrer un role.",  
        ];
    }

    public function loadid($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($user_id);
        $this->name2 = $user->name;
        $this->username2 = $user->username;
        $this->email2 = $user->email;
        $this->password2 = $user->password;
        $this->level2 = $user->level; 
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->level = $this->level;
        
        $query = $user->save();
        
        if ($query) {
            $this->close_modal();
            $this->getUsers();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Ajout réussi!']
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
    public function update()
    {
        $user = User::find($this->user_id);
        $query = $user->update([
            'name' => $this->name2,
            'username' => $this->username2,
            'email' => $this->email2,
            'password' => $this->password2,
            'level' => $this->level2,
        ]);

        if ($query) {
            $this->close_modal();
            $this->getUsers();
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

    public function close_modal()
    {
        $this->reset([
            'search', 'name', 'username', 'email', 'password', 'level', 
            'name2', 'username2', 'email2', 'password2', 'level2',
        ]);
    }
    public function delete()
    {
        $user = User::find($this->user_id);
        $user->delete();
        $this->getUsers();

        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'Suppression éffectuée avec succès!']
        );
    }
    public function render()
    {
        $this->getUsers();
        return view('livewire.gestion-user');
    }
}
