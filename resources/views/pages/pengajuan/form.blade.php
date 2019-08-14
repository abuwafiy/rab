<div class="form-group row">
    <input type="text" class="form-control"  name="id_pengajuan" value="{{ $pengajuan->id_pengajuan ?? '' }}" hidden="">
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Proyek</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_proyek" id="proPilih" >
      <option>----- PILIH PROYEK ----</option>
      @foreach($proyek as $j)
      <option value="{{ $j->id_proyek }}">{{ $j->nama_proyek }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama RAB</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_rab" id="id_rab">
      <option>----- PILIH RAB ----</option>
      @foreach($rab as $d)
      <option value="{{ $d->id_rab }}">{{ $d->nama_rab }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori Pekerjaan</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_kategori" id="id_kategori">
      <option>----- Kategori Pekerjaan ----</option>
      @foreach($kategori as $k)
      <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Keterangan Pengajuan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="keterangan_pengajuan" value="{{ $pengajuan->keterangan_pengajuan ?? '' }}" required="required">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" name="tanggal_pengajuan" value="{{ $pengajuan->tanggal_pengajuan ?? '' }}" required="required" >
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>

<script type="text/javascript">
  $(function () {

    $('#proPilih').change(function() {
        $var = $(#proPilih).attr('data-grade')
        $('#nama_rab').val($var)
    })
})
</script>