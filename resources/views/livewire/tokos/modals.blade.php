<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Toko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="no_toko">No Toko</label>
                        <input wire:model="no_toko" type="text" class="form-control" id="no_toko" value="{{ $no_toko }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat_toko">Alamat Toko</label>
                        <input wire:model="alamat_toko" type="text" class="form-control" id="alamat_toko" placeholder="Alamat Toko">@error('alamat_toko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select wire:model="kategori" class="form-control" id="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="toko">Toko</option>
                            <option value="gudang">Gudang</option>
                        </select>
                        @error('kategori') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pegawai">Jumlah Pegawai</label>
                        <input wire:model="jumlah_pegawai" type="number" class="form-control" id="jumlah_pegawai" placeholder="ex. 0">@error('jumlah_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Toko</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="alamat_toko">Alamat Toko</label>
                        <input wire:model="alamat_toko" type="text" class="form-control" id="alamat_toko" placeholder="Alamat Toko">@error('alamat_toko') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select wire:model="kategori" class="form-control" id="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="toko">Toko</option>
                            <option value="gudang">Gudang</option>
                        </select>
                        @error('kategori') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pegawai">Jumlah Pegawai</label>
                        <input wire:model="jumlah_pegawai" type="number" class="form-control" id="jumlah_pegawai" placeholder="ex. 0">@error('jumlah_pegawai') <span class="error text-danger">{{ $message }}</span> @enderror
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
