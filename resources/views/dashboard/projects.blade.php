@extends('layouts.dashboard')

@section('title', 'Publisys - Proyectos')
@section('dashboard-title', 'Proyectos')
@section('dashboard-subtitle', 'Administra tus proyectos y enlaces')

@section('content')
  @include('dashboard.partials.projects-card')
@endsection
