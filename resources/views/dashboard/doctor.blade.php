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
            'icon' => 'uil-user-md',
            'count' => $undiagnosedCount,
            'label' => 'Menunggu Diagnosis',
        ])
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Diagnosis Terakhir</h5>
        </div>
        <div class="card-body">
            @if ($lastDiagnosis)
                <p><strong>Pasien:</strong> {{ $lastDiagnosis->patient->name }}</p>
                <p><strong>Diagnosa:</strong> {{ $lastDiagnosis->diagnosis }}</p>
            @else
                <p class="text-muted">Belum ada diagnosis yang dibuat.</p>
            @endif
        </div>
    </div>
@endsection
