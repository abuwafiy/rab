@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form karyawan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            @include('pages.karyawan.form')
      </form>
  </div>
</div>


@endsection

@section('script')

@endsection
