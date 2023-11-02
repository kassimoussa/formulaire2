<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <form wire:submit.prevent="save">
        <input type="file" wire:model="photo">
     
        @error('photo') <span class="error">{{ $message }}</span> @enderror
     
        <button type="submit">Save Photo</button>
    </form>

</div>
