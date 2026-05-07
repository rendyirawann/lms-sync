@extends('backend.layout.app')
@section('title', 'Modul Pembelajaran')
@section('content')

<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <div class="card card-flush mt-6 mt-xl-9">
            <div class="card-header mt-5">
                <div class="card-title flex-column">
                    <h3 class="fw-bold mb-1">Modul Pembelajaran</h3>
                    <div class="fs-6 text-gray-500">Kumpulan materi, tugas, dan modul digital</div>
                </div>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Unggah Modul Baru</button>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-250px">Modul</th>
                                <th>Guru / Mapel</th>
                                <th>Kelas</th>
                                <th>Ukuran</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @foreach($modules as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- File Icon based on type -->
                                        @php
                                            $icon = 'ki-file';
                                            $color = 'primary';
                                            if(in_array($item->file_type, ['pdf'])) { $icon = 'ki-pdf'; $color = 'danger'; }
                                            elseif(in_array($item->file_type, ['doc', 'docx'])) { $icon = 'ki-word'; $color = 'primary'; }
                                            elseif(in_array($item->file_type, ['xls', 'xlsx'])) { $icon = 'ki-excel'; $color = 'success'; }
                                            elseif(in_array($item->file_type, ['ppt', 'pptx'])) { $icon = 'ki-subtitle'; $color = 'warning'; }
                                        @endphp
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label bg-light-{{ $color }}">
                                                <i class="ki-outline {{ $icon }} fs-2x text-{{ $color }}"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('learning-modules.download', $item->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $item->title }}</a>
                                            <span class="text-muted fw-semibold d-block fs-7">{{ $item->file_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $item->teachingAssignment->teacher->user->name ?? '-' }}
                                    <span class="text-muted d-block fs-7">{{ $item->teachingAssignment->subject->name ?? '-' }}</span>
                                </td>
                                <td>{{ $item->teachingAssignment->classRoom->name ?? '-' }}</td>
                                <td>{{ number_format($item->file_size / 1024 / 1024, 2) }} MB</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('learning-modules.download', $item->id) }}" class="btn btn-icon btn-sm btn-light-info" title="Download">
                                            <i class="ki-outline ki-download fs-2"></i>
                                        </a>
                                        <button class="btn btn-icon btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                            <i class="ki-outline ki-pencil fs-2"></i>
                                        </button>
                                        <form action="{{ route('learning-modules.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-sm btn-light-danger" onclick="return confirm('Hapus modul ini?')" title="Hapus">
                                                <i class="ki-outline ki-trash fs-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($modules->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-10 text-muted">Belum ada modul yang diunggah.</td>
                            </tr>
                            @endif
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
            <form action="{{ route('learning-modules.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="fw-bold">Unggah Modul Baru</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1 text-dark"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Pilih Kelas / Penugasan</label>
                        <select name="teaching_assignment_id" class="form-select form-select-solid" data-control="select2" data-dropdown-parent="#addModal" required>
                            <option value="">Pilih Penugasan...</option>
                            @foreach($assignments as $a)
                                <option value="{{ $a->id }}">
                                    @if(auth()->user()->hasRole('superadmin'))
                                        [{{ $a->teacher->user->name ?? '-' }}] - 
                                    @endif
                                    {{ $a->classRoom->name ?? '-' }} ({{ $a->subject->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        <div class="text-muted fs-7 mt-2">Modul akan otomatis terlihat oleh siswa di kelas yang dipilih.</div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Judul Modul</label>
                        <input type="text" name="title" class="form-control form-control-solid" placeholder="Contoh: Materi Aljabar Dasar" required>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control form-control-solid" rows="3"></textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Pilih File Modul</label>
                        <input type="file" name="file" class="form-control form-control-solid" required>
                        <div class="text-muted fs-7 mt-2">Format: PDF, Word, Excel, PPT. Maksimal 20MB.</div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_published" checked="checked" />
                            <span class="form-check-label fw-semibold text-muted">Publikasikan Langsung</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Unggah Modul</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($modules as $item)
<!-- Edit Modal -->
<div class="modal fade drawer-modal" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('learning-modules.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h2 class="fw-bold">Edit Modul</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1 text-dark"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Judul Modul</label>
                        <input type="text" name="title" class="form-control form-control-solid" value="{{ $item->title }}" required>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Deskripsi (Opsional)</label>
                        <textarea name="description" class="form-control form-control-solid" rows="3">{{ $item->description }}</textarea>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Ganti File (Kosongkan jika tidak diubah)</label>
                        <input type="file" name="file" class="form-control form-control-solid">
                        <div class="text-muted fs-7 mt-2">File saat ini: <span class="fw-bold text-primary">{{ $item->file_name }}</span></div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="is_published" {{ $item->is_published ? 'checked' : '' }} />
                            <span class="form-check-label fw-semibold text-muted">Publikasikan Langsung</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
