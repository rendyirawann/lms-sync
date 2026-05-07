@extends('backend.layout.app')
@section('title', 'Kelas')
@section('content')
<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="card card-flush mt-6 mt-xl-9">
            <div class="card-header mt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bold mb-1">Manajemen Kelas</h3>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Data</button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th>Nama Sekolah</th>
                                <th>Nama Kelas</th>
                                <th>Tingkat/Level</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @foreach($classRooms as $item)
                            <tr>
                                <td>{{ $item->school->name ?? '-' }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->level }}</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-light-primary btn-active-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                    <form action="{{ route('class-rooms.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light-danger btn-active-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            
                            <!-- Edit Modal -->
                            <div class="modal fade drawer-modal" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('class-rooms.update', $item->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header"><h2 class="fw-bold">Edit Kelas</h2>
                                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                    <i class="ki-outline ki-cross fs-1 text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fv-row mb-7">
                                                    <label class="required fs-6 fw-semibold mb-2">Pilih Sekolah</label>
                                                    <select name="school_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#editModal{{ $item->id }}" data-placeholder="Pilih Sekolah..." required>
                                                        <option value="">Pilih Sekolah...</option>
                                                        @foreach($schools as $s)
                                                            <option value="{{ $s->id }}" {{ $item->school_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7"><label class="required fs-6 fw-semibold mb-2">Nama Kelas</label><input type="text" name="name" class="form-control form-control-solid" value="{{ $item->name }}" required></div>
                                                <div class="fv-row mb-7"><label class="required fs-6 fw-semibold mb-2">Tingkat/Level</label><input type="text" name="level" class="form-control form-control-solid" value="{{ $item->level }}" required></div>
                                                
                                            </div>
                                            <div class="modal-footer flex-center">
                                                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade drawer-modal" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('class-rooms.store') }}" method="POST">
                @csrf
                <div class="modal-header"><h2 class="fw-bold">Tambah Kelas</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1 text-dark"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Pilih Sekolah</label>
                        <select name="school_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#addModal" data-placeholder="Pilih Sekolah..." required>
                            <option value="">Pilih Sekolah...</option>
                            @foreach($schools as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7"><label class="required fs-6 fw-semibold mb-2">Nama Kelas</label><input type="text" name="name" class="form-control form-control-solid" required></div>
                    <div class="fv-row mb-7"><label class="required fs-6 fw-semibold mb-2">Tingkat/Level</label><input type="text" name="level" class="form-control form-control-solid" required></div>
                    
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
