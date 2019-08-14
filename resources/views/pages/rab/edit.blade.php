@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form RAB</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('rab.update',$rab->id_rab) }}" method="POST">
            @csrf
            @include('pages.rab.form')
            @method('PUT')
      </form>
  </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">
        $('#id_proyek').val('{{ $rab->id_proyek}}')
    </script>
@endsection
