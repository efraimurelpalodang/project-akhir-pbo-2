@extends('layouts.app')
@section('title', 'Data Satuan')
@section('menuDataPengguna', 'active')
@section('content')
    @livewire('satuan.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
