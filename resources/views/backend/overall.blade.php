@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-2">
        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        Content
        <div class="">
          {!! $chart->container() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  {!! $chart->script() !!}
@endsection

