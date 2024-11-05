@section('title', 'Detail Penjualan')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title float-start">Detail Penjualan</h3>
                    <a href="/penjualans" class="btn btn-danger btn-sm float-end me-2">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6 bg-dark text-white">
                            <div class="table-responsive text-white">
                                <table class="table table-sm table-borderless  text-white">

                                    <tr>
                                        <td width="30%">No. Order</td>
                                        <td width="5%">:</td>
                                        <td>{{ $kode_order }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Plg</td>
                                        <td>:</td>
                                        <td>{{ $nama_pelanggan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 bg-dark">
                            <table class="table table-sm table-borderless text-white">
                                <tr>
                                    <td width="30%">Alamat</td>
                                    <td width="5%">:</td>
                                    <td>{{ $alamat_pelanggan }}</td>
                                </tr>
                                <tr>
                                    <td>No. Telp</td>
                                    <td>:</td>
                                    <td>{{ $no_telp_pelanggan }}</td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        {{-- tambah pesanan --}}
                        <div class="col-md-12">
                            {{-- alert --}}
                            @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button  type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <table class="table table-sm" style="border:none; border-collapse:collapse; cellspacing:0; cellpadding:0">
                                <tr>
                                    <td class="pb-0">
                                        <div class="form-group pb-0">
                                            <label for="barang_id">Barang</label>
                                            <select wire:model="barang_id" class="form-control" id="barang_id">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}">{{ $barang->kode_barang }} - {{ $barang->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                            @error('barang_id') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </td>
                                    <td class="pb-0" width="15%">
                                        <div class="form-group pb-0">
                                            <label for="stok">Stok</label>
                                            <input wire:model="stok" type="text" class="form-control" id="stok" placeholder="0" readonly>
                                        </div>
                                    </td>
                                    <td class="pb-0">
                                        <div class="form-group pb-0">
                                            <label for="harga">Harga</label>
                                            <input wire:model="harga" type="text" class="form-control" id="harga" placeholder="0" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-0">
                                        <div class="form-group pb-0">
                                            <label for="jumlah">Jumlah Beli</label>
                                            <input wire:model="jumlah" type="number" class="form-control" id="jumlah" placeholder="0">
                                            @error('jumlah') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                    </td>
                                    <td width="15%" class="pb-0">
                                        <div class="form-group pb-0">
                                            <label for="total">Total</label>
                                            <input wire:model="total" type="text" class="form-control" id="total" placeholder="0" readonly>
                                        </div>
                                    </td>
                                    <td class="pb-0">
                                        <div class="form-group pb-0">

                                            <label for="button">.</label>
                                        <button wire:click="tambahPesanan" class="btn btn-primary btn-block p-2" {{ $barang_id == '' || $jumlah == '' ? 'disabled' : '' }}>Tambah</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead text-center">
                                <tr>
                                    <td>#</td>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjualans as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->barang->kode_barang }} - {{ $row->barang->nama_barang }}</td>
                                    <td>{{ $row->jumlah_barang }}</td>
                                    <td>Rp.{{ number_format($row->harga_satuan) }}</td>
                                    <td>Rp. {{ number_format($row->total_harga) }}</td>
                                    <td>
                                        <button wire:click="hapusPesanan({{ $row->id }})" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                            </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $penjualans->links() }}</div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
