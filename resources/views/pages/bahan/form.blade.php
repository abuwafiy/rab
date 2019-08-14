<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Bahan</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" placeholder="Ex: Pekerja" name="nama_bahan" value="{{ $bahan->nama_bahan?? '' }}">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Satuan</label>
  <div class="col-sm-10">
    <select class="form-control" name="satuan" id="satuan">
      <option>----- PILIH Satuan ----</option>
      @foreach($satuan as $j)
      <option value="{{ $j->nama_satuan }}">{{ $j->nama_satuan }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Harga</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" placeholder="Ex: 500000000" name="harga" value="{{ $bahan->harga ?? '' }}">
  </div>
</div>
 <div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
  <div class="col-sm-10">
    <select class="form-control" name="kategori_bahan">
      <option>----- PILIH KATEGORI ----</option>
    <option>Material</option>
      <option>Upah</option>
     
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>