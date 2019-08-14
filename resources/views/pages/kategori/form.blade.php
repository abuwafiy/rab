<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Kategori</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Pemasangan Pipa" name="nama_kategori" value="{{ $kategori->nama_kategori ?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>