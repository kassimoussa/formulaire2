@php
    use Carbon\Carbon;
@endphp

<div class="py-3 px-3">

    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">La liste des clients enregistrés</h3>

        <a data-bs-toggle="modal" data-bs-target="#newClient" class="btn  btn-outline-dark  fw-bold"
            title="Ajouter un client">Nouveau client</a>

    </div>


    <div class="d-flex justify-content-start mb-5">
        <div class="col-md-4">
            <div class="input-group  ">
                <span class="btn btn-dark">Chercher</span>
                <input type="search" class="form-control " wire:model="search"
                    placeholder="Chercher par nom et numéro " value="{{ $search }}">
            </div>
        </div>

        <div class="btn-group px-2 dropdown-center " wire:ignore >
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                data-bs-auto-close="false" aria-expanded="false">
                <span class="fw-bold  ">Date </span>
            </button>
            <ul class="dropdown-menu custom-width"   >
                <div class="row ">
                    <li class="col-md-6">
                        <div class="dropdown-item ">
                            <div class="input-group  ">
                                <span class="btn btn-dark">Debut</span>
                                <input type="date" class="form-control " wire:model.debounce="date_from">
                            </div>
                        </div>
                    </li>
                    <li class="col-md-6">
                        <div class="dropdown-item ">
                            <div class="input-group  ">
                                <span class="btn btn-dark">Fin</span>
                                <input type="date" class="form-control " wire:model.debounce="date_to">
                            </div>
                        </div>
                    </li>
                </div>
            </ul>
        </div>

        <div class="btn-group px-2 " wire:ignore >
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                data-bs-auto-close="false" aria-expanded="false">
                <span class="fw-bold px-2 ">Pièce d'identité </span>
            </button>
            <ul class="dropdown-menu">
                <div class="row ">
                    <li class="col">
                        <div class="dropdown-item ">
                            <input type="checkbox" class="form-check-input pe-1" wire:model="selected_type_piece"
                                id="choix_CNI" value="CNI">
                            <label class="form-check-label" for="choix_CNI"> CNI </label>
                        </div>
                    </li> 
                    <li class="col">
                        <div class="dropdown-item ">
                            <input type="checkbox" class="form-check-input pe-1" wire:model="selected_type_piece"
                                id="choix_pass" value="Passport">
                            <label class="form-check-label" for="choix_pass"> Passport </label>
                        </div>
                    </li> 
                    <li class="col">
                        <div class="dropdown-item ">
                            <input type="checkbox" class="form-check-input pe-1" wire:model="selected_type_piece"
                                id="choix_tds" value="Titre de séjour">
                            <label class="form-check-label" for="choix_tds"> Titre de séjour </label>
                        </div>
                    </li> 
                    <li class="col">
                        <div class="dropdown-item ">
                            <input type="checkbox" class="form-check-input pe-1" wire:model="selected_type_piece"
                                id="choix_cdr" value="Carte de réfugié">
                            <label class="form-check-label" for="choix_cdr"> Carte de réfugié </label>
                        </div>
                    </li> 
                </div>
            </ul>
        </div>


    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class=" table-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Type Pièce</th>
                <th scope="col">Créé par</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </thead>
            <tbody class="text-center">
                @if ($clients->isNotEmpty())
                    @php
                        $cnt = 1;
                        $editmodal = 'edit' . $cnt;
                        $delmodal = 'delete' . $cnt;
                    @endphp
                    @foreach ($clients as $client)
                        @php
                            if ($client->photo) {
                                $pprofil = $client->photo_storage_path;
                            } else {
                                $pprofil = 'https://ui-avatars.com/api/?size=235&name=' . $client->nom;
                            }
                        @endphp
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td><img style="width: 60px; height: 60px; oject-fit: cover;" src="{{ asset($pprofil) }}"
                                    alt="Photo" role="button" wire:click="loadid('{{ $client->id }}')"
                                    data-bs-toggle="modal" data-bs-target="#updPhoto"> </td>
                            <td>{{ $client->numero }}</td>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->type_piece }}</td>
                            <td>{{ optional($client->user)->name ?? 'Le client' }}</td>
                            <td>{{ Carbon::parse( $client->created_at)->format('d/m/Y') }}</td>
                            <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#updClient"
                                    wire:click="loadid('{{ $client->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <a data-bs-toggle="modal" data-bs-target="#updPiece"
                                    wire:click="loadid('{{ $client->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier la pièce d'identité">
                                    <i class="fas fa-images"></i>
                                </a>


                                <a class="btn  " data-bs-toggle="modal" data-bs-target="#delete"
                                    wire:click="loadid('{{ $client->id }}')">
                                    <i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Supprimer le client "></i>
                                </a>
                            </td>
                        </tr>
                        @php
                            $cnt = $cnt + 1;
                            $editmodal = 'edit' . $cnt;
                            $delmodal = 'delete' . $cnt;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">Aucun client trouvé.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $clients->links() }}
        </div>

        <x-delete-modal delmodal="delete" message="Confirmer la suppression " delf="delete" />

    </div>


    <div class="modal fade" id="updPhoto" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-md " role="document">
            <form wire:submit.prevent="updatePhoto">
                <div class="modal-content ">
                    <div class="card">
                        <div class="card-header bg-dark text-white  d-flex">
                            <div class="col-6 text-start">
                                <h3 class="fw-bold">Photo</h3>
                            </div>

                            <div class="col-6 text-end pe-3">
                                <div class="row">
                                    <div class="">
                                        <button type="submit" name="submit"
                                            class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                        <button type="reset" wire.click="close_modal"
                                            class="btn btn-danger square fw-bold" data-bs-dismiss="modal"><i
                                                class="fas fa-times" title="Annuler"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex justify-content-center align-items-center ">
                            <a class="" style="height: 200px; width: 300px;"
                                onclick="$('#photoInput2').trigger('click'); return false;" role="button"
                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Cliquer pour ajouter la photo du client " disabled>
                                <img alt="Photo du client" hover="Photo du client" src="{{ asset($photo_url2) }}"
                                    class="rounded  cover-image" id="avatar" required>
                            </a>
                            <input type="file" wire:model.lazy="photo2" id="photoInput2" class="dimage"
                                style="display: none;" accept="image/*">
                            <span class="text-danger">
                                @error('photo2')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <div class="modal fade" id="updPiece" tabindex="-1" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-fullscreen " role="document">
            <div class="modal-content ">
                <form wire:submit.prevent="updatePiece">

                    <div class="modal-header bg-dark text-white d-flex ">
                        <div class="col-6 text-end">
                            <h3 class="fw-bold">Pièce d'identité du client</h3>
                        </div>

                        <div class="col-6 text-end pe-3">
                            <div class="row">
                                <div class="">
                                    <button type="submit" name="submit"
                                        class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                    <button type="reset" wire.click="close_modal"
                                        class="btn btn-danger square fw-bold" data-bs-dismiss="modal"><i
                                            class="fas fa-times" title="Annuler"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body ">
                        <div class="row my-2">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white  text-center">Recto de la pièce</div>
                                    <div class="card-body d-flex justify-content-center align-items-center ">
                                        <a class="" style="height: 200px; width: 400px;"
                                            onclick="$('#piece_rectoInput2').trigger('click'); return false;"
                                            role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter le recto de la pièce d'identité " disabled>
                                            <img alt="Recto de la pièce" hover="Recto de la pièce"
                                                src="{{ asset($piece_recto_url2) }}" class="rounded cover-image "
                                                id="avatar">
                                        </a>
                                        <input type="file" wire:model.lazy="piece_recto2" id="piece_rectoInput2"
                                            class="dimage" style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('piece_recto2')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-dark text-white  text-center">Verso de la pièce</div>
                                    <div class="card-body d-flex justify-content-center align-items-center ">
                                        <a class="" style="height: 200px; width: 400px;"
                                            onclick="$('#piece_versoInput2').trigger('click'); return false;"
                                            role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter le verso de la pièce d'identité " disabled>
                                            <img alt="Verso de la pièce" hover="Verso de la pièce"
                                                src="{{ asset($piece_verso_url2) }}" class="rounded  cover-image "
                                                id="avatar">
                                        </a>
                                        <input type="file" wire:model.lazy="piece_verso2" id="piece_versoInput2"
                                            class="dimage" style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('piece_verso2')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newClient" tabindex="-1" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-fullscreen " role="document">
            <div class="modal-content ">
                <form wire:submit.prevent="store">

                    <div class="modal-header bg-dark text-white d-flex ">
                        <div class="col-6 text-end">
                            <h3 class="fw-bold">Info client</h3>
                        </div>

                        <div class="col-6 text-end pe-3">
                            <div class="row">
                                <div class="">
                                    <button type="submit" name="submit"
                                        class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                    <button type="reset" wire.click="close_modal"
                                        class="btn btn-danger square fw-bold" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body  scrollable-modal px-2">

                        <div class="card">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur le client</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">

                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center">Photo</div>
                                            <div class="card-body d-flex justify-content-center align-items-center ">
                                                <a class="" style="height: 150px; width: 200px;"
                                                    onclick="$('#photoInput').trigger('click'); return false;"
                                                    role="button" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom"
                                                    title="Cliquer pour ajouter la photo du client " disabled>
                                                    <img alt="Photo du client" hover="Photo du client"
                                                        src="{{ asset($photo_url) }}" class="rounded  cover-image"
                                                        id="avatar" required>
                                                </a>
                                                <input type="file" wire:model.lazy="photo" id="photoInput"
                                                    class="dimage" style="display: none;" accept="image/*">
                                                <span class="text-danger">
                                                    @error('photo')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-1 col-2 d-flex justify-content-center align-items-center ">
                                        <img alt="Photo du client" hover="Photo du client" src="{{ asset($photo_url2) }}"
                                            class="rounded float-start " id="avatar" height="150" width="200">
                                    </div> --}}

                                    <div class="col-10">
                                        <div class="row">

                                            <div class="mt-1 col-6 ">
                                                <label for="numero"
                                                    class="form-label text-muted fw-italic mb-0">Numero
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-phone text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="numero"
                                                        wire:model.defer="numero" placeholder="ex: 77123456 "
                                                        required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('numero')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-1 col-6">
                                                <label for="nom" class="form-label text-muted fw-italic mb-0">Nom
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fas fa-user text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="nom"
                                                        wire:model.defer="nom" placeholder="Nom du client " required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('nom')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6 ">
                                                <label for="date_naissance"
                                                    class="form-label text-muted fw-italic mb-0">Date de
                                                    naissance
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_naissance"
                                                        wire:model="date_naissance" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_naissance')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="lieu_naissance"
                                                    class="form-label text-muted fw-italic mb-0">Lieu de naissance
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="lieu_naissance"
                                                        wire:model.defer="lieu_naissance"
                                                        placeholder="Lieu de naissance du client" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('lieu_naissance')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="domicile"
                                                    class="form-label text-muted fw-italic mb-0">Domicile
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="domicile"
                                                        wire:model.defer="domicile" placeholder="Adresse du client"
                                                        required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('domicile')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="profession"
                                                    class="form-label text-muted fw-italic mb-0">Profession
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="profession"
                                                        wire:model.defer="profession"
                                                        placeholder="Profession du client" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('profession')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card mt-2">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur la pièce d'identité</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">
                                    <div class="col">
                                        <div class="row">

                                            <div class="mt-1 col-md-6 ">
                                                <label for="id_piece" class="form-label text-muted fw-italic mb-0">
                                                    N° de Pièce
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-phone text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="id_piece"
                                                        wire:model.defer="id_piece"
                                                        placeholder="Ex: N° de CNI ou N° de Passport, etc" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('id_piece')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-1 col-md-6">
                                                <label for="type_piece"
                                                    class="form-label text-muted fw-italic mb-0">Type de pièce
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fas fa-user text-dark"></i>
                                                    </span>
                                                    <select wire:model.defer="type_piece" class="form-select w-25"
                                                        id="type_piece" required>
                                                        <option value="" selected>Choisir</option>
                                                        <option value="CNI">CNI</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="Titre de séjour">Titre de séjour</option>
                                                        <option value="Carte de réfugié">Carte de réfugié</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger">
                                                    @error('type_piece')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-md-6 ">
                                                <label for="date_emission"
                                                    class="form-label text-muted fw-italic mb-0">Date d'émission
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_emission"
                                                        wire:model="date_emission" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_emission')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-md-6 ">
                                                <label for="date_expiration"
                                                    class="form-label text-muted fw-italic mb-0">Date d'expiration
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_expiration"
                                                        wire:model="date_expiration" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_expiration')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="  d-flex justify-content-between  my-3 text-center">
                                        <div class="col-md-6 pe-1">
                                            <div class="card">
                                                <div class="card-header text-center">Recto de la pièce</div>
                                                <div
                                                    class="card-body d-flex justify-content-center align-items-center ">
                                                    <a class="" style="height: 200px; width: 400px;"
                                                        onclick="$('#piece_rectoInput').trigger('click'); return false;"
                                                        role="button" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Cliquer pour ajouter le recto de la pièce d'identité "
                                                        disabled>
                                                        <img alt="Recto de la pièce" hover="Recto de la pièce"
                                                            src="{{ asset($piece_recto_url) }}"
                                                            class="rounded cover-image " id="avatar">
                                                    </a>
                                                    <input type="file" wire:model.lazy="piece_recto"
                                                        id="piece_rectoInput" class="dimage" style="display: none;"
                                                        accept="image/*" required>
                                                    <span class="text-danger">
                                                        @error('piece_recto')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-1 ">
                                            <div class="card">
                                                <div class="card-header text-center">Verso de la pièce</div>
                                                <div
                                                    class="card-body d-flex justify-content-center align-items-center ">
                                                    <a class="" style="height: 200px; width: 400px;"
                                                        onclick="$('#piece_versoInput').trigger('click'); return false;"
                                                        role="button" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom"
                                                        title="Cliquer pour ajouter le verso de la pièce d'identité "
                                                        disabled>
                                                        <img alt="Verso de la pièce" hover="Verso de la pièce"
                                                            src="{{ asset($piece_verso_url) }}"
                                                            class="rounded  cover-image " id="avatar">
                                                    </a>
                                                    <input type="file" wire:model.lazy="piece_verso"
                                                        id="piece_versoInput" class="dimage" style="display: none;"
                                                        accept="image/*" required>
                                                    <span class="text-danger">
                                                        @error('piece_verso')
                                                            {{ $message }}
                                                        @enderror
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updClient" tabindex="-1" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-fullscreen " role="document">
            <div class="modal-content ">
                <form wire:submit.prevent="update">

                    <div class="modal-header bg-dark text-white d-flex ">
                        <div class="col-6 text-end">
                            <h3 class="fw-bold">Info client</h3>
                        </div>

                        <div class="col-6 text-end pe-3">
                            <div class="row">
                                <div class="">
                                    <button type="submit" name="submit"
                                        class="btn btn-success square border-0  fw-bold">Enregistrer</button>
                                    <button type="reset" wire.click="close_modal"
                                        class="btn btn-danger square fw-bold" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body  scrollable-modal px-2">

                        <div class="card">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur le client</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">

                                    <div class="col-md-2">
                                        <div class="card">
                                            <div class="card-header text-center">Photo</div>
                                            <div class="card-body d-flex justify-content-center align-items-center ">
                                                <img alt="Photo du client" hover="Photo du client"
                                                    style="height: 150px; width: 200px;"
                                                    src="{{ asset($photo_url2) }}" class="rounded  cover-image"
                                                    id="avatar">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-1 col-2 d-flex justify-content-center align-items-center ">
                                        <img alt="Photo du client" hover="Photo du client" src="{{ asset($photo_url2) }}"
                                            class="rounded float-start " id="avatar" height="150" width="200">
                                    </div> --}}

                                    <div class="col-10">
                                        <div class="row">

                                            <div class="mt-1 col-6 ">
                                                <label for="numero2"
                                                    class="form-label text-muted fw-italic mb-0">Numero
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-phone text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="numero2"
                                                        wire:model.defer="numero2" placeholder="ex: 77123456 "
                                                        required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('numero2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-1 col-6">
                                                <label for="nom2" class="form-label text-muted fw-italic mb-0">Nom
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fas fa-user text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="nom2"
                                                        wire:model.defer="nom2" placeholder="Nom du client " required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('nom2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6 ">
                                                <label for="date_naissance2"
                                                    class="form-label text-muted fw-italic mb-0">Date de
                                                    naissance
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_naissance2"
                                                        wire:model="date_naissance2" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_naissance2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="lieu_naissance2"
                                                    class="form-label text-muted fw-italic mb-0">Lieu de naissance
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="lieu_naissance2"
                                                        wire:model.defer="lieu_naissance2"
                                                        placeholder="Lieu de naissance du client" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('lieu_naissance2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="domicile2"
                                                    class="form-label text-muted fw-italic mb-0">Domicile
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="domicile2"
                                                        wire:model.defer="domicile2" placeholder="Adresse du client"
                                                        required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('domicile2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6">
                                                <label for="profession2"
                                                    class="form-label text-muted fw-italic mb-0">Profession
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-location-dot  text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="profession2"
                                                        wire:model.defer="profession2"
                                                        placeholder="Profession du client" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('profession2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="card mt-2">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur la pièce d'identité</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">
                                    <div class="col">
                                        <div class="row">

                                            <div class="mt-1 col-6 ">
                                                <label for="id_pieceé" class="form-label text-muted fw-italic mb-0">
                                                    N° de Pièce
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-phone text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="id_pieceé"
                                                        wire:model.defer="id_pieceé"
                                                        placeholder="Ex: N° de CNI ou N° de Passport, etc" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('id_pieceé')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-1 col-6">
                                                <label for="type_piece2"
                                                    class="form-label text-muted fw-italic mb-0">Type de pièce
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fas fa-user text-dark"></i>
                                                    </span>
                                                    <select wire:model.defer="type_piece2" class="form-select w-25"
                                                        id="type_piece2" required>
                                                        <option value="" selected>Choisir</option>
                                                        <option value="CNI">CNI</option>
                                                        <option value="Passport">Passport</option>
                                                        <option value="Titre de séjour">Titre de séjour</option>
                                                        <option value="Carte de réfugié">Carte de réfugié</option>
                                                    </select>
                                                </div>
                                                <span class="text-danger">
                                                    @error('type_piece2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6 ">
                                                <label for="date_emission2"
                                                    class="form-label text-muted fw-italic mb-0">Date d'émission
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_emission2"
                                                        wire:model="date_emission2" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_emission2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-2 col-6 ">
                                                <label for="date_expiration2"
                                                    class="form-label text-muted fw-italic mb-0">Date d'expiration
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-calendar-days  text-dark"></i>
                                                    </span>
                                                    <input type="date" class="form-control " id="date_expiration2"
                                                        wire:model="date_expiration2" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('date_expiration2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="  d-flex justify-content-between  my-3 text-center">
                                        <div class="col-md-6 pe-1">
                                            <div class="card">
                                                <div class="card-header text-center">Recto de la pièce</div>
                                                <div
                                                    class="card-body d-flex justify-content-center align-items-center ">
                                                    <img alt="Recto de la pièce" hover="Recto de la pièce"
                                                        style="height: 200px; width: 400px;"
                                                        src="{{ asset($piece_recto_url2) }}"
                                                        class="rounded cover-image " id="avatar">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-1">
                                            <div class="card">
                                                <div class="card-header text-center">Verso de la pièce</div>
                                                <div
                                                    class="card-body d-flex justify-content-center align-items-center ">

                                                    <img alt="Verso de la pièce" hover="Verso de la pièce"
                                                        style="height: 200px; width: 400px;"
                                                        src="{{ asset($piece_verso_url2) }}"
                                                        class="rounded  cover-image " id="avatar">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>




</div>
