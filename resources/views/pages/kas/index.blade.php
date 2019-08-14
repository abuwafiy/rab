@extends('layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('kas.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Tambah</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelku" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="60px">ID Kas</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo</th>
                        <th width="128px">Action</th>
                    </tr>
                </thead>
                <tbody>
             
                    @foreach($kas as $d)
                    @if ($d->saldo == 0 )

                    @endif
                    <tr>
                        <td>{{ $d->id_kas }}</td>
                        <td>{{ $d->tanggal }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>{{ $d->pemasukan }}</td>
                        <td>{{ $d->pengeluaran }}</td>
                        <td>{{ $d->saldo + $d->pemasukan - $d->pengurangan }}</td>
                        <td>
                            <a href="{{ route('kas.edit',$d->id_kas) }}" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i> Ubah</a>
                            <a href="javascript:void(0)" class="delete btn-sm btn-danger" data-id="{{ $d->id_kas }}"><i class="fa fa-trash-alt"></i> Hapus</a>
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

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
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
                    url: "{{ url('kas') }}/" + id,
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (data) {
                        window.location = "{{ url('kas') }}"
                    }         
                });
            }
        });
    });
</script>
@endsection
