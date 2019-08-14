@extends('layouts.app')

@section('content')
<form action="{{ route('rab.store') }}" method="POST">
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-12">

			<a href="{{ url('rab') }}" class="btn-sm" style="float: right;"><- Back</a>
			<h6 class="m-0 font-weight-bold text-primary pull-left">Form Detail RAB</h6>
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
								<td><b>Estimasi Biaya Proyek</b></td>
								<td>:</td>
								<td><b>{{ number_format($rab['budget']) }}</b></td>
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
						<th style="padding-left: 20px">Uraian Pekerjaan</th>
						<th>Durasi</th>
						<th>Mulai</th>
						<th>Selesai</th>
						<th>Satuan</th>
						<th  class="text-right">Volume</th>
						<th class="text-right">Harga Satuan</th>
						<th class="text-right">Total Harga</th>
						<th width="10px">Action</th>
					</tr>
				</thead>
				<tbody id="myTable">
				</tbody>
			</table>
			<a href="javascript:void(0)" class="btnmodalku"><i class="fa fa-plus"></i> Tambah Pekerjaan</a>
		</div>
	</div>
</form>

<!-- The Modal -->
<div class="modal" id="modalku" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Pekerajaan</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Kategori Pekerjaan</label>
					<div class="col-sm-10">
						<select class="form-control" id="id_kategori">
							@foreach($kategori as $k)
							<option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Nama Pekerjaan</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="kegiatan" required="required" placeholder="Ex: Galian Tanah">
					</div>
				</div>	
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Volume</label>
					<div class="col-sm-8">
						<input type="number" class="form-control"  id="volume_rab" required="required" placeholder="Ex: 3000">
					</div>
					<div class="col-sm-2">
						<select class="form-control" id="satuan_rab">
							@foreach($satuan as $s)
							<option>{{ $s->nama_satuan }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Mulai</label>
					<div class="col-sm-10">
						<input type="date" id="tanggal_mulai" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Selesai</label>
					<div class="col-sm-10">
						<input type="date" id="tanggal_selesai" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
			</div>
		</div>
	</div>
</div>

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
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="form-group row">
							<label for="colFormLabel" class="col-sm-2 col-form-label">Kategori Pekerjaan</label>
							<div class="col-sm-10">
								<select class="form-control" id="id_kategori2">
									@foreach($kategori as $k)
									<option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="colFormLabel" class="col-sm-2 col-form-label">Nama Pekerjaan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="kegiatan2" required="required" placeholder="Ex: Galian Tanah">
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
					html = html + '<tr><td class="sub-table" colspan = "9"><b>'+ value.NAMA_KATEGORI +'</b></td></tr>';
					var params = 'id_rab={{ $rab->id_rab }}';
					params = params + '&id_kategori=' + value.ID_KATEGORI;				
					var urls = '{{ route("api.detailrab") }}?'+params;
					$.ajax({
						url: urls,
						success: function (datas) {
							$.each(datas.data, function( indexs, values ) {
								SUBTOTAL = SUBTOTAL + parseInt(values.biaya);
								html = html + '<tr class="clickable-row" data-id="'+ values.id_detail_rab +'">'+
								'<td class="pad-10">'+values.kegiatan+'</td>'+
								'<td>'+values.durasi+'</td>'+
								'<td>'+values.tanggal_mulai+'</td>'+
								'<td>'+values.tanggal_selesai+'</td>'+
								'<td>'+values.satuan_rab+'</td>'+
								'<td class="text-right">'+values.volume_rab+'</td>'+
								'<td class="text-right">'+numberFormat(values.harga_satuan)+'</td>'+
								'<td class="text-right">'+numberFormat(values.biaya)+'</td>'+
								'<td><a href="javascript:void(0)" class="delete btn" data-id="'+ values.id_detail_rab +'"><i class="fa fa-trash-alt"></i></a></td>'+
								'</tr>';
								
							});
							html = html + '<tr><td class="sub-subtotal text-right" colspan = "7"><b>Total '+ value.NAMA_KATEGORI +'</b></td>';
							TOTAL = TOTAL + parseInt(SUBTOTAL,0);
							html = html + '<td class="sub-subtotal text-right" colspan = "1"><b>'+ numberFormat(SUBTOTAL) +'</b></td>';
							html = html + '<td class="sub-subtotal text-right" colspan = "1"></td></tr>';
							
						}         
					});
				});
				html = html + '<tr><td class="sub-total text-right" colspan = "7"><b>Grand Total</b></td>';
				html = html + '<td class="sub-total text-right" colspan = "1"><b>'+ numberFormat(TOTAL) +'</b></td>';
				html = html + '<td class="sub-total text-right" colspan = "1"></td></tr>';
				$('#myTable').html(html);
			}    
		});
		$.ajaxSetup({async: true});
	}

	$(document).on('click', '.clickable-row', function (e) {
		id_detail_rab = $(this).data("id");
		var param = 'id_detail_rab='+$(this).data("id");
		var url = '{{ route("api.getdetailrab") }}?'+param;
		$.ajax({
			url: url,
			success: function (res) {
				$('#id_kategori2').val(res.id_kategori);
				$('#kegiatan2').val(res.kegiatan);
				$('#volume_rab2').val(res.volume_rab);
				$('#satuan_rab2').val(res.satuan_rab);
				$('#tanggal_mulai2').val(res.tanggal_mulai);
				$('#tanggal_selesai2').val(res.tanggal_selesai);
				$('#modaledit').modal('show');
			}         
		});
		loadDetailBahan(id_detail_rab);
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
					url: "{{ url('api/detailrab') }}/" + id,
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
		$('#kegiatan').val('');
		$('#tanggal_mulai').val('');
		$('#tanggal_selesai').val('');
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
		dataBahan[idx]['id_detail_bahan'] = -1;
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
		var url = '{{ route("api.store.detailbahan") }}';
		var token = $("meta[name='csrf-token']").attr("content");
		var id_kategori = $('#id_kategori2').val();
		var kegiatan = $('#kegiatan2').val();
		var volume_rab = $('#volume_rab2').val();
		var satuan_rab = $('#satuan_rab2').val();
		var tanggal_mulai = $('#tanggal_mulai2').val();
		var tanggal_selesai = $('#tanggal_selesai2').val();
		$.ajax({
			method: "post",
			url: url,
			data :{
				"id_kategori" : id_kategori,
				"kegiatan" : kegiatan,
				"tanggal_mulai" : tanggal_mulai,
				"tanggal_selesai" : tanggal_selesai,
				"volume_rab" : volume_rab,
				"satuan_rab" : satuan_rab,
				"id_detail_rab" : id_detail_rab,
				"data" : dataBahan,
				"_token": token,
			},
			success: function (res) {
				$('#modaledit').modal('hide');
				loadData();
			}         
		});
	});

	function loadDetailBahan(id_det_rab){

		idx = 0;
		dataBahan = [];
		var row = '';
		var param = 'id_detail_rab='+id_det_rab;
		var url = '{{ route("api.getdetailbahan") }}?'+param;
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
						'<td><a href="javascript:void(0)" class="deletebahan btn" data-id="'+ value.id_detail_bahan +'"><i class="fa fa-trash-alt"></i></a></td>'+
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
						'<td><a href="javascript:void(0)" class="deletebahan btn" data-id="'+ value.id_detail_bahan +'"><i class="fa fa-trash-alt"></i></a></td>'+
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
					url: "{{ url('api/detailbahan') }}/" + id,
					data: {
						"id": id,
						"_token": token,
					},
					success: function (data) {
						loadDetailBahan(data.id_detail_rab);
					}         
				});
			}
		});
	});
</script>
@endsection