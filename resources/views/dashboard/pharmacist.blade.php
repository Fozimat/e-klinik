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
            'route' => route('prescriptions.index'),
            'icon' => 'uil-file-medical-alt',
            'count' => $noPrescriptionCount,
            'label' => 'Belum Diresepkan',
        ])
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Resep Terakhir</h5>
        </div>
        <div class="card-body">
            @if ($lastPrescription)
                <p><strong>Pasien:</strong> {{ $lastPrescription->diagnose->patient->name }}</p>
                <p><strong>Obat:</strong> {{ $lastPrescription->medicine->name }}</p>
                <p><strong>Dosis:</strong> {{ $lastPrescription->dosage }}</p>
                <p><strong>Catatan:</strong> {{ $lastPrescription->notes ?? '-' }}</p>
            @else
                <p class="text-muted">Belum ada resep yang dibuat.</p>
            @endif
        </div>
    </div>
@endsection
