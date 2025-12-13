@extends('layouts.app')
@section('menuDataPengguna', 'active')
@section('content')
  @livewire('superadmin.user.index')
@endsection
@push('styles')
    <link data-navigate-once href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script data-navigate-once src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
@endpush
