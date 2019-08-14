@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Kategori</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update',$kategori->id_kategori) }}" method="POST">
            @csrf
            @include('pages.kategori.form')
            @method('PUT')
      </form>
  </div>
</div>


@endsection

@section('script')

@endsection
