<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Jabatan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Direktur Keuangan" name="nama_jabatan" value="{{ $jabatan->nama_jabatan ?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Status jabatan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Aktif/Non Aktif" name="status_jabatan" value="{{ $jabatan->status_jabatan ?? '' }}">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>