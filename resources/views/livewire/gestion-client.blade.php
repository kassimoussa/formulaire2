<div class="py-3 px-3">

    <x-loading-indicator />

    <div class="d-flex justify-content-between mb-4">
        <h3 class="over-title mb-2">La liste des clients </h3>

         <a data-bs-toggle="modal" data-bs-target="#newClient" class="btn  btn-outline-dark  fw-bold">Nouveau client</a>

    </div>


    <div class="d-flex justify-content-start mb-2">
        <form action="" class="col-md-6">
            <div class="input-group  mb-3">
                <span class="btn btn-dark">Chercher</span>
                <input type="text" class="form-control " wire:model="search" placeholder="Chercher par nom et numéro "
                    value="{{ $search }}">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered border- table-striped table-hover table-sm align-middle " id="">
            <thead class=" table-dark text-white text-center">
                <th scope="col">#</th>
                <th scope="col">Numero</th>
                <th scope="col">Nom</th>
                <th scope="col">Type Pièce</th>
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
                        <tr>
                            <td>{{ $cnt }}</td>
                            <td>{{ $client->numero }}</td>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->type_piece }}</td>
                            <td class="td-actions ">
                                <a data-bs-toggle="modal" data-bs-target="#showClient"
                                    wire:click="loadid('{{ $client->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <a data-bs-toggle="modal" data-bs-target="#showImg"
                                    wire:click="loadid('{{ $client->id }}')" class="btn " data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="Modifier les images">
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
                        <td colspan="10">There are no data.</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- <div class="d-flex justify-content-center">
            {{ $clients->links() }}
        </div> --}}

        <x-delete-modal delmodal="delete" message="Confirmer la suppression " delf="delete" />

    </div>

    <div class="modal fade" id="showClient" tabindex="-1" aria-hidden="true" wire:ignore.self>

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

                    <div class="modal-body px-2">

                        <div class="card">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur le client</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">

                                    {{-- <div
                                        class=" mt-2 col-2 d-flex justify-content-center align-items-center ">
                                        <x-loading-indicator />
                                        <a id="imgupload" class=""
                                            onclick="$('#photoInput2').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la photo du client " disabled>
                                            <img alt="Photo du client" hover="Photo du client"
                                                src="{{ asset($photo_url) }}" class="rounded float-start "
                                                id="avatar" height="150" width="200">
                                        </a>
                                        <input type="file" wire:model="photo2" id="photoInput2" class="dimage"
                                            style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('photo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}

                                    <div class="mt-1 col-2 d-flex justify-content-center align-items-center ">
                                        <img alt="Photo du client" hover="Photo du client" src="{{ asset($photo_url2) }}"
                                            class="rounded float-start " id="avatar" height="150" width="200">
                                    </div>

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
                                                    <input type="text" class="form-control" id="numero"
                                                        wire:model.defer="numero2" placeholder="ex: 77123456 " required>
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

                                    {{-- <div
                                        class=" mt-2 col-2 d-flex justify-content-center align-items-center position-relative">
                                        <x-loading-indicator />
                                        <a id="imgupload" class=""
                                            onclick="$('#photoInput2').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la photo du client " disabled>
                                            <img alt="Photo du client" hover="Photo du client"
                                                src="{{ asset($photo_url) }}" class="rounded float-start "
                                                id="avatar" height="150" width="200">
                                        </a>
                                        <input type="file" wire:model="photo2" id="photoInput2" class="dimage"
                                            style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('photo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div> --}}

                                    <div class="mt-1 col-3 d-flex justify-content-center align-items-center ">
                                        <img alt="Pièce du client" hover="Pièce du client"
                                            src="{{ asset($piece_url2) }}" class="rounded float-start "
                                            id="avatar" height="150" width="300">
                                    </div>

                                    <div class="col-9">
                                        <div class="row">

                                            <div class="mt-1 col-6 ">
                                                <label for="id_piece2" class="form-label text-muted fw-italic mb-0">
                                                    N° de Pièce
                                                    *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text txt fw-bold  text-white">
                                                        <i class="fa-solid fa-phone text-dark"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="id_piece2"
                                                        wire:model.defer="id_piece2"
                                                        placeholder="Ex: N° de CNI ou N° de Passport, etc" required>
                                                </div>
                                                <span class="text-danger">
                                                    @error('id_piece2')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                            <div class="mt-1 col-6">
                                                <label for="type_piece2"
                                                    class="form-label text-muted fw-italic mb-0">Nom
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

                    <div class="modal-body px-2">

                        <div class="card">
                            <div class="card-header bg-dark text-center text-white">
                                <h3> Informations sur le client</h3>
                            </div>

                            <div class="card-body">
                                <div class="row ">

                                    <div
                                        class=" mt-2 col-2 d-flex justify-content-center align-items-center "> 
                                        <a id="imgupload" class=""
                                            onclick="$('#photoInput').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la photo du client " disabled>
                                            <img alt="Photo du client" hover="Photo du client"
                                                src="{{ asset($photo_url) }}" class="rounded float-start "
                                                id="avatar" height="150" width="200" required>
                                        </a>
                                        <input type="file" wire:model.lazy="photo" id="photoInput" class="dimage"
                                            style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('photo')
                                                {{ $message }}
                                            @enderror
                                        </span>
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
                                                        wire:model.defer="numero" placeholder="ex: 77123456 " required>
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

                                    <div
                                        class=" mt-2 col-3 d-flex justify-content-center align-items-center "> 
                                        <a id="imgupload" class=""
                                            onclick="$('#pieceInput').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la photo du client " disabled>
                                            <img alt="Pièce du client" hover="Pièce du client"
                                                src="{{ asset($piece_url) }}" class="rounded float-start "
                                                id="avatar" height="150" width="300">
                                        </a>
                                        <input type="file" wire:model.lazy="piece" id="pieceInput" class="dimage"
                                            style="display: none;" accept="image/*" required>
                                        <span class="text-danger">
                                            @error('piece')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                   {{--  <div class="mt-1 col-3 d-flex justify-content-center align-items-center ">
                                        <img alt="Pièce du client" hover="Pièce du client"
                                            src="{{ asset($piece_url2) }}" class="rounded float-start "
                                            id="avatar" height="150" width="300">
                                    </div> --}}

                                    <div class="col-9">
                                        <div class="row">

                                            <div class="mt-1 col-6 ">
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

                                            <div class="mt-1 col-6">
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

                                            <div class="mt-2 col-6 ">
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

                                            <div class="mt-2 col-6 ">
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

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showImg" tabindex="-1" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-fullscreen " role="document">
            <div class="modal-content ">
                <form wire:submit.prevent="updateImg">

                    <div class="modal-header bg-dark text-white d-flex ">
                        <div class="col-6 text-end">
                            <h3 class="fw-bold">Pièce et photo du client</h3>
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

                    <div class="modal-body px-2">
                        <div class="d-flex">

                            <div class="card col-md-6">
                                <div class="card-header bg-dark text-center text-white">
                                    <h3> Photo de profil</h3>
                                </div>
    
                                <div class="card-body text-center">
                                    <div
                                        class=" mt-2  ">
                                        <a id="" class=""
                                            onclick="$('#photoInput2').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la photo du client " disabled>
                                            <img alt="Photo du client" hover="Photo du client"
                                                src="{{ asset($photo_url2) }}" class="rounded   "
                                                id="avatar" height="150" width="200">
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
    
                            <div class="card col-md-6 ">
                                <div class="card-header bg-dark text-center text-white">
                                    <h3> Pièce d'identité</h3>
                                </div>
    
                                <div class="card-body text-center">
                                    <div
                                        class=" ">
                                        <a id="" class=""
                                            onclick="$('#pieceInput2').trigger('click'); return false;" role="button"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter la piece du client " disabled>
                                            <img alt="piece du client" hover="piece du client"
                                                src="{{ asset($piece_url2) }}" class="rounded "
                                                id="avatar" height="150" width="300">
                                        </a>
                                        <input type="file" wire:model.lazy="piece2" id="pieceInput2" class="dimage"
                                            style="display: none;" accept="image/*">
                                        <span class="text-danger">
                                            @error('piece2')
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

    


</div>
