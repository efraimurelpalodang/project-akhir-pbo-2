<x-modal id="{{ $id }}" title="{{ $title }}">
    <form wire:ignore.self>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pengguna<sup class=" text-danger">*</sup></label>
            <input wire:model="nama" type="text" class="form-control {{ $errors->has('nama') ? 'border-danger' : '' }}"
                id="nama">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username<sup class=" text-danger">*</sup></label>
            <input wire:model="username" type="text"
                class="form-control {{ $errors->has('username') ? 'border-danger' : '' }}" id="username">
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">Telepon<sup class=" text-danger">*</sup></label>
            <input wire:model="telp" type="text"
                class="form-control {{ $errors->has('telp') ? 'border-danger' : '' }}" id="telp">
            @error('telp')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password<sup class="text-danger">*</sup></label>
            <input wire:model="password" type="password"
                class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" id="password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group d-flex">
            <div class="col-6">
                <label for="jk" class="form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
                <select wire:model="jk" id="jk"
                    class="form-control {{ $errors->has('jk') ? 'border-danger' : '' }}">
                    <option selected>-- Pilih --</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jk')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-6">
                <label for="peran" class="form-label">Peran<sup class="text-danger">*</sup></label>
                <select wire:model="peran" id="peran"
                    class="form-control {{ $errors->has('peran') ? 'border-danger' : '' }}">
                    <option selected>-- Pilih --</option>
                    @foreach ($perans as $peran)
                        <option value="{{ $peran->id }}">{{ $peran->nama_peran }}</option>
                    @endforeach
                </select>
                @error('peran')
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
