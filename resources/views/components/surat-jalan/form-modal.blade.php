<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}">
    <form>

        {{-- SALES ORDER --}}
        <div class="mb-3">
            <label class="form-label">
                Sales Order <sup class="text-danger">*</sup>
            </label>
            <select wire:model="so_id" class="form-control {{ $errors->has('so_id') ? 'border-danger' : '' }}">
                <option value="">-- Pilih Sales Order --</option>
                @foreach ($salesOrders as $so)
                    <option value="{{ $so->id }}">
                        {{ $so->kode_so ?? 'SO-' . $so->id }} - {{ $so->pembeli->nama_pembeli }}
                    </option>
                @endforeach
            </select>
            @error('so_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- PETUGAS --}}
        <div class="mb-3">
            <label class="form-label">
                Petugas <sup class="text-danger">*</sup>
            </label>
            <select wire:model="pengguna_id"
                class="form-control {{ $errors->has('pengguna_id') ? 'border-danger' : '' }}">
                <option value="">-- Pilih Petugas --</option>
                @foreach ($penggunas as $pengguna)
                    <option value="{{ $pengguna->id }}">
                        {{ $pengguna->nama_pengguna }}
                    </option>
                @endforeach
            </select>
            @error('pengguna_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- TANGGAL SURAT JALAN --}}
        <div class="mb-3">
            <label class="form-label">
                Tanggal Surat Jalan <sup class="text-danger">*</sup>
            </label>
            <input type="date" wire:model="tanggal_sj"
                class="form-control {{ $errors->has('tanggal_sj') ? 'border-danger' : '' }}">
            @error('tanggal_sj')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- TANGGAL PENGANTARAN --}}
        <div class="mb-3">
            <label class="form-label">
                Tanggal Pengantaran <sup class="text-danger">*</sup>
            </label>
            <input type="date" wire:model="tanggal_pengantaran"
                class="form-control {{ $errors->has('tanggal_pengantaran') ? 'border-danger' : '' }}">
            @error('tanggal_pengantaran')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- FOOTER --}}
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
