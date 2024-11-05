@section('title', 'User')
<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="feather-folder-plus"></i>
                                Manajemen User </h4>
                        </div>
                        @if (session()->has('message'))
                        <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                        @endif
                        <div>
                            <input wire:model='search' type="text" class="form-control" name="search" id="search" placeholder="Search...">
                        </div>
                        <div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
                            <i class="fa fa-plus"></i> Tambah Data
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead text-center">
                                <tr>
                                    <td>#</td>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        {{-- pemilik, supplier dan admin --}}
                                        <span class="badge bg-{{ $row->role == 'pemilik' ? 'success' : ($row->role == 'admin' ? 'info' : 'warning') }} text-white">{{ $row->role }}</span>
                                    <td class="text-center">
                                        <button wire:click="edit({{ $row->id }})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateDataModal"><i class="feather-edit"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataModalLabel">Create New User</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="ex. Ahmad Sutar">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model="email" type="email" class="form-control" id="email" placeholder="ex. ahmadsutar@gmail.com">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select wire:model="role" class="form-control" id="role">
                                <option value="">-- Pilih Role --</option>
                                <option value="pemilik">Pemilik</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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
                            <label for="name">Nama</label>
                            <input wire:model="name" type="text" class="form-control" id="name" placeholder="ex. Ahmad Sutar">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input wire:model="email" type="email" class="form-control" id="email" placeholder="ex. ahmadsutar@gmail.com">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select wire:model="role" class="form-control" id="role">
                                <option value="">-- Pilih Role --</option>
                                <option value="pemilik">Pemilik</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role') <span class="error text-danger">{{ $message }}</span> @enderror
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
</div>
