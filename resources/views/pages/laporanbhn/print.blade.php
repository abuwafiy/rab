@extends('layouts.pdf')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <table width="100%">
            <tr>
                <td width="33%" style="font-size: 12px;"> <img class="text-right" src="{{ asset('img/ladiva.jpg') }}" height="90" style="margin:0px"></td>
                <td width="33%" style="text-align: right;font-size: 12px;"> <img class="text-left" src="{{ asset('img/logo.jpg') }}" width="300" style="margin:0px"> </td>
            </tr>
        </table>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <table width="100%">
            <tr>
                <td width="100%" class="text-center">
                    <h6 style="font-size: 14px;font-weight: bold">LAPORAN REALISASI PROYEK</h6>
                </td>
            </tr>
        </table>
        <hr>
    </div>
</div>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-sm-12">
        <table class="tbl">
            <thead>
                <tr>
                    <td width="150px"><b>Nama Proyek</b></td>
                    <td>:</td>
                    <td width="500px"> <b>{{$rab['nama_proyek']}}</b></td>
                    
                </tr>
                <tr>
                    <td width="20%"><b>Nama Rab</b></td>
                    <td>:</td>
                    <td width="50%"><b>{{ $rab['nama_rab'] }}</b></td>
                </tr>
                <tr>
                    <td><b>Luas Bangunan</b></td>
                    <td>:</td>
                    <td> <b>{{ $rab['luas_bangunan'] }} M2</b></td>

                </tr>   
                <tr>
                    <td><b>Lokasi Proyek</b></td>
                    <td>:</td>
                    <td><b>{{ $rab['lokasi'] }}</b></td>

                </tr>
                <tr>
                    <td><b>Luas tanah</b></td>
                    <td>:</td>
                    <td><b>{{ $rab['luas_tanah'] }} M2</b></td>
                </tr>
            </thead>
        </table>
    </div>
</div>  
<div class="row">
    <div class="col-xs-12">
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

                @foreach($report as $d)
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
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th class="text-right">{{ number_format($summary['rab'], 2, '.', ',') }}</th>
                    <th class="text-right">{{ number_format($summary['realisasi'], 2, '.', ',') }}</th>
                    <th class="text-right">{{ number_format($summary['selisih'], 2, '.', ',') }}</th>
                    <th class="text-right">{{ number_format($summary['indeks'], 2, '.', ',') }}%</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<footer>Dicetak pada tanggal {{ date('Y-m-d H:i:s') }}</footer>
@endsection
