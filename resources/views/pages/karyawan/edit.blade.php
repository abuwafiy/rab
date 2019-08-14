@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form karyawan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.update',$karyawan->nik) }}" method="POST">
            @csrf
            @include('pages.karyawan.form')
            @method('PUT')
      </form>
  </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">
        $('#id_jabatan').val('{{ $karyawan->id_jabatan }}')
    </script>
@endsection
