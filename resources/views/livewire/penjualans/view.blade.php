@section('title', __('Penjualans'))
<div>
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="feather-shopping-cart"></i>
							Data Penjualan </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search...">
						</div>
                                @if(Auth::user()->role !== 'pemilik')
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Pelanggan Baru
						</div>
                                @endif
					</div>
				</div>

				<div class="card-body">
						@include('livewire.penjualans.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Kode Order</th>
                                @if(Auth::user()->role == 'pemilik')
                                <th>Pegawai/Toko</th>
                                @endif
                                <th>Pelanggan</th>
                                <th colspan="2">Order/Jumlah</th>
                                <th>Total Bayar</th>
                                @if(Auth::user()->role !== 'pemilik')
								<td>ACTIONS</td>
                                @endif
							</tr>
						</thead>
						<tbody>
							@forelse($orderpelanggans as $row)
							<tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->kode_order }}</td>
                                @if(Auth::user()->role == 'pemilik')
                                <td>{{ $row->name }} <br>
                                    <small class="text-muted fw-bold">[{{ $row->no_toko }}] {{ $row->alamat_toko }}</small>
                                </td>
                                @endif
                                <td class="fw-bold">{{ strtoupper($row->nama_pelanggan) }} <br>
                                    <small class="text-muted fw-bold">{{ $row->alamat_pelanggan }}</small>
                                 <br>
                                    <a href="tel:{{ $row->no_telp_pelanggan }}">{{ $row->no_telp_pelanggan }}</a>
                                </td>
                                <td>
                                    @forelse ($row->penjualans as $item)
                                    [{{ $loop->iteration }}]
                                        {{ $item->barang->kode_barang }} - {{ $item->barang->nama_barang }} <br>
                                    @empty
                                        <span class="text-danger">Belum Ada.</span>
                                    @endforelse
                                </td>
                                <td>
                                    @foreach ($row->penjualans as $item)
                                        {{ $item->jumlah_barang }} <br>
                                        {{-- jumlah semua total_harga --}}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($row->penjualans as $item)
                                        Rp. {{ number_format($item->total_harga) }} <br>
                                    @endforeach
                                    <hr>
                                    <b>
                                        Rp. {{ number_format($row->penjualans->sum('total_harga')) }}
                                    </b>
                                </td>
                                @if(Auth::user()->role !== 'pemilik')
                                <td>
                                    <a href="{{ url('/penjualans/' . $row->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- cetak nota --}}
                                    {{-- <a href="{{ url('/penjualans/' . $row->id . '/cetak') }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-print"></i>
                                    </a> --}}
                                </td>
                                @endif
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>
                    <hr>
					<div class="float-end">{{ $penjualans->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
