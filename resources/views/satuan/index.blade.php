@extends('layouts.app')
@section('menuDataPengguna', 'active')
@section('content')
    @livewire('satuan.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
