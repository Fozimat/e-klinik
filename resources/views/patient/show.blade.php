@extends('layouts.master')
@section('title')
    Pasien
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Pasien
        @endslot
        @slot('title')
            Daftar Pasien
        @endslot
    @endcomponent

    <div class="row mb-4">
        <div class="col-xl-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown float-end">

                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <img src="{{ URL::asset('/assets/images/user.png') }}" alt=""
                                class="avatar-lg rounded-circle img-thumbnail">
                        </div>
                        <h5 class="mt-3 mb-1">{{ $patient->name }}</h5>
                        <p class="text-muted">{{ Str::title($patient->gender) }}</p>
                    </div>

                    <hr class="my-4">

                    <div class="text-muted">

                        <div class="table-responsive mt-4">
                            <div>
                                <p class="mb-1">Nama :</p>
                                <h5 class="font-size-16">{{ $patient->name }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">No Telepon :</p>
                                <h5 class="font-size-16">{{ $patient->phone_number }}</h5>
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">Tanggal Lahir :</p>
                                <h5 class="font-size-16">
                                    {{ \Carbon\Carbon::parse($patient->birth_date)->translatedFormat('d M Y') }}</h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-0">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                            <i class="uil uil-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">History Pemeriksaan</span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content p-4">
                    <div class="tab-pane active" id="about" role="tabpanel">
                        <div>
                            <div>
                                <div class="mb-4">
                                    <h5 class="font-size-16 mb-3">Vital Sign Terakhir</h5>
                                    @if ($patient->vitals->isNotEmpty())
                                        @php $vital = $patient->vitals->first(); @endphp
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Berat </th>
                                                <td>{{ $vital->weight }} Kg</td>
                                            </tr>
                                            <tr>
                                                <th>Tekanan Darah</th>
                                                <td>{{ $vital->systolic }}/{{ $vital->diastolic }} mmHg</td>
                                            </tr>
                                            <tr>
                                                <th>Dicatat Oleh</th>
                                                <td>{{ $vital->nurse->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <td>{{ \Carbon\Carbon::parse($vital->recorded_at)->translatedFormat('d F Y H:i') }}
                                                </td>
                                            </tr>
                                        </table>
                                    @else
                                        <p class="text-muted"><em>Data vital sign belum tersedia.</em></p>
                                    @endif
                                </div>


                            </div>

                            <div>
                                <h5 class="font-size-16 mb-4">Riwayat Pemeriksaan</h5>
                                <ul class="activity-feed mb-0 ps-2">
                                    @forelse ($patient->diagnosis as $diagnose)
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted mb-1">
                                                    {{ $diagnose->created_at->translatedFormat('d M Y') }} oleh Dr.
                                                    {{ $diagnose->doctor->name ?? '-' }}</p>
                                                <h5 class="font-size-16">Keluhan: {{ $diagnose->complaint }}</h5>
                                                <p class="mb-0">Diagnosa: {{ $diagnose->diagnosis }}</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="feed-item">
                                            <div class="feed-item-list">
                                                <p class="text-muted">Belum ada riwayat pemeriksaan.</p>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>

                            </div>

                            <div>
                                <h5 class="font-size-16 mb-4 mt-4">Riwayat Resep</h5>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Obat</th>
                                                <th>Dosis</th>
                                                <th>Catatan</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index = 1; @endphp
                                            @forelse ($patient->diagnosis as $diagnose)
                                                @foreach ($diagnose->prescriptions as $prescription)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td>{{ $prescription->medicine->name }}</td>
                                                        <td>{{ $prescription->dosage }}</td>
                                                        <td>{{ $prescription->notes ?? '-' }}</td>
                                                        <td>{{ $prescription->created_at->translatedFormat('d M Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-muted text-center">Belum ada resep yang
                                                        tercatat.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
