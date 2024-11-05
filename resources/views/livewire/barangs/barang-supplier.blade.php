@section('title', 'Barang')
<div>
    <div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="feather-folder-plus"></i>
							Data Harga Barang </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='search' type="text" class="form-control" name="search" id="search" placeholder="Search...">
						</div>
					</div>
				</div>

				<div class="card-body">
                <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="form-title"><span>Perbaharui Harga Barang</span></h5>
                        </div>
                        <div class="col-12 col-sm-4" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Barang <span class="login-danger">*</span></label>
                                <select class="form-control" wire:model="barang_id">
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach ($barangs as $row)
                                    <option value="{{ $row->id }}">{{ $row->kode_barang }} - {{ $row->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Harga Supplier <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="harga_supplier" placeholder="ex. 50000">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 " style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <label>Harga Jual <span class="login-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="harga_jual" placeholder="ex. 51500">
                            </div>
                        </div>
                        <div class="col-12 col-sm-2" style="padding-bottom: 10px !important;">
                            <div class="form-group local-forms" style="margin-bottom: 10px !important;">
                                <button type="submit" class="btn btn-primary" wire:click.prevent="store">Perbaharui</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- {{ dd($hargabarangs) }} --}}
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
                                <th>Tanggal</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Harga Supplier</th>
								<th>Harga Jual</th>
							</tr>
						</thead>
						<tbody>
							@forelse($hargabarangs as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($row->created_at)->isoFormat('D MMMM Y') }}</td>
								<td>{{ $row->kode_barang }}</td>
								<td>{{ $row->nama_barang }}</td>
								<td>Rp.{{ number_format($row->harga_supplier, 0, ',', '.') }}</td>
                                <td>Rp.{{ number_format($row->harga_jual, 0, ',', '.') }}</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>
					<div class="float-end">{{ $barangs->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
