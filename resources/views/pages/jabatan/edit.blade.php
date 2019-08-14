@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form jabatan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('jabatan.update',$jabatan->id_jabatan) }}" method="POST">
            @csrf
            @include('pages.jabatan.form')
            @method('PUT')
      </form>
  </div>
</div>


@endsection

@section('script')

@endsection
