<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}">
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pembeli<sup class=" text-danger">*</sup></label>
            <input wire:model.live="nama" type="text"
                class="form-control {{ $errors->has('nama') ? 'border-danger' : '' }}" id="nama">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <div>
                <label for="telp" class="form-label">Nomor Telpon<sup class=" text-danger">*</sup></label>
                <input wire:model.live="telp" type="text"
                    class="form-control {{ $errors->has('telp') ? 'border-danger' : '' }}" id="telp">
                @error('telp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="alamat" class="form-label">Alamat<sup class=" text-danger">*</sup></label>
            <textarea wire:model.live="alamat" class="form-control {{ $errors->has('alamat') ? 'border-danger' : '' }}" id="alamat"></textarea>
            @error('alamat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <x-slot:footer>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Batal
            </button>
            <button wire:click="{{ $event }}" type="submit" class="btn btn-primary">
                {{ $rightBtn }}
            </button>
        </x-slot:footer>

    </form>
</x-modal>
