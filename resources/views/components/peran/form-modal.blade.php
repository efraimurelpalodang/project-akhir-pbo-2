<x-modal id="{{ $id }}" title="{{ $title }}" wire:ignore.self>
    <form>
        <div class="mb-3">
            <label>Nama Peran</label>
            <input wire:model.defer="nama" type="text" class="form-control {{ $errors->has('nama') ? 'border-danger' : '' }}">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea wire:model.defer="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'border-danger' : '' }}"></textarea>
            @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <x-slot:footer>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Batal
            </button>

            <button type="button" wire:click="{{ $event }}" class="btn btn-primary">
                {{ $rightBtn }}
            </button>
        </x-slot:footer>
    </form>
</x-modal>
