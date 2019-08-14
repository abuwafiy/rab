@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('rab.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelku" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="60px">ID Rab</th>
                        <th>Nama Proyek</th>
                        <th>Nama Rab</th>
                        <th>Lokasi</th>
                        <th>Luas Tanah</th>
                        <th>Luas Bangunan</th>
                        <th width="128px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rab as $d)
                    <tr class='clickable-row' data-href="{{ route('rab.show',$d->id_rab) }}">
                        <td>{{ $d->id_rab }}</td>
                        <td>{{ $d->nama_proyek }}</td>
                        <td>{{ $d->nama_rab }}</td>
                        <td>{{ $d->lokasi }}</td>
                        <td>{{ $d->luas_tanah }}</td>
                         <td>{{ $d->luas_bangunan }}</td>
                      
                        <td>
                            <a href="{{ route('rab.edit',$d->id_rab) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Ubah</a>
                            <a href="javascript:void(0)" class="delete btn-sm btn-danger" data-id="{{ $d->id_rab }}"><i class="fa fa-trash-alt"></i> Hapus</a>
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
                        url: "{{ url('rab') }}/" + id,
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data) {
                            window.location = "{{ url('rab') }}"
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