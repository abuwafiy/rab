@extends('layouts.app')

@section('content')
<form action="{{ route('rab.store') }}" method="POST">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-12">

      <a href="{{ url('rab') }}" class="btn-sm" style="float: right;"><- Back</a>
      <h6 class="m-0 font-weight-bold text-primary pull-left">Form Detail Realisasi</h6>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <table class="tbl">
            <thead>
              <tr>
                <td width="150px"><b>Nama Proyek</b></td>
                <td>:</td>
                <td> <b>{{$rab['nama_proyek']}}</b></td>
              </tr>
              <tr>
                <td><b>Luas Bangunan</b></td>
                <td>:</td>
                <td> <b>{{ $rab['luas_bangunan'] }}</b></td>
              </tr> 
              <tr>
                <td><b>Lokasi Proyek</b></td>
                <td>:</td>
                <td><b>{{ $rab['lokasi'] }}</b></td>
              </tr>
            </thead>
          </table>
        </div>
        <div class="col-md-6">
          <table class="tbl">
            <thead>
              <tr>
                <td width="150px"><b>Nama Rab</b></td>
                <td>:</td>
                <td><b>{{ $rab['nama_rab'] }}</b></td>
                
              </tr>
              <tr>
                <td><b>Realisasi Biaya Proyek</b></td>
                <td>:</td>
                <td><b><span id="myReal"></span></b></td>
              </tr> 
              <tr>
                <td><b>Luas tanah</b></td>
                <td>:</td>
                <td><b>{{ $rab['luas_tanah'] }}</b></td>
              </tr>
            </thead>
          </table>
        </div>
      </div>  
    </div>
    <div class="card-body mepet">
      <table class="table table-hover" id="dataTabel">
        <thead>
          <tr>
            <th style="width: 20px;">Do</i></th>
            <th>Uraian Pekerjaan</th>
            <th>Durasi</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Satuan</th>
            <th  class="text-right">Volume</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Total Harga</th>
            <th width="10px">Act</th>
          </tr>
        </thead>
        <tbody id="myTable">
        </tbody>
      </table>
    </div>
  </div>
</form>


<!-- The Modal -->
<div class="modal" id="modaledit" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Pekerajaan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Umum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sumber Daya</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <input type="hidden" class="form-control" id="id_rab_realisasi" required="required">
          <input type="hidden" class="form-control" id="tipe" required="required">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori Pekerjaan</label>
              <div class="col-sm-10">
                <select class="form-control" id="id_kategori2" readonly="readonly" disabled="disabled">
                  @foreach($kategori as $k)
                  <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Pekerjaan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="kegiatan2" required="required" readonly="readonly" placeholder="Ex: Galian Tanah">

              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Volume</label>
              <div class="col-sm-8">
                <input type="number" class="form-control"  id="volume_rab2" required="required" placeholder="Ex: 3000">
              </div>
              <div class="col-sm-2">
                <select class="form-control" id="satuan_rab2">
                  @foreach($satuan as $s)
                  <option>{{ $s->nama_satuan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Mulai</label>
              <div class="col-sm-10">
                <input type="date" id="tanggal_mulai2" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Selesai</label>
              <div class="col-sm-10">
                <input type="date" id="tanggal_selesai2" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label">Persentase</label>
              <div class="col-sm-2">
                <input type="number" id="persentase2" class="form-control">
              </div>
              <label for="colFormLabel" class="col-sm-8 col-form-label"><b>%</b></label>
            </div>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Deskripsi</th>
                  <th width="50px">Satuan</th>
                  <th width="100px">Indeks</th>
                  <th class="text-right">Biaya</th>
                  <th width="10px">Action</th>
                </tr>
              </thead>
              <tbody id="tableBahan">

              </tbody>
            </table>
            <a href="javascript:void(0)" id="tambahBahan"><i class="fa fa-plus"></i> Tambah Sumber Daya</a>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <button type="button" class="ubah btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal" id="modalBahan" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content" style="background-color: #f2f4f7">
      <div class="modal-header">
        <h4 class="modal-title">List Bahan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-hover" id="datatbl" style="width: 100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Bahan</th>
              <th>Satuan</th>
              <th>Biaya</th>
            </tr>
          </thead>
          <tbody id="tableBahan">

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
  loadData();
  function loadData(){
    $('#myTable').html('');
    var param = 'id_rab={{ $rab->id_rab }}';
    var TOTAL = 0;        
    var url = '{{ route("api.headerrab") }}?'+param;
    var html = '';
    $.ajaxSetup({async: false});
    $.ajax({
      url: url,
      success: function (data) {
        var count = data.data.length;
        $.each(data.data, function( index, value ) {
          var SUBTOTAL = 0;
          html = html + '<tr><td class="sub-table" colspan = "10"><b>'+ value.NAMA_KATEGORI +'</b></td></tr>';
          var params = 'id_rab={{ $rab->id_rab }}';
          params = params + '&id_kategori=' + value.ID_KATEGORI;        
          var urls = '{{ route("api.getdetailrealisasi") }}?'+params;
          $.ajax({
            url: urls,
            success: function (datas) {
              $.each(datas.data, function( indexs, values ) {
                SUBTOTAL = SUBTOTAL + parseInt(values.biaya);
                var check = '<i class="fa fa-check" style="color:#d0d5db"></i>';
                if(values.persentase == 100){
                  check = '<i class="fa fa-check" style="color:#0ee640"></i>';
                }
                if(values.id_detail_realisasi == null){
                  html = html + '<tr class="clickable-row" data-id="'+ values.id_detail_rab +'">';
                }else{
                  html = html + '<tr class="clickable-rows" data-id="'+ values.id_detail_realisasi +'">';
                }
                html = html +
                '<td class="text-center">'+check+'</td>'+
                '<td>'+values.kegiatan+'</td>'+
                '<td>'+values.durasi+'</td>'+
                '<td>'+values.tanggal_mulai+'</td>'+
                '<td>'+values.tanggal_selesai+'</td>'+
                '<td>'+values.satuan_realisasi+'</td>'+
                '<td class="text-right">'+values.volume_realisasi+'</td>'+
                '<td class="text-right">'+numberFormat(values.harga_satuan)+'</td>'+
                '<td class="text-right">'+numberFormat(values.biaya)+'</td>'+
                '<td><a href="javascript:void(0)" class="delete btn" data-id="'+ values.id_detail_realisasi +'"><i class="fa fa-trash-alt"></i></a></td>'+
                '</tr>';
                
              });
              html = html + '<tr><td class="sub-subtotal text-right" colspan = "8"><b>Total '+ value.NAMA_KATEGORI +'</b></td>';
              TOTAL = TOTAL + parseInt(SUBTOTAL,0);
              html = html + '<td class="sub-subtotal text-right" colspan = "1"><b>'+ numberFormat(SUBTOTAL) +'</b></td>';
              html = html + '<td class="sub-subtotal text-right" colspan = "1"></td></tr>';
              
            }         
          });
        });
        html = html + '<tr><td class="sub-total text-right" colspan = "8"><b>Grand Total</b></td>';
        html = html + '<td class="sub-total text-right" colspan = "1"><b>'+ numberFormat(TOTAL) +'</b></td>';
        html = html + '<td class="sub-total text-right" colspan = "1"></td></tr>';
        $('#myTable').html(html);
        $('#myReal').html(numberFormat(TOTAL));
      }    
    });
    $.ajaxSetup({async: true});
  }

  $(document).on('click', '.clickable-row', function (e) {
    clearForm();
    id_detail_rab = $(this).data("id");
    var param = 'id_detail_rab='+$(this).data("id");
    var url = '{{ route("api.getdetailrab") }}?'+param;
    $.ajax({
      url: url,
      success: function (res) {
        $('#id_rab_realisasi').val(id_detail_rab);
        $('#tipe').val('simpan');
        $('#id_kategori2').val(res.id_kategori);
        $('#kegiatan2').val(res.kegiatan);
        $('#modaledit').modal('show');
      }         
    });
  });
  $(document).on('click', '.clickable-rows', function (e) {
    clearForm();
    id_detail_realisasi = $(this).data("id");
    var param = 'id_detail_realisasi='+$(this).data("id");
    var url = '{{ route("api.finddetailrealisasi") }}?'+param;
    $.ajax({
      url: url,
      success: function (res) {

        $('#id_rab_realisasi').val(id_detail_realisasi);
        $('#tipe').val('ubah');
        $('#id_kategori2').val(res.id_kategori);
        $('#kegiatan2').val(res.kegiatan);
        $('#volume_rab2').val(res.volume_realisasi);
        $('#satuan_rab2').val(res.satuan_realisasi);
        $('#tanggal_mulai2').val(res.tanggal_mulai);
        $('#tanggal_selesai2').val(res.tanggal_selesai);
        $('#persentase2').val(res.persentase);
        $('#modaledit').modal('show');
      }         
    });
    loadDetailBahan(id_detail_realisasi);
  });
  

  $('#simpan').click(function(){
    var url = '{{ route("api.store.detailrab") }}';
    var id_rab = '{{ $rab->id_rab }}';
    var id_kategori = $('#id_kategori').val();
    var kegiatan = $('#kegiatan').val();
    var tanggal_mulai = $('#tanggal_mulai').val();
    var tanggal_selesai = $('#tanggal_selesai').val();
    var volume_rab = $('#volume_rab').val();
    var satuan_rab = $('#satuan_rab').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
      method: "post",
      url: url,
      data :{
        "id_rab" : id_rab,
        "id_kategori" : id_kategori,
        "kegiatan" : kegiatan,
        "volume_rab" : volume_rab,
        "satuan_rab" : satuan_rab,
        "tanggal_mulai" : tanggal_mulai,
        "tanggal_selesai" : tanggal_selesai,
        "_token": token,
      },
      success: function (res) {
        $('#modalku').modal('hide');
        clearForm();
        loadData();
      }         
    });
  });

  $(document).on('click', '.delete', function (e) {
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
          url: "{{ url('realisasi') }}/" + id,
          data: {
            "id": id,
            "_token": token,
          },
          success: function (data) {
            loadData();
          }         
        });
      }
    });
  });

  function clearForm(){
    $('#kegiatan2').val('');
    $('#tanggal_mulai2').val('');
    $('#tanggal_selesai2').val('');
    $('#persentase2').val('');
    $('#volume_rab2').val('');
    $('#tableBahan').html('');
    dataBahan = [];

  }

  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  })

  $('#tambahBahan').click(function(){
    $('#modalBahan').modal('show');
  });

  var table = $('#datatbl').DataTable( {
    "processing": true,
    "serverSide": false,
    "searching": true,
    "ordering": true,
    "ajax" : {
      "url" : '{{ route("api.getbahan") }}',
      "error" : function (jqXHR, textStatus, errorThrown) {
        $('#datatbl').DataTable().clear().draw();
      }
    },
    "columns": [
    {"data" : "id_bahan"},
    {"data" : "nama_bahan"},
    {"data" : "satuan"},
    {"data" : "harga"},
    ],
    "deferRender": true,
    "pageLength" : 10,
    "responsive" : true
  });
  var dataBahan = [];
  var idx = 0;
  var id_detail_rab = 0;


  $('#datatbl tbody').on('click','tr', function(){
    var data = table.row( this ).data();

    $('#tableBahan').append('<tr>'+
      '<td>'+data.nama_bahan+'</td>'+
      '<td>'+data.satuan+'</td>'+
      '<td><input type="number" data-id="'+idx+'" class="edit form-control" style="width:90px"></td>'+
      '<td>'+data.harga+'</td>'+
      '<td><a href="javascript:void(0)" class="delete btn" data-id="'+ data.id_bahan +'"><i class="fa fa-trash-alt"></i></a></td>'+
      '</tr>');
    dataBahan[idx] = data;
    dataBahan[idx]['id_detail_bahan_realisasi'] = -1;
    dataBahan[idx]['volume'] = 0;
    idx++;
    $('#modalBahan').modal('toggle'); 
  });

  $(document).on('change', '.edit', function (e) {
    dataBahan[$(this).data('id')]['volume'] = $(this).val();
  });
  $(document).on('keyup', '.edit', function (e) {
    dataBahan[$(this).data('id')]['volume'] = $(this).val();
  });

  $(document).on('click', '.ubah', function (e) {
    var id_detail_rabs = $('#id_rab_realisasi').val();
    var url = "{!! route('realisasi.update',['id' => '']) !!}"+"/"+id_detail_rabs;
    var method = 'PUT';
    var tipe = $('#tipe').val();
    if(tipe == 'simpan'){
      url = '{{ route("realisasi.store") }}';
      var method = 'POST';
    }
    var token = $("meta[name='csrf-token']").attr("content");
    var id_kategori = $('#id_kategori2').val();
    var kegiatan = $('#kegiatan2').val();
    var volume_rab = $('#volume_rab2').val();
    var satuan_rab = $('#satuan_rab2').val();
    var tanggal_mulai = $('#tanggal_mulai2').val();
    var tanggal_selesai = $('#tanggal_selesai2').val();
    
    var persentase = $('#persentase2').val();

    var urls = "{!! route('api.peringatan',['id_detail_realisasi' => '']) !!}"+id_detail_rabs;
    $.ajax({
      url: urls,
      success: function (res) {
        console.log(id_detail_rabs);
        if(res.error == "noerror" && tipe != "simpan"){
          var total = 0;
          var hargasatuan = 0;
          dataBahan.forEach(function(value) {
            hargasatuan = value['harga']*value['volume'];
            total = total + hargasatuan;
          });
          total = total * volume_rab;
          console.log(total);
          if(total > parseInt(res.biaya,0)){
            swal({
              title: "Apakah anda yakin?",
              text: "PERINGATAN, BIAYA REALISASI : "+ numberFormat(res.biaya_realisasi) +" TELAH LEBIH DARI 90% BIAYA PERENCANAAN : "+ numberFormat(res.biaya_rencana) +"~SILAHKAN KORDINASI DENGAN MANAJER PERENCANAAN !!~",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
               $.ajax({
                method: method,
                url: url,
                data :{
                  "id_kategori" : id_kategori,
                  "kegiatan" : kegiatan,
                  "tanggal_mulai" : tanggal_mulai,
                  "tanggal_selesai" : tanggal_selesai,
                  "volume_realisasi" : volume_rab,
                  "satuan_realisasi" : satuan_rab,
                  "id_detail_rab" : id_detail_rabs,
                  "persentase" : persentase,
                  "data" : dataBahan,
                  "_token": token,
                },
                success: function (res) {
                  $('#modaledit').modal('hide');
                  loadData();
                }         
              });
             }
           });
          }else{
            $.ajax({
                method: method,
                url: url,
                data :{
                  "id_kategori" : id_kategori,
                  "kegiatan" : kegiatan,
                  "tanggal_mulai" : tanggal_mulai,
                  "tanggal_selesai" : tanggal_selesai,
                  "volume_realisasi" : volume_rab,
                  "satuan_realisasi" : satuan_rab,
                  "id_detail_rab" : id_detail_rabs,
                  "persentase" : persentase,
                  "data" : dataBahan,
                  "_token": token,
                },
                success: function (res) {
                  $('#modaledit').modal('hide');
                  loadData();
                }         
              });
          }

        }else{
          var urlk = "{!! route('api.hitungperencanaan',['id_detail_rab' => '']) !!}"+id_detail_rabs+'&id_detail_realisasi='+id_detail_rabs;
          console.log(id_detail_rabs);

          $.ajax({
            url: urlk,
            success: function (res) {
              var total = 0;
              var hargasatuan = 0;
              dataBahan.forEach(function(value) {
                hargasatuan = value['harga']*value['volume'];
                total = total + hargasatuan;
              });
              total = total * volume_rab;
              console.log(total);
              if(total > parseInt(res.biaya,0)){
                swal({
                  title: "Apakah anda yakin?",
                  text: "PERINGATAN, BIAYA REALISASI : "+ numberFormat(total) +" TELAH LEBIH DARI 90% BIAYA PERENCANAAN : "+ numberFormat(res.biaya) +"! \n\n ~SILAHKAN KORDINASI DENGAN MANAJER PERENCANAAN !!~",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                   $.ajax({
                    method: method,
                    url: url,
                    data :{
                      "id_kategori" : id_kategori,
                      "kegiatan" : kegiatan,
                      "tanggal_mulai" : tanggal_mulai,
                      "tanggal_selesai" : tanggal_selesai,
                      "volume_realisasi" : volume_rab,
                      "satuan_realisasi" : satuan_rab,
                      "id_detail_rab" : id_detail_rabs,
                      "persentase" : persentase,
                      "data" : dataBahan,
                      "_token": token,
                    },
                    success: function (res) {
                      $('#modaledit').modal('hide');
                      loadData();
                    }         
                  });
                 }
               });
              }else{
                $.ajax({
                  method: method,
                  url: url,
                  data :{
                    "id_kategori" : id_kategori,
                    "kegiatan" : kegiatan,
                    "tanggal_mulai" : tanggal_mulai,
                    "tanggal_selesai" : tanggal_selesai,
                    "volume_realisasi" : volume_rab,
                    "satuan_realisasi" : satuan_rab,
                    "id_detail_rab" : id_detail_rabs,
                    "persentase" : persentase,
                    "data" : dataBahan,
                    "_token": token,
                  },
                  success: function (res) {
                    $('#modaledit').modal('hide');
                    loadData();
                  }         
                });
              }
            }
          });


          
        }

      }         
    });


});

function loadDetailBahan(id_det_rab){
  idx = 0;
  dataBahan = [];
  var row = '';
  var param = 'id_detail_realisasi='+id_det_rab;
  var url = '{{ route("api.getdetailbahanrealisasi") }}?'+param;
  $.ajax({
    url: url,
    success: function (res) {
      if(res.length == 0){
        $('#tableBahan').html('');
      }
      row=row + '<tr><td class="subheader1" colspan="5">Bahan Material</td></tr>';
      $.each(res, function( index, value ) {
        if(value.kategori_bahan == 'Material'){
          row = row + '<tr>'+
          '<td>'+value.nama_bahan+'</td>'+
          '<td>'+value.satuan+'</td>'+
          '<td><input type="number" data-id="'+idx+'" class="edit form-control" style="width:90px" value="'+value.volume+'"></td>'+
          '<td class="text-right">'+numberFormat(value.harga)+'</td>'+
          '<td><a href="javascript:void(0)" class="deletebahan btn" data-id="'+ value.id_detail_bahan_realisasi +'"><i class="fa fa-trash-alt"></i></a></td>'+
          '</tr>';
          dataBahan[idx] = value;
          idx++;
          $('#tableBahan').html(row);
        }
      });
      row=row + '<tr><td class="subheader2" colspan="5">Pekerja / Tukang</td></tr>';
      $.each(res, function( index, value ) {
        if(value.kategori_bahan == 'Upah'){
          row = row + '<tr>'+
          '<td>'+value.nama_bahan+'</td>'+
          '<td>'+value.satuan+'</td>'+
          '<td><input type="number" data-id="'+idx+'" class="edit form-control" style="width:90px" value="'+value.volume+'"></td>'+
          '<td class="text-right">'+numberFormat(value.harga)+'</td>'+
          '<td><a href="javascript:void(0)" class="deletebahan btn" data-id="'+ value.id_detail_bahan_realisasi +'"><i class="fa fa-trash-alt"></i></a></td>'+
          '</tr>';
          dataBahan[idx] = value;
          idx++;
          $('#tableBahan').html(row);
        }
      });
    }         
  });
}

$(document).on('click','.btnmodalku', function(){
  clearForm();
  $('#modalku').modal('show');
});

$(document).on('click', '.deletebahan', function (e) {
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
        url: "{{ url('api/detailbahanrealisasi') }}/" + id,
        data: {
          "id": id,
          "_token": token,
        },
        success: function (data) {
          loadDetailBahan(data.id_detail_realisasi);
          loadData();
        }         
      });
    }
  });
});
</script>
@endsection