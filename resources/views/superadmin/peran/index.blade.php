@extends('layouts.app')
@section('title', 'Data Peran')
@section('menuDataPengguna', 'active')
@section('content')
    @livewire('superadmin.peran.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
