<div class="form-group row">
    <input type="text" class="form-control"  name="id_pengajuan" value="{{ $pengajuan->id_pengajuan ?? '' }}" hidden="">
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Proyek</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_proyek" id="id_proyek" disabled="">
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
    <select class="form-control" name="id_rab" id="id_rab" disabled="">
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
    <select class="form-control" name="id_kategori" id="id_kategori" disabled="">
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
    <input type="text" class="form-control" name="keterangan_pengajuan" value="{{ $pengajuan->keterangan_pengajuan ?? '' }}" required="required" disabled="">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Pengajuan</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" name="tanggal_pengajuan" value="{{ $pengajuan->tanggal_pengajuan ?? '' }}" required="required" disabled="">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Konfirmasi Approval</label>
  <div class="col-sm-10">
    <select class="form-control" name="status_approval" id="status_approval">
      <option value="0" @if($d->status_approval==0)selected @endif>Pending</option>
      <option value="1" @if($d->status_approval==1)selected @endif>Approve</option>
      <option value="2" @if($d->status_approval==2)selected @endif>Reject</option>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>