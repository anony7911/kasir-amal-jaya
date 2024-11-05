<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Create New Penjualan</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
				<form>
                    <div class="form-group">
                        <label for="kode_order">Kode Order</label>
                        <input wire:model="kode_order" type="text" class="form-control" id="kode_order" value="{{ $kode_order }}" placeholder="Kode Order" readonly>@error('kode_order') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input wire:model="nama_pelanggan" type="text" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan">@error('nama_pelanggan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_pelanggan">Alamat Pelanggan</label>
                        <input wire:model="alamat_pelanggan" type="text" class="form-control" id="alamat_pelanggan" placeholder="Alamat Pelanggan">@error('alamat_pelanggan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp_pelanggan">No Telp Pelanggan</label>
                        <input wire:model="no_telp_pelanggan" type="text" class="form-control" id="no_telp_pelanggan" placeholder="No Telp Pelanggan">@error('no_telp_pelanggan') <span class="error text-danger">{{ $message }}</span> @enderror
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
                <h5 class="modal-title" id="updateModalLabel">Update Penjualan</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="jumlah_barang"></label>
                        <input wire:model="jumlah_barang" type="text" class="form-control" id="jumlah_barang" placeholder="Jumlah Barang">@error('jumlah_barang') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_harga"></label>
                        <input wire:model="total_harga" type="text" class="form-control" id="total_harga" placeholder="Total Harga">@error('total_harga') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="barang_id"></label>
                        <input wire:model="barang_id" type="text" class="form-control" id="barang_id" placeholder="Barang Id">@error('barang_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="toko_id"></label>
                        <input wire:model="toko_id" type="text" class="form-control" id="toko_id" placeholder="Toko Id">@error('toko_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id"></label>
                        <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder="User Id">@error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
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
