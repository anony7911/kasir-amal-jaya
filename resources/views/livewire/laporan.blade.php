@section('title', 'Laporan')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-start">Laporan Barang</h3>
                </div>
                <div class="card-body">
                    <label for="periode">Periode</label>
                    <div class="table-responsive p-0 m-0">
                        <table class="table table-borderless">
                            <tr>
                                <td class="p-0">
                                    <input wire:model="tanggal_awal_barang" type="date" class="form-control" id="tanggal_awal_barang" name="tanggal_awal_barang">
                                </td>
                                <td class="text-center align-middle" width="5%">
                                    <small class="text-muted fw-bold">S/D</small>
                                </td>
                                <td class="p-0">
                                    <input wire:model="tanggal_akhir_barang" type="date" class="form-control" id="tanggal_akhir_barang" name="tanggal_akhir_barang">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <button wire:click="cetak_barang" class="btn btn-primary btn-md mt-2">
                            <i class="fa fa-print"></i>
                            Cetak</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-start">Laporan Penjualan</h3>
                </div>
                <div class="card-body">
                    <label for="periode">Periode</label>
                    <div class="table-responsive p-0 m-0">
                        <table class="table table-borderless">
                            <tr>
                                <td class="p-0">
                                    <input wire:model="tanggal_awal_penjualan" type="date" class="form-control" id="tanggal_awal_penjualan" name="tanggal_awal_penjualan">
                                </td>
                                <td class="text-center align-middle" width="5%">
                                    <small class="text-muted fw-bold">S/D</small>
                                </td>
                                <td class="p-0">
                                    <input wire:model="tanggal_akhir_penjualan" type="date" class="form-control" id="tanggal_akhir_penjualan" name="tanggal_akhir_penjualan">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <button wire:click="cetak_penjualan" class="btn btn-primary btn-md mt-2">
                            <i class="fa fa-print"></i>
                            Cetak</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title float-start">Laporan Pembelian</h3>
                </div>
                <div class="card-body">
                    <label for="periode">Periode</label>
                    <div class="table-responsive p-0 m-0">
                        <table class="table table-borderless">
                            <tr>
                                <td class="p-0">
                                    <input wire:model="tanggal_awal_pembelian" type="date" class="form-control" id="tanggal_awal_pembelian" name="tanggal_awal_pembelian">
                                </td>
                                <td class="text-center align-middle" width="5%">
                                    <small class="text-muted fw-bold">S/D</small>
                                </td>
                                <td class="p-0">
                                    <input wire:model="tanggal_akhir_pembelian" type="date" class="form-control" id="tanggal_akhir_pembelian" name="tanggal_akhir_pembelian">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <button wire:click="cetak_pembelian" class="btn btn-primary btn-md mt-2">
                            <i class="fa fa-print"></i>
                            Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
