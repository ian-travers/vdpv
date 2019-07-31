@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="wagon-card d-flex justify-content-between">
      <p class="lead">{{ $wagon->inw }}</p>
      <p class="lead">{{ $wagon->detained_by }}</p>
      <p class="lead">{{ $wagon->reason }}</p>
      <p class="lead">{{ $wagon->arrived_at }}</p>
      <p class="lead">{{ $wagon->detained_at }}</p>
    </div>
  </div>
@endsection

