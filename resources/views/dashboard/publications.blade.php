@extends('layouts.dashboard')

@section('title', 'Publisys - Galería')
@section('dashboard-title', 'Galería')
@section('dashboard-subtitle', 'Administra las publicaciones de tu galería')

@section('content')
  @include('dashboard.partials.publications-card')
@endsection
