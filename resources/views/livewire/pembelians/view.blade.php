@section('title', __('Pembelian'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="feather-shopping-bag"></i>
                                Data
                                @if(Auth::user()->role == 'supplier')
                                Pesanan
                                @else
                                Pembelian
                                @endif
                                 </h4>
                        </div>
                        @if (session()->has('message'))
                        <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                        @endif
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search...">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('livewire.pembelians.modals')
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pemilik')
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="form-title"><span>Form Pembelian</span></h5>
                        </div>
                        <div class="col-12 col-sm-4" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Supplier <span class="login-danger">*</span></label>
                                <select class="form-control" wire:model="supplier_id">
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_supplier }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Barang <span class="login-danger">*</span></label>
                                <select class="form-control" wire:model="hargabarang_id">
                                    <option value="">-- Pilih Barang --</option>
                                    @if($supplier_id)
                                    @foreach ($harga_barangs as $row)
                                    <option value="{{ $row->barang_id}}">{{$row->barang->kode_barang}} - {{$row->barang->nama_barang}} - Rp. {{ number_format($row->harga_supplier) }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('hargabarang_id') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-4" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Jumlah Barang <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="jumlah_barang">
                                @error('jumlah_barang') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="student-submit justify-content-between d-flex">
                                <button type="submit" wire:click="tambah()" class="btn btn-primary">Tambah</button>
                                {{-- total harga --}}
                                <label class="form-label fw-bold">Total = Rp. {{ number_format($total_harga) }}</label>
                                <input type="hidden" wire:model="total_harga" wire:change="updatedJumlahBarang" readonly>
                                {{-- total harga --}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead bg-dark text-white">
                                <tr class="text-center">
                                    <td>#</td>
                                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pemilik')
                                    <th>Pembuat</th>
                                    <th>Supplier</th>
                                    @endif
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <td>ACTIONS</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembelians as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'pemilik')
                                    <td>{{ Auth::check() ? Auth::user()->name : '' }}</td>
                                    <td>{{ $row->nama_supplier }}</td>
                                    @endif
                                    <td class="text-wrap"><b>[{{ $row->kode_barang }}]</b> - {{ $row->nama_barang }}</td>
                                    <td>{{ $row->jumlah_barang }}</td>
                                    <td>Rp. {{ number_format($row->total_harga) }}</td>
                                    <td>
                                    {{-- status = Menunggu, Ditolak, Proses dan Selesai --}}
                                    <span class="badge bg-{{ $row->status == 'Menunggu' ? 'warning' : ($row->status == 'Batal' ? 'danger' : ($row->status == 'Proses' ? 'info' : 'success')) }}">{{ $row->status }}</span>
                                    </td>
                                    <td width="90">
                                    {{-- button = tolak, proses, selesai --}}
                                    @if($row->status == 'Menunggu')
                                        {{-- tolak dan proses --}}
                                        @if(Auth::user()->role == 'supplier')
                                        <button class="btn btn-sm btn-danger text-white" wire:click="tolak({{$row->id}})">Tolak</button><br>
                                        <button class="btn btn-sm btn-info text-white mt-1" wire:click="proses({{$row->id}})">Proses</button>
                                        @endif
                                        @if(Auth::user()->role == 'admin')
                                        <button class="btn btn-sm btn-warning text-white" wire:click="batal({{$row->id}})">Batalkan</button> <br>
                                        <a class="btn btn-sm btn-danger mt-1" onclick="confirm('Confirm Delete Pembelian id {{$row->id}}? \nDeleted Pembelians cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})">Delete </a>
                                        @endif
                                    @elseif($row->status == 'Proses')
                                        {{-- selesai --}}
                                        <button class="btn btn-sm btn-success" wire:click="selesai({{$row->id}})">Selesai</button>
                                    @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $pembelians->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
