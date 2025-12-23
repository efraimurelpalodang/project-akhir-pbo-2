@extends('layouts.app')
@section('title', 'Data Pengguna')
@section('menuDataPengguna', 'active')
@section('content')
  @livewire('superadmin.user.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
