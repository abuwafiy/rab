<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">ID realisasi</label>
  <div class="col-sm-10">
    <input type="text" class="form-control"  name="id_realisasi" value="{{ $realisasi->id_realisasi ?? '' }}" required="required" maxlength="15" >
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Proyek</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_proyek" id="id_proyek">
      <option>----- PILIH PROYEK ----</option>
      @foreach($proyek as $p)
      <option value="{{ $p->id_proyek }}">{{ $p->nama_proyek }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Realisasi</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="nama_realisasi" value="{{ $realisasi->nama_realisasi ?? '' }}" required="required" max="9999999999" min="1">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Budget</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="budget_realisasi" value="{{ $realisasi->budget_realisasi ?? '' }}" required="required" max="9999999999" min="1">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Lokasi Realisasi</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="lokasi_realisasi" value="{{ $realisasi->lokasi_realisasi ?? '' }}" required="required" >
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Luas Tanah</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="luas_tanah" value="{{ $realisasi->luas_tanah ?? '' }}" required="required">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Luas Bangunan</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="luas_bangunan" value="{{ $realisasi->luas_bangunan ?? '' }}" required="required">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>