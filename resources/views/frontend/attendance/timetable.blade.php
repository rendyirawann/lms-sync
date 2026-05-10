@extends('backend.layout.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="d-flex text-dark fw-bold fs-3 align-items-center my-1">Jadwal Pelajaran Mingguan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">Portal Siswa</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-dark">Timetable</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-6">
                @php
                    $days = [
                        1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'
                    ];
                @endphp

                @foreach($days as $key => $dayName)
                <div class="col-xl-4 col-md-6">
                    <div class="card card-flush h-100 border-top border-4 border-primary">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark fs-3">{{ $dayName }}</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    {{ isset($schedules[$key]) ? count($schedules[$key]) . ' Mata Pelajaran' : 'Tidak ada jadwal' }}
                                </span>
                            </h3>
                        </div>
                        <div class="card-body pt-5">
                            @if(isset($schedules[$key]))
                                @foreach($schedules[$key] as $s)
                                <div class="d-flex align-items-center mb-7">
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-outline ki-book-open fs-2x text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="#" class="text-dark fw-bold text-hover-primary fs-6">{{ $s->teachingAssignment->subject->name }}</a>
                                        <span class="text-muted d-block fw-semibold">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</span>
                                        <span class="text-gray-400 fs-8">Guru: {{ $s->teachingAssignment->teacher->user->name }}</span>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="d-flex flex-column flex-center py-10">
                                    <i class="ki-outline ki-calendar-remove fs-3x text-gray-200 mb-3"></i>
                                    <span class="text-gray-400 fw-bold">Hari Libur / Kosong</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
