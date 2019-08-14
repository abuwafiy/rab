@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form kas</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kas.update',$kas->id_kas) }}" method="POST">
            @csrf
            @include('pages.kas.form')
            @method('PUT')
      </form>
  </div>
</div>

@endsection

@section('script')

@endsection
