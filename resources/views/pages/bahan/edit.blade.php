@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Proyek</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('bahan.update',$bahan->id_bahan) }}" method="POST">
            @csrf
            @include('pages.bahan.form')
            @method('PUT')
      </form>
  </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">
        $('#satuan').val('{{ $bahan->satuan }}')
    </script>
@endsection
