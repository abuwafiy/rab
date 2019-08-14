<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Proyek</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: La Diva Grenhill" name="nama_proyek" value="{{ $proyek->nama_proyek ?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Lokasi </label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Menganti" name="lokasi_proyek" value="{{ $proyek->lokasi_proyek ?? '' }}">
  </div>
</div>
 <div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
  <div class="col-sm-10">
    <select class="form-control" name="status">
      <option>----- PILIH STATUS ----</option>
    <option>Aktif</option>
      <option>Non Aktif</option>
     
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>