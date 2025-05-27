@extends('layouts.master')
@section('title')
    Vital Sign
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Vital Sign
        @endslot
        @slot('title')
            Edit Vital Sign
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('vitals.update', $vital->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="patient" class="col-md-2 col-form-label">Pasien</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" id="patient"
                                    value="{{ $vital->patient->name }}" readonly>
                                <input type="hidden" name="patient_id" value="{{ $vital->patient_id }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="weight" class="col-md-2 col-form-label">Berat (Kg)</label>
                            <div class="col-md-10">
                                <input class="form-control @error('weight') is-invalid @enderror" type="number"
                                    id="weight" name="weight" value="{{ old('weight', $vital->weight) }}">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="systolic" class="col-md-2 col-form-label">Tekanan Darah (Systolic)</label>
                            <div class="col-md-10">
                                <input class="form-control @error('systolic') is-invalid @enderror" type="number"
                                    id="systolic" name="systolic" value="{{ old('systolic', $vital->systolic) }}">
                                @error('systolic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="diastolic" class="col-md-2 col-form-label">Tekanan Darah (Diastolic)</label>
                            <div class="col-md-10">
                                <input class="form-control @error('diastolic') is-invalid @enderror" type="number"
                                    id="diastolic" name="diastolic" value="{{ old('diastolic', $vital->diastolic) }}">
                                @error('diastolic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10 offset-md-2">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                        <i class="uil uil-check-circle me-2"></i>Update
                                    </button>
                                    <a href="{{ route('vitals.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
