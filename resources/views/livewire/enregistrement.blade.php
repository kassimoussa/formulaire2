<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="save">

        <div class="container d-flex justify-content-center">

            <div class="card w-75 my-3 @if ($currentStep >= 3) d-none @endif ">
                <div class="card-header">
                    <h3 class="card-title fw-light mb-1">Première étape</h3>
                </div>

                <div class="card-body">

                    {{-- Step 1-A --}}

                    <div class="@if ($currentStep != 1) d-none @endif">

                        <div class="mb-3">
                            <h5 class="text-muted mb-2">Un code secret de 6 chiffres vous sera envoyé par sms</h5>
                            <label for="numero_tel" class="form-label">Entrer votre numéro de téléphone</label>
                            <input type="text" wire:model="numero" class="form-control" id="numero_tel"
                                placeholder="Ex: 77123456" required>

                            <span class="text-danger">
                                @error('numero')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary " wire:click="step1a">Envoyer le code</button>
                        </div>
                    </div>

                    {{-- Step 1-B --}}
                    <div class="@if ($currentStep != 2) d-none @endif">

                        <div class="mb-3">
                            <label for="code_envoye" class="form-label">Entrer le code</label>
                            <input type="text" wire:model="code_secret_confirmation" class="form-control"
                                id="code_envoye" placeholder="Ex: 123456" required>
                            <span class="text-danger">
                                @error('code_secret_confirmation')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class=" ">
                                <button type="button" class="btn btn-secondary " wire:click="sendSecretCode">
                                    Réenvoyer le code</button>
                            </div>

                            <div class=" ">
                                <button type="button" class="btn btn-primary " wire:click="step1b">Continuer</button>
                            </div>
                        </div>

                        {{-- <div class="my-3">
                    <p>{{ $responseMessage }}</p>
                </div> --}}

                    </div>

                    @if ($code_secret)
                        {{ $code_secret }}
                    @endif


                </div>

            </div>

            {{-- Step 2 --}}

            <div class="card w-75 my-3 @if ($currentStep != 3) d-none @endif">
                <div class="card-header">
                    <h3 class="card-title fw-light mb-1">Deuxième étape</h3>
                </div>

                <div class="card-body">
                    <div class="">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="nom_client" class="form-label">Entrer votre nom</label>
                                <input type="text" wire:model="nom" class="form-control" id="nom_client"
                                    placeholder="Ex: Hamadou Hamid Houmed" required>

                                <span class="text-danger">
                                    @error('nom')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label">Entrer votre date de naissance</label>
                                <input type="date" wire:model="date_naissance" class="form-control"
                                    id="date_naissance" required>

                                <span class="text-danger">
                                    @error('date_naissance')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="lieu_naissance" class="form-label">Entrer votre lieu de naissance</label>
                                <input type="text" wire:model="lieu_naissance" class="form-control"
                                    id="lieu_naissance" placeholder="Ex: Dikhil" required>

                                <span class="text-danger">
                                    @error('lieu_naissance')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="domicile" class="form-label">Entrer votre domicile</label>
                                <input type="text" wire:model="domicile" class="form-control" id="domicile"
                                    placeholder="Ex: Einguella" required>

                                <span class="text-danger">
                                    @error('domicile')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="profession" class="form-label">Entrer votre profession</label>
                                <input type="text" wire:model="profession" class="form-control" id="profession"
                                    placeholder="Ex: Dikhil" required>

                                <span class="text-danger">
                                    @error('profession')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class=" d-flex justify-content-center align-items-center position-relative">
                                <x-loading-indicator />
                                <a id="imgupload" class="" onclick="$('#photo').trigger('click'); return false;"
                                    role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Cliqueer pour ajouter votre photo de profil ">
                                    <img alt="photo" hover="photo" src="{{ asset($photo_url) }}"
                                        class="avatar border border-1 " id="avatar" width="100%"
                                        height="200">
                                </a>
                                <input type="file" wire:model="photo" id="photo" class="dimage"
                                    style="display: none;" onchange="readURL(this);" accept="image/*"  required>
                            </div>
                            <span class="text-danger">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary " wire:click="step2">Suivant</button>
                        </div>

                    </div>
                </div>

            </div>

            <div class="card w-75 my-3 @if ($currentStep != 4) d-none @endif">
                <div class="card-header">
                    <h3 class="card-title fw-light mb-1">Troisième étape</h3>
                </div>

                <div class="card-body">
                    <div class="">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="type_piece" class="form-label">Choisir votre pièce d'identité</label>
                                <div class="input-group">
                                    <select wire:model.defer="type_piece" class="form-select w-25" id="type_piece" required>
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

                            <div class="col-md-6 mb-3">
                                <label for="id_piece" class="form-label">Entrer le N° de votre pièce
                                    d'identité</label>
                                <input type="text" wire:model="id_piece" class="form-control" id="id_piece"
                                    placeholder="Ex: N° de CNI ou N° de Passport, etc" required>

                                <span class="text-danger">
                                    @error('id_piece')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_emission" class="form-label">Entrer la date d'emission de votre pièce
                                    d'identité</label>
                                <input type="date" wire:model="date_emission" class="form-control"
                                    id="date_emission" required>

                                <span class="text-danger">
                                    @error('date_emission')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_expiration" class="form-label">Entrer la date d'expiration de votre
                                    pièce d'identité</label>
                                <input type="date" wire:model="date_expiration" class="form-control"
                                    id="date_expiration" required>

                                <span class="text-danger">
                                    @error('date_expiration')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class=" d-flex justify-content-center align-items-center position-relative">
                                <x-loading-indicator />
                                <a id="imgupload" class=""
                                    onclick="$('#imginput').trigger('click'); return false;" role="button"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Clicker pour ajouter votre pièce d'identité ">
                                    <img alt="Pièce d'identité" hover="Pièce d'identité"
                                        src="{{ asset($piece_url) }}" class="avatar border border-1 " id="avatar"
                                        width="100%" height="200">
                                </a>
                                <input type="file" wire:model="piece" id="imginput" class="dimage"
                                    style="display: none;" onchange="readURL(this);" accept="image/*" required>
                            </div>
                            <span class="text-danger">
                                @error('piece')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary " wire:click="save">Enregistrer</button>
                        </div>
                    </div>
                </div>

            </div>


            <div class=" card w-75 my-3 @if ($currentStep != 5) d-none @endif">
                <div class="card-body ">
                    <h5 class="text-center"><i class="fas fa-check-circle fa-5x text-success"></i>
                    </h5>
                    <h3 class="text-center">L'enregistrement de vos informations s'est passé avec succès !</h3>
                </div>
            </div>

            <div class=" card w-75 my-3 @if ($currentStep != 6) d-none @endif">
                <div class="card-body ">
                    <h5 class="text-center"><i class="fas fa-time-circle fa-5x text-danger"></i>
                    </h5>
                    <h3 class="text-center">L'enregistrement de vos informations a échoué. Veuillez réessayer. </h3>
                </div>
            </div>

        </div>


    </form>


    {{--
    @if ($code_secret_confirmation)
        {{ $code_secret_confirmation }}
    @endif

    @if ($currentStep)
        {{ $currentStep }}
    @endif

    <div class="d-flex Justify-content-between  ">

        <button type="button" wire:click="step_decrement" class="btn btn-secondary ">
            RETOUR
        </button>



        <button type="button" wire:click="step_increment" class="btn btn-primary ">
            SUIVANT
        </button>

    </div> --}}

</div>
