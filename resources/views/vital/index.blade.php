@extends('layouts.master')
@section('title')
    Vital Sign
@endsection
@section('css')
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Vital Sign
        @endslot
        @slot('title')
            Data Vital Sign
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="uil uil-pen me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                    </button>
                </div>
            @endif
            <a href="{{ route('vitals.create') }}" class="btn btn-primary waves-effect waves-light mb-3"> <i
                    class="uil uil-plus-circle me-2"></i>Tambah Vital Sign</a>

            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Perawat</th>
                                <th>Berat</th>
                                <th>Systolic</th>
                                <th>Diastolic</th>
                                <th>Di buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($vitals as $vital)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vital->patient->name }}</td>
                                <td>{{ $vital->nurse->name }}</td>
                                <td>{{ $vital->weight }} Kg</td>
                                <td>{{ $vital->systolic }}</td>
                                <td>{{ $vital->diastolic }}</td>
                                <td>{{ \Carbon\Carbon::parse($vital->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('vitals.edit', $vital->id) }}"
                                            class="btn btn-warning waves-effect waves-light">
                                            <i class="uil uil-edit me-2"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-danger waves-effect waves-light delete-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal"
                                            data-id="{{ $vital->id }}">
                                            <i class="uil uil-trash-alt me-2"></i>Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pasien ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.delete-btn').click(function() {
            let id = $(this).data('id');
            let form = $('#deleteForm');
            form.attr('action', '/vitals/' + id);
        });
    </script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
