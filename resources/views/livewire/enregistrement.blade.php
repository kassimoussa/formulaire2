<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="save">

        <div class="container d-flex justify-content-center ">

            <div class="card w-100 w-md-75 my-3 @if ($currentStep >= 3) d-none @endif ">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title fw-light mb-1">Première étape</h3>
                </div>

                <div class="card-body">

                    {{-- Step 1-A --}}

                    <div class="@if ($currentStep != 1) d-none @endif">

                        <div class="mb-3">
                            <h5 class="text-muted mb-3">Un code secret de 6 chiffres vous sera envoyé par sms</h5>
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
                            <input type="text" wire:model.defer="code_secret_confirmation" class="form-control"
                                id="code_envoye" placeholder="Ex: 123456" required>
                            <span class="text-danger">
                                @error('code_secret_confirmation')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="d-flex justify-content-between  mb-2" >
                            <div class="">
                                <button type="button" class="btn btn-secondary  " wire:click="sendSecretCode" wire:ignore id="restartButton">
                                    Réenvoyer<span id="timer"> dans: 2:00 </span></button>
                            </div>

                            <div class=" ">
                                <button type="button" class="btn btn-primary " wire:click="step1b">Continuer</button>
                            </div>
                        </div>

                    </div>

                    {{-- @if ($code_secret)
                        {{ $code_secret }}
                    @endif --}}


                </div>

            </div>

            {{-- Step 2 --}}

            <div class="card {{-- w-75 --}} my-3 @if ($currentStep != 3) d-none @endif">
                <div class="card-header bg-dark text-white">
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
                                    placeholder="Ex: Policier" required>

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
                                    style="display: none;" onchange="readURL(this);" accept="image/*" required>
                            </div>
                            <div class="text-danger text-center ">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-primary " wire:click="step2">Suivant</button>
                        </div>

                    </div>
                </div>

            </div>

            <div
                class="card {{-- w-75 --}} my-3 @if ($currentStep != 4) d-none @endif   position-relative">
                <x-loading-indicator />
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title fw-light mb-1">Troisième étape</h3>
                </div>

                <div class="card-body">
                    <div class="">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="type_piece" class="form-label">Choisir votre pièce d'identité</label>
                                <div class="input-group">
                                    <select wire:model.defer="type_piece" class="form-select w-25" id="type_piece"
                                        required>
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

                        <div class=" d-md-flex justify-content-between  my-3 text-center">
                            <div class="col-md-6 m-1 ">
                                <div class="card">
                                    <div class="card-header text-center">Recto de la pièce</div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <a class="" style="height: 200px; width: 400px;"
                                            onclick="$('#piece_rectoInput').trigger('click'); return false;"
                                            role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter le recto de la pièce d'identité " disabled>
                                            <img alt="Recto de la pièce" hover="Recto de la pièce"
                                                src="{{ asset($piece_recto_url) }}" class="rounded cover-image "
                                                id="avatar"{{--  height="200px" width="100%" --}}>
                                        </a>
                                        <input type="file" wire:model.lazy="piece_recto" id="piece_rectoInput"
                                            class="dimage" style="display: none;" accept="image/*" required>
                                    </div>
                                    <span class="text-danger">
                                        @error('piece_recto')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                            <div class="col-md-6 m-1 ">
                                <div class="card">
                                    <div class="card-header text-center">Verso de la pièce</div>
                                    <div class="card-body d-flex justify-content-center align-items-center ">
                                        <a class="" style="height: 200px; width: 400px;"
                                            onclick="$('#piece_versoInput').trigger('click'); return false;"
                                            role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Cliquer pour ajouter le verso de la pièce d'identité " disabled>
                                            <img alt="Verso de la pièce" hover="Verso de la pièce"
                                                src="{{ asset($piece_verso_url) }}" class="rounded  cover-image "
                                                id="avatar"{{--  width="100%" --}}>
                                        </a>
                                        <input type="file" wire:model.lazy="piece_verso" id="piece_versoInput"
                                            class="dimage" style="display: none;" accept="image/*" required>
                                    </div>
                                    <span class="text-danger">
                                        @error('piece_verso')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                            </div>
                        </div>

                        {{-- <div class="text-end">
                            <button type="button" class="btn btn-primary " wire:click="save">Enregistrer</button>
                        </div> --}}

                        <div class="d-flex justify-content-between ">

                            <button type="button" wire:click="step_decrement" class="btn btn-secondary ">
                                RETOUR
                            </button>

                            <button type="button" wire:click="step3" class="btn btn-primary ">
                                SUIVANT
                            </button>

                        </div>

                    </div>
                </div>

            </div>

            <div class="card @if ($currentStep != 5) d-none @endif">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title fw-light mb-1">Etape de vérification</h3>
                </div>

                <div class="card-body">
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
                                                role="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
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

                                <div class="col-md-10">
                                    <div class="row">

                                        <div class="mt-1 col-md-6 ">
                                            <label for="numero" class="form-label text-muted fw-italic mb-0">Numero
                                                *</label>
                                            <div class="input-group">
                                                <span class="input-group-text txt fw-bold  text-white">
                                                    <i class="fa-solid fa-phone text-dark"></i>
                                                </span>
                                                <input type="text" class="form-control" id="numero"
                                                    wire:model.defer="numero" placeholder="ex: 77123456 " disabled
                                                    required>
                                            </div>
                                            <span class="text-danger">
                                                @error('numero')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>

                                        <div class="mt-1 col-md-6">
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

                                        <div class="mt-2 col-md-6 ">
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

                                        <div class="mt-2 col-md-6">
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

                                        <div class="mt-2 col-md-6">
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

                                        <div class="mt-2 col-md-6">
                                            <label for="profession"
                                                class="form-label text-muted fw-italic mb-0">Profession
                                                *</label>
                                            <div class="input-group">
                                                <span class="input-group-text txt fw-bold  text-white">
                                                    <i class="fa-solid fa-tools  text-dark"></i>
                                                </span>
                                                <input type="text" class="form-control" id="profession"
                                                    wire:model.defer="profession" placeholder="Profession du client"
                                                    required>
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
                                            <label for="type_piece" class="form-label text-muted fw-italic mb-0">Type
                                                de pièce
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

                                <div class="  d-md-flex justify-content-between  my-3 text-center">
                                    <div class="col-md-6 m-1">
                                        <div class="card">
                                            <div class="card-header text-center">Recto de la pièce</div>
                                            <div class="card-body d-flex justify-content-center align-items-center ">
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
                                    <div class="col-md-6 m-1 ">
                                        <div class="card">
                                            <div class="card-header text-center">Verso de la pièce</div>
                                            <div class="card-body d-flex justify-content-center align-items-center ">
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

                    <div class="d-flex justify-content-between my-2">

                        <button type="button" wire:click="step_decrement" class="btn btn-secondary ">
                            RETOUR
                        </button>

                        <div class="text-end">
                            <button type="button" class="btn btn-success " wire:click="save">Enregistrer</button>
                        </div>

                    </div>

                </div>
            </div>



            {{--  <div class=" card w-75 my-3 p-3 @if ($currentStep != 6) d-none @endif">
                <div class="card-body ">
                    <h5 class="text-center"><i class="fas fa-check-circle fa-5x text-success"></i> </h5>
                    <h3 class="text-center">
                        L'enregistrement de
                        vos informations s'est déroulé avec succès !</h3>
                </div>
            </div> --}}

            {{-- <div class=" card w-75 my-3 p-3 @if ($currentStep != 7) d-none @endif">
                <div class="card-body ">
                    <h5 class="text-center"><i class="fas fa-time-circle fa-5x text-danger"></i>
                    </h5>
                    <h3 class="text-center">L'enregistrement de vos informations a échoué. Veuillez réessayer. </h3>
                </div>
            </div> --}}

        </div>


    </form>


    <script>
        const restartButton = document.getElementById('restartButton');

        document.addEventListener('livewire:load', function() {
            var countdownInterval; // Declare the interval variable outside the event listener

            Livewire.on('startCountdown', function() {
                restartButton.disabled = true;

                // Clear the existing countdown interval if it exists
                if (countdownInterval) {
                    clearInterval(countdownInterval);
                }

                // Set the initial countdown time in seconds
                var countdownTime = 120; // 2 minutes

                // Get the timer element
                var timerElement = document.getElementById('timer');

                // Update the countdown every second
                countdownInterval = setInterval(function() {
                    var minutes = Math.floor(countdownTime / 60);
                    var seconds = countdownTime % 60;

                    // Display the countdown in the timer element
                    timerElement.textContent = " dans: " +  minutes + ':' + (seconds < 10 ? '0' : '') + seconds;

                    // Decrease the countdown time
                    countdownTime--;

                    // Check if the countdown has reached zero
                    if (countdownTime < 0) {
                        clearInterval(countdownInterval);
                        timerElement.textContent = '';
                        restartButton.disabled = false;
                        //Livewire.emit('startCountdown'); // Restart the countdown
                    }
                }, 1000);
            });
        });
    </script>

    {{-- <script>
        document.addEventListener('livewire:load', function() {
            const countdownContainer = document.getElementById('countdownContainer');
            const countdownElement = document.getElementById('countdown');
            const startButton = document.getElementById('startButton');

            Livewire.on('startCountdownjs', (countdownTime) => {
                startButton.disabled = true;
                let interval = setInterval(() => {
                    countdownTime--;
                    countdownElement.textContent = countdownTime; 

                    if (countdownTime <= 0) {
                        clearInterval(interval);
                        countdownElement.textContent = '0';
                        startButton.disabled = false;
                    }
                }, 1000);
            });
        });
    </script>
 --}}
</div>
