<div class="form-group row">

  <div class="col-sm-10">
    <input type="text" class="form-control"  name="id_rab" value="{{ $rab->id_rab ?? '' }}" hidden="">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Proyek</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_proyek" id="id_proyek">
      <option>----- PILIH PROYEK ----</option>
      @foreach($proyek as $j)
      <option value="{{ $j->id_proyek }}">{{ $j->nama_proyek }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Rab</label>
  <div class="col-sm-10">
    <input type="text" class="form-control"  name="nama_rab" value="{{ $rab->nama_rab ?? '' }}" required="required">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Lokasi</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" name="lokasi" value="{{ $rab->lokasi ?? '' }}" required="required" >
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Luas Tanah</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="luas_tanah" value="{{ $rab->luas_tanah ?? '' }}" required="required">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Luas Bangunan</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="luas_bangunan" value="{{ $rab->luas_bangunan ?? '' }}" required="required">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>