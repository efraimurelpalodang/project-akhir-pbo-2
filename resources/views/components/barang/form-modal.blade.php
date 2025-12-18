<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}">
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang<sup class=" text-danger">*</sup></label>
            <input wire:model.live="nama" type="text"
                class="form-control {{ $errors->has('nama') ? 'border-danger' : '' }}" id="nama">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <div>
                <label for="kode" class="form-label">Kode Barang<sup class=" text-danger">*</sup></label>
                <input wire:model.live="kode" type="text"
                    class="form-control {{ $errors->has('kode') ? 'border-danger' : '' }}" id="kode">
                @error('kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group d-flex">
            <div class="col-4">
                <label for="harga" class="form-label">Harga Barang<sup class=" text-danger">*</sup></label>
                <input wire:model.live="harga" type="number"
                    class="form-control {{ $errors->has('harga') ? 'border-danger' : '' }}" id="harga">
                @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="stok" class="form-label">Stok Barang<sup class=" text-danger">*</sup></label>
                <input wire:model.live="stok" type="number"
                    class="form-control {{ $errors->has('stok') ? 'border-danger' : '' }}" id="stok">
                @error('stok')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="satuan" class="form-label">Satuan<sup class="text-danger">*</sup></label>
                <select wire:model="satuan" id="satuan"
                    class="form-control {{ $errors->has('satuan') ? 'border-danger' : '' }}">
                    <option selected>-- Pilih --</option>
                    @foreach ($satuans as $satuan)
                        <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                    @endforeach
                </select>
                @error('satuan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
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
