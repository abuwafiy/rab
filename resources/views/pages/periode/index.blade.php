@extends('layouts.app')
@section('content')
<div class="card shadow mb-4">
    <div class="card-body py-3">
        <form action="" method="GET"> 
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label><b>Dari :</b></label>
                        <input class="form-control col-md-4" type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{$tanggal_mulai ?? ''}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label><b>Sampai :</b></label>
                        <input class="form-control col-md-4" type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{$tanggal_selesai ?? ''}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                 <div class="form-group">
                    <label for="exampleFormControlInput1"><b>Proyek :</b></label><br>
                    <select class="selectpicker form-control col-md-4" data-live-search="true" id="id_rab" name="id_rab" onchange="this.form.submit()">
                        <option></option>
                        @foreach($rab as $r)
                        <option  value="{{ $r->id_rab }}">{{ $r->nama_rab }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ url('pdf/realisasi') }}?id_rab={{ $id_rab }}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelku" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Kegiatan/Pekerjaan</th>
                        <th width="20px">Complete(%)</th>
                        <th class="text-right">Total RAB (Rp.)</th>
                        <th class="text-right">Total Realisasi (Rp.)</th>
                        <th class="text-right">Selisih (Rp.)</th>
                        <th class="text-right">Indeks (%)</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($periode as $d)
                    <tr>
                        <td colspan="6" style="background-color: #dce4e8;font-weight: bold">{{ $d['nama_kategori'] }}</td>
                    </tr>
                    @isset($d['detail'])
                    @foreach($d['detail'] as $x)
                    <tr>
                        <td style="padding-left: 20px;">{{ $x['kegiatan'] }}</td>
                        <td class="text-right">{{ $x['persentase'] }}%</td>
                        <td class="text-right">{{ $x['rab'] }}</td>
                        <td class="text-right">{{ $x['realisasi'] }}</td>
                        <td class="text-right">{{ $x['selisih'] }}</td>
                        <td class="text-right">{{ $x['indeks'] }}%</td>
                    </tr>
                    @endforeach
                    @endisset
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