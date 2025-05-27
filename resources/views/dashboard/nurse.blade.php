@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Mini SIMRS
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        @include('common-components.dashboard-card', [
            'route' => route('patients.index'),
            'icon' => 'uil-user-md',
            'count' => $totalPatients,
            'label' => 'Total Pasien',
        ])

        @include('common-components.dashboard-card', [
            'route' => route('diagnoses.index'),
            'icon' => 'uil-stethoscope',
            'count' => $totalDiagnoses,
            'label' => 'Total Diagnosis',
        ])

        @include('common-components.dashboard-card', [
            'route' => route('patients.index'),
            'icon' => 'uil-notes',
            'count' => $waitingVitals,
            'label' => 'Belum Diisi Vital',
        ])
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Data Vital Terakhir</h5>
        </div>
        <div class="card-body">
            @if ($lastVital)
                <p><strong>Pasien:</strong> {{ $lastVital->patient->name }}</p>
                <p><strong>Tekanan Darah:</strong> {{ $lastVital->blood_pressure }}</p>
                <p><strong>Berat Badan:</strong> {{ $lastVital->weight }} kg</p>
            @else
                <p class="text-muted">Belum ada data vital.</p>
            @endif
        </div>
    </div>
@endsection
