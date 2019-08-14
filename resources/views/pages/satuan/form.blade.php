<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Satuan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Kg, Ltr" name="nama_satuan" value="{{ $satuan->nama_satuan ?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>