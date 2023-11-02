<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="save">

        <div  class="container d-flex justify-content-center">

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
                            placeholder="Ex: 77123456">

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

                {{-- Step 1-A --}}
                <div class="@if ($currentStep != 2) d-none @endif">

                    <div class="mb-3">
                        <label for="code_envoye" class="form-label">Entrer le code</label>
                        <input type="text" wire:model="code_secret_confirmation" class="form-control"
                            id="code_envoye" placeholder="Ex: 123456">
                        <span class="text-danger">
                            @error('code_secret_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class=" ">
                            <button type="button" class="btn btn-secondary " wire:click="sendSecretCode">Réenvoyer le
                                code</button>
                        </div>

                        <div class=" ">
                            <button type="button" class="btn btn-primary " wire:click="step2a">Continuer</button>
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

        <div class="card w-75 my-3 @if ($currentStep != 3) d-none @endif">
            <div class="card-header">
                <h3 class="card-title fw-light mb-1">Deuxième étape</h3>
            </div>

            <div class="card-body">
                <div class="">

                    <div class="mb-3">
                        <label for="nom_client" class="form-label">Entrer votre nom</label>
                        <input type="text" wire:model="nom" class="form-control" id="nom_client"
                            placeholder="Ex: Hamadou Hamid Houmed">

                        <span class="text-danger">
                            @error('nom')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="mb-3">
                        <label for="file_client" class="form-label">Ajouter votre pièce d'identité</label>
                        <div class="input-group">
                            <select wire:model.defer="type_piece" class="form-select w-25" id="file_client">
                                <option value="" selected>Select</option>
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
                    <div class="mb-3">
                        <div class=" d-flex justify-content-center align-items-center position-relative">
                            <x-loading-indicator />
                            <a id="imgupload" class="" onclick="$('#imginput').trigger('click'); return false;"
                                role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="Clicker pour ajouter l'image du materiel ">
                                <img alt="Image du materiel" hover="Image du materiel" src="{{ asset($piece_url) }}"
                                    class="avatar border border-1 " id="avatar" width="100%" height="200">
                            </a>
                            <input type="file" wire:model="piece" id="imginput" class="dimage"
                                style="display: none;" onchange="readURL(this);" accept="image/*">
                        </div>
                        <span class="text-danger">
                            @error('piece')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-primary "wire:click="save">Enregistrer</button>
                    </div>
                </div>
            </div>

        </div>


        <div class=" card w-75 my-3 @if ($currentStep != 4) d-none @endif"> 
            <div class="card-body ">
                <h5 class="text-center"><i class="fas fa-check-circle fa-5x text-success"></i>
                </h5>
                <h3 class="text-center">L'enregistrement de vos informations s'est passé avec succès !</h3>
            </div>
        </div>

        <div class=" card w-75 my-3 @if ($currentStep != 5) d-none @endif"> 
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
