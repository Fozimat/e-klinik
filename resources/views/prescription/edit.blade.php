@extends('layouts.master')
@section('title')
    Edit Resep
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Resep
        @endslot
        @slot('title')
            Edit Resep
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Diagnosa</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control"
                                    value="{{ $prescription->diagnose->patient->name }} - {{ $prescription->diagnose->diagnosis }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="medicine_id" class="col-md-2 col-form-label">Obat</label>
                            <div class="col-md-10">
                                <select class="form-select @error('medicine_id') is-invalid @enderror" name="medicine_id"
                                    id="medicine_id">
                                    <option value="">Pilih Obat</option>
                                    @foreach (\App\Models\Medicine::all() as $medicine)
                                        <option value="{{ $medicine->id }}"
                                            {{ old('medicine_id', $prescription->medicine_id) == $medicine->id ? 'selected' : '' }}>
                                            {{ $medicine->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('medicine_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="dosage" class="col-md-2 col-form-label">Dosis</label>
                            <div class="col-md-10">
                                <input class="form-control @error('dosage') is-invalid @enderror" type="text"
                                    id="dosage" name="dosage" value="{{ old('dosage', $prescription->dosage) }}">
                                @error('dosage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="notes" class="col-md-2 col-form-label">Catatan</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $prescription->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10 offset-md-2">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        <i class="uil uil-save me-2"></i>Update
                                    </button>
                                    <a href="{{ route('prescriptions.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
