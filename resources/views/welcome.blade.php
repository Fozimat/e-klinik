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

    </div>

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

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="uil uil-pen me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                    </button>
                </div>
            @endif


        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
