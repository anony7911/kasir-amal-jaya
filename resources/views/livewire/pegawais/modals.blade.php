<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Pegawai</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input wire:model="nama_pegawai" type="text" class="form-control" id="nama_pegawai" placeholder="Nama Pegawai">@error('nama_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_pegawai">Alamat Pegawai</label>
                        <input wire:model="alamat_pegawai" type="text" class="form-control" id="alamat_pegawai" placeholder="Alamat Pegawai">@error('alamat_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp_pegawai">No. Telp.</label>
                        <input wire:model="no_telp_pegawai" type="text" class="form-control" id="no_telp_pegawai" placeholder="No Telp Pegawai">@error('no_telp_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="toko_id">Toko</label>
                        <select wire:model="toko_id" class="form-control" id="toko_id">
                            <option value="">-- Pilih Toko --</option>
                            @foreach ($tokos as $row)
                            <option value="{{ $row->id }}">{{ $row->no_toko }} - {{ $row->alamat_toko }}</option>
                            @endforeach
                        </select>
                        @error('toko_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- email dan password --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input wire:model="email" type="text" class="form-control" id="email" placeholder="Email Pegawai">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input wire:model="password" type="text" class="form-control" id="password" placeholder="Password Pegawai">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Pegawai</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input wire:model="nama_pegawai" type="text" class="form-control" id="nama_pegawai" placeholder="Nama Pegawai">@error('nama_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_pegawai">Alamat Pegawai</label>
                        <input wire:model="alamat_pegawai" type="text" class="form-control" id="alamat_pegawai" placeholder="Alamat Pegawai">@error('alamat_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp_pegawai">No. Telp.</label>
                        <input wire:model="no_telp_pegawai" type="text" class="form-control" id="no_telp_pegawai" placeholder="No Telp Pegawai">@error('no_telp_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="toko_id">Toko</label>
                        <select wire:model="toko_id" class="form-control" id="toko_id">
                            <option value="">-- Pilih Toko --</option>
                            @foreach ($tokos as $row)
                            <option value="{{ $row->id }}">{{ $row->no_toko }} - {{ $row->alamat_toko }}</option>
                            @endforeach
                        </select>
                        @error('toko_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
       </div>
    </div>
</div>
