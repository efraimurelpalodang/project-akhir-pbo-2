@extends('layouts.app')
@section('title','Sales Order')
@section('content') 
    @livewire('salesOrder.index')
@endsection
@push('styles')
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush