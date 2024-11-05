@section('title', __('Barang'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="feather-folder-plus"></i>
							Data Barang </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search...">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Tambah Data
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.barangs.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Deskripsi Barang</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($barangs as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->kode_barang }}</td>
								<td>{{ $row->nama_barang }}</td>
								<td>{{ $row->deskripsi_barang }}</td>
								<td width="90">
                                <a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="btn btn-sm btn-warning" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
                                <a class="btn btn-sm btn-danger" onclick="confirm('Confirm Delete Barang id {{$row->id}}? \nDeleted Barangs cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>
								</td>
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
