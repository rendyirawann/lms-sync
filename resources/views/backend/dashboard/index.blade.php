@extends('backend.layout.app')
@section('title', 'Dashboard')
@section('content')

<div class="app-content flex-column-fluid">
    <div class="app-container container-xxl">
        <!-- Dashboard Header -->
        <div class="d-flex flex-column flex-column-fluid mb-8">
            <h1 class="text-gray-900 fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <div class="text-muted fw-semibold fs-6">Ringkasan aktivitas Learning Management System hari ini.</div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!-- Total Sekolah -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card card-flush h-md-100 mb-5 mb-xl-10" style="background-color: #F1416C">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $stats['schools'] }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Sekolah</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-boldest text-white fs-7">Terdaftar</span>
                            </div>
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Guru -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card card-flush h-md-100 mb-5 mb-xl-10" style="background-color: #0095E8">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $stats['teachers'] }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Tenaga Pengajar</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-boldest text-white fs-7">Aktif</span>
                            </div>
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Siswa -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card card-flush h-md-100 mb-5 mb-xl-10" style="background-color: #50CD89">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $stats['students'] }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Siswa Terdaftar</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-boldest text-white fs-7">Belajar</span>
                            </div>
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kelas -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="card card-flush h-md-100 mb-5 mb-xl-10" style="background-color: #7239EA">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $stats['classes'] }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Rombongan Belajar</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-boldest text-white fs-7">Tersedia</span>
                            </div>
                            <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                <div class="bg-white rounded h-8px" role="progressbar" style="width: 100%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5 g-xl-10">
            <!-- Recent Assignments -->
            <div class="col-xl-8 mb-5 mb-xl-10">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Penugasan Terbaru</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">5 data terakhir plotting guru</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{ route('teaching-assignments.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="card-body pt-6">
                        <div class="table-responsive">
                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                <thead>
                                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                        <th class="p-0 pb-3 min-w-175px text-start">GURU</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">PELAJARAN</th>
                                        <th class="p-0 pb-3 min-w-100px text-end">KELAS</th>
                                        <th class="p-0 pb-3 min-w-50px text-end">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAssignments as $ra)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-50px me-3">
                                                    <div class="symbol-label fs-2 fw-semibold bg-light-primary text-primary">{{ substr($ra->teacher->user->name ?? 'G', 0, 1) }}</div>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $ra->teacher->user->name ?? '-' }}</a>
                                                    <span class="text-gray-500 fw-semibold d-block fs-7">NIP: {{ $ra->teacher->nip ?? '-' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bold d-block fs-6">{{ $ra->subject->name ?? '-' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bold d-block fs-6">{{ $ra->classRoom->name ?? '-' }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge badge-light-success">Aktif</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($recentAssignments->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-muted">Belum ada penugasan guru.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-xl-4 mb-5 mb-xl-10">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Aksi Cepat</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Akses langsung fitur utama</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <div class="d-flex flex-column gap-3">
                            <a href="{{ route('teachers.index') }}" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary d-flex align-items-center p-5 mb-2">
                                <i class="ki-outline ki-user fs-2x me-5"></i>
                                <div class="text-start">
                                    <span class="d-block fw-bold fs-6">Kelola Guru</span>
                                    <span class="text-muted fw-semibold fs-7">Tambah atau ubah data pengajar</span>
                                </div>
                            </a>
                            <a href="{{ route('students.index') }}" class="btn btn-outline btn-outline-dashed btn-outline-success btn-active-light-success d-flex align-items-center p-5 mb-2">
                                <i class="ki-outline ki-profile-user fs-2x me-5"></i>
                                <div class="text-start">
                                    <span class="d-block fw-bold fs-6">Kelola Siswa</span>
                                    <span class="text-muted fw-semibold fs-7">Manajemen data peserta didik</span>
                                </div>
                            </a>
                            <a href="{{ route('teaching-assignments.index') }}" class="btn btn-outline btn-outline-dashed btn-outline-warning btn-active-light-warning d-flex align-items-center p-5 mb-2">
                                <i class="ki-outline ki-book fs-2x me-5"></i>
                                <div class="text-start">
                                    <span class="d-block fw-bold fs-6">Penugasan</span>
                                    <span class="text-muted fw-semibold fs-7">Plotting guru ke mata pelajaran</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
