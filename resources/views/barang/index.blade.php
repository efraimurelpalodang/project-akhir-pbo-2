@extends('layouts.app')
@section('title','Data Barang')
@section('menuDataPengguna', 'active')
@section('content')
    @livewire('barang.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
