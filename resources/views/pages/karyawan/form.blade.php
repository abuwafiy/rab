<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">NIK</label>
  <div class="col-sm-10">
    <input type="text" class="form-control"  name="nik" value="{{ $karyawan->nik ?? '' }}" required="required" maxlength="15">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Nama</label>
  <div class="col-sm-10">
    <input type="text" class="form-control"  name="nama_karyawan" value="{{ $karyawan->nama_karyawan ?? '' }}" required="required">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan</label>
  <div class="col-sm-10">
    <select class="form-control" name="id_jabatan" id="id_jabatan">
      <option>----- PILIH JABATAN ----</option>
      @foreach($jabatan as $j)
      <option value="{{ $j->id_jabatan }}">{{ $j->nama_jabatan }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Alamat</label>
  <div class="col-sm-10">
    <textarea class="form-control" name="alamat_karyawan" required="required">{{ $karyawan->alamat_karyawan ?? '' }}</textarea>
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">No. HP</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" name="no_hp" value="{{ $karyawan->no_hp ?? '' }}" required="required" maxlength="13">
  </div>
</div>
<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label">Password</label>
  <div class="col-sm-10">
    <input type="password" class="form-control" name="password" value="{{ $karyawan->password ?? '' }}" required="required">
  </div>
</div>

<div class="form-group row">
  <label for="colFormLabel" class="col-sm-2 col-form-label"></label>
  <div class="col-sm-10">
    <input type="submit" class="btn btn-primary" value="Simpan">
  </div>
</div>