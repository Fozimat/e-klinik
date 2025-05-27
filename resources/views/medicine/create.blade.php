@extends('layouts.master')
@section('title')
    Obat
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Obat
        @endslot
        @slot('title')
            Tambah Obat
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('medicines.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-2 col-form-label">Nama Obat</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" type="text" id="description"
                                    name="description">{{ old('description') }}</textarea>
                                @error('description')
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
                                    <a href="{{ route('medicines.index') }}" class="btn btn-light">Kembali</a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
