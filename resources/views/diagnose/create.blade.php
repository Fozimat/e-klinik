@extends('layouts.master')

@section('title')
    Diagnosa
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Diagnosa
        @endslot
        @slot('title')
            Tambah Diagnosa
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('diagnoses.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="patient_id" class="col-md-2 col-form-label">Pasien</label>
                            <div class="col-md-10">
                                <select class="form-select @error('patient_id') is-invalid @enderror" name="patient_id"
                                    id="patient_id">
                                    <option value="">Pilih</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}"
                                            {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Data Vital Terakhir</label>
                            <div class="col-md-10">
                                <div id="vital-info" class="border p-3 rounded bg-light">
                                    <small class="text-muted">Pilih pasien untuk melihat data vital terakhir.</small>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="complaint" class="col-md-2 col-form-label">Keluhan</label>
                            <div class="col-md-10">
                                <input class="form-control @error('complaint') is-invalid @enderror" type="text"
                                    name="complaint" id="complaint" value="{{ old('complaint') }}">
                                @error('complaint')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="diagnosis" class="col-md-2 col-form-label">Diagnosa</label>
                            <div class="col-md-10">
                                <input class="form-control @error('diagnosis') is-invalid @enderror" type="text"
                                    name="diagnosis" id="diagnosis" value="{{ old('diagnosis') }}">
                                @error('diagnosis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10 offset-md-2">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                        <i class="uil uil-check-circle me-2"></i>Simpan
                                    </button>
                                    <a href="{{ route('diagnoses.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const patientSelect = document.getElementById('patient_id');
            const vitalInfoDiv = document.getElementById('vital-info');

            patientSelect.addEventListener('change', function() {
                const patientId = this.value;

                if (patientId) {
                    fetch(`/diagnoses/latest/${patientId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('No data');
                            }
                            return response.json();
                        })
                        .then(data => {
                            vitalInfoDiv.innerHTML = `
                            <strong>Berat:</strong> ${data.weight} kg <br>
                            <strong>Tekanan Darah:</strong> ${data.systolic}/${data.diastolic} mmHg <br>
                            <strong>Tanggal:</strong> ${new Date(data.created_at).toLocaleString()}
                        `;
                        })
                        .catch(() => {
                            vitalInfoDiv.innerHTML = '<em>Data vital tidak tersedia.</em>';
                        });
                } else {
                    vitalInfoDiv.innerHTML =
                        '<small class="text-muted">Pilih pasien untuk melihat data vital terakhir.</small>';
                }
            });
        });
    </script>
@endsection
