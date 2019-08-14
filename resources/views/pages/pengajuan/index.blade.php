@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <style type="text/css">
        .thwarna{
        background-color:#4e73df;        
        }
        thead th{
            color: white;
            position: center;
        }
    </style>
    <div class="card-header py-3">
        <a href="{{ route('pengajuan.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelku" class="table table-bordered table-hover">
                <thead>
                    <tr class="thwarna">
                        <th width="75px">ID Pengajuan</th>
                        <th>Nama Proyek</th>
                        <th>Nama Rab</th>
                        <th>Kategori Pekerjaan</th>
                        <th>Keterangan Pengajuan</th>
                       <th>Tanggal Pengajuan</th>
                       <th>Status</th>
                       <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan as $d)
                    <tr class='clickable-row' data-href="{{ route('pengajuan.show',$d->id_pengajuan) }}">
                        <td>{{ $d->id_pengajuan }}</td>
                        <td>{{ $d->nama_proyek }}</td>
                        <td>{{ $d->nama_rab }}</td>
                        <td>{{ $d->nama_kategori}}</td>
                        <td>{{ $d->keterangan_pengajuan }}</td>
                        <td>{{ $d->tanggal_pengajuan }}</td>
                        <td>
                         @if($d->status_approval == 0)
                         <span class="btn btn-warning">Pending</span>
                         @elseif($d->status_approval == 1)
                         <span class="btn btn-success">Approved</span>
                         @else($d->status_approval == 2)
                         <span class="btn btn-danger">Rejected</span>
                         @endif
                        </td>
                        <td>
                            <a href="{{ route('pengajuan.edit',$d->id_pengajuan) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Ubah</a>
                            <a href="javascript:void(0)" class="delete btn-sm btn-danger" data-id="{{ $d->id_pengajuan }}"><i class="fa fa-trash-alt"></i> Hapus</a>
                        </td>
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
    $(document).ready(function() {
        $('#tabelku').DataTable();
    });

    $('.delete').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");
            swal({
                title: "Apakah anda yakin?",
                text: "Setelah data dihapus data tidak akan bisa dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('pengajuan') }}/" + id,
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data) {
                            window.location = "{{ url('pengajuan') }}"
                        }         
                    });
                }
            });
        });

    $('.clickable-row').click(function(){
        window.location = $(this).data("href");
    });
</script>
@endsection