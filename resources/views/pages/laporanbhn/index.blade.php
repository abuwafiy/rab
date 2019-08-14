@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body py-3">
        <form action="" method="GET">
              <div class="form-group">
                <label for="exampleFormControlInput1"><b>Cari Proyek</b></label>
                <select class="selectpicker form-control" data-live-search="true" id="id_rab" name="id_rab" onchange="this.form.submit()">
                    <option></option>
                    @foreach($rab as $r)
                    <option  value="{{ $r->id_rab }}">{{ $r->nama_rab }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelku" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID Pengajuan</th>
                        <th width="20px">ID Proyek</th>
                        <th class="text-right">ID RAB</th>
                        <th class="text-right">ID Kategori</th>
                        <th class="text-right">Keterangan Pengajuan</th>
                        <th class="text-right">Tangggal Pengajuan</th>
                        <th class="text-right">Status Approval</th>
                    </tr>
                </thead>
                <tbody>

           
                @foreach($pengajuan_tambah_bahan as $x)
                <tr>
                    <td class="text-right">{{ $x ['id_pengajuan'] }}</td>
                    <td class="text-right">{{ $x ['id_proyek'] }}</td>
                    <td class="text-right">{{ $x ['id_rab'] }}</td>
                    <td class="text-right">{{ $x ['id_kategori'] }}</td>
                    <td class="text-right">{{ $x ['keterangan_pengajuan'] }}</td>
                    <td class="text-right">{{ $x ['tanggal_pengajuan'] }}</td>
                    <td class="text-right">{{ $x ['status_approval'] }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
         $('#id_rab').val('{{ $id_rab }}').selectpicker('refresh');
</script>
@endsection