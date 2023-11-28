<div class="py-3 px-3 ">

    <x-loading-indicator />

    <div class="@if ($currentStep != 1) d-none @endif">

        <div class="mb-3 ">
            <label for="codepin" class="form-label">PIN</label>
            <input type="text" wire:model.defer="codepin" class="form-control" id="codepin" placeholder="" required>
            <span class="text-danger">
                @error('codepin')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <button type="button" wire:click="checkpin" class="btn btn-primary">ENTRER </button>
    </div>

    <div class="@if ($currentStep != 2) d-none @endif">
        <form wire:submit.prevent="send">
            <div class="mb-3">
                <label for="from" class="form-label">Envoyeur</label>
                <input type="text" wire:model.defer="from" class="form-control" id="from"
                    placeholder="Ex: 77123456" required>
                <span class="text-danger">
                    @error('from')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="destinataire" class="form-label">Numero</label>
                <input type="text" wire:model.defer="destinataire" class="form-control" id="destinataire"
                    placeholder="Ex: 77123456" required>
                <span class="text-danger">
                    @error('destinataire')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="mb-3">
                <label for="texte" class="form-label">Texte</label>
                <input type="text" wire:model.defer="texte" class="form-control" id="texte"
                    placeholder="Ex: Votre message" required>
                <span class="text-danger">
                    @error('texte')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer </button>
        </form>

    </div>

</div>
