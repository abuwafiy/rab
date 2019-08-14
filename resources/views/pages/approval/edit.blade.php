@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form pengajuan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('approval.update',$pengajuan->id_pengajuan) }}" method="POST">
            @csrf
            @include('pages.approval.form')
            @method('PUT')
      </form>
  </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#id_proyek').val('{{ $pengajuan->id_proyek}}')
        $('#id_rab').val('{{ $pengajuan->id_rab}}')
        $('#id_kategori').val('{{ $pengajuan->id_kategori}}')
    </script>
@endsection
