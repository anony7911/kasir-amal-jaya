@section('title', __('Pegawai'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="feather-users"></i>
							Data Pegawai </h4>
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
						@include('livewire.pegawais.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td>#</td>
								<th>Toko </th>
								<th>Nama Pegawai</th>
								<th>Alamat Pegawai</th>
								<th>No Telp Pegawai</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($pegawais as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
                                <td>{{ $row->toko->no_toko }} <br>
                                    <small>{{ $row->toko->alamat_toko }}</small>
								<td>{{ $row->nama_pegawai }}</td>
								<td>{{ $row->alamat_pegawai }}</td>
								<td>{{ $row->no_telp_pegawai }}</td>
								<td width="90">
                                <a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="btn btn-sm btn-warning" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
                                <a class="btn btn-sm btn-danger" onclick="confirm('Confirm Delete Pegawai id {{$row->id}}? \nDeleted Pegawais cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>
					<div class="float-end">{{ $pegawais->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
