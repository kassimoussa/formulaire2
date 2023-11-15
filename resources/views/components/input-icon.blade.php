<div>
    <label for="{{ $ipid }}" class="form-label text-muted fw-italic mb-0">{{ $iplabel }}
        *</label>
    <div class="input-group">
        <span class="input-group-text txt fw-bold  text-white">
            <i class="fa-solid {{ $ipicon }} text-dark"></i>
        </span>
        <input type="{{ $iptype }}" class="form-control" id="{{ $ipid }}" wire:model.defer="{{ $ipname }}"
            placeholder="{{ $ipplaceholder }}" >
    </div>
    <span class="text-danger">
        @error('{{ $ipname }}')
            {{ $message }}
        @enderror
    </span>
</div>
