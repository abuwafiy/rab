<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" placeholder="Ex: Direktur Keuangan" name="tanggal" value="{{ $kas->tanggal?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Keterangan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Aktif/Non Aktif" name="keterangan" value="{{ $kas->keterangan ?? '' }}">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Pemasukan</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" placeholder="Ex: Aktif/Non Aktif" name="pemasukan" value="{{ $kas->pemasukan?? '' }}">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Pengeluaran</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" placeholder="Ex: Aktif/Non Aktif" name="pengeluaran" value="{{ $kas->pengeluaran ?? '' }}">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>