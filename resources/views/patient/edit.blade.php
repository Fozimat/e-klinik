@extends('layouts.master')
@section('title')
    Pasien
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Pasien
        @endslot
        @slot('title')
            Edit Pasien
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="name" class="col-md-2 col-form-label">Nama Pasien</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" value="{{ old('name', $patient->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="gender" class="col-md-2 col-form-label">Gender</label>
                            <div class="col-md-10">
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender"
                                    id="gender">
                                    <option value="">Pilih</option>
                                    <option value="male"
                                        {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female"
                                        {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="birth_date" class="col-md-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-md-10">
                                <input class="form-control @error('birth_date') is-invalid @enderror" type="date"
                                    id="birth_date" name="birth_date" value="{{ old('birth_date', $patient->birth_date) }}">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="phone_number" class="col-md-2 col-form-label">No Telp</label>
                            <div class="col-md-10">
                                <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $patient->phone_number) }}">
                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-10 offset-md-2">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        <i class="uil uil-edit me-2"></i>Update
                                    </button>
                                    <a href="{{ route('patients.index') }}" class="btn btn-light">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
