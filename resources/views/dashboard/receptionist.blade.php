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
            'icon' => 'uil-stethoscope-alt',
            'count' => $totalDiagnoses,
            'label' => 'Total Diagnosa',
        ])

        @include('common-components.dashboard-card', [
            'route' => route('patients.index'),
            'icon' => 'uil-user-md',
            'count' => $todayPatientsCount,
            'label' => 'Total Pasien Hari Ini',
        ])
    </div>
@endsection
